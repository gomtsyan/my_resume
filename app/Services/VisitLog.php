<?php

namespace App\Services;

use App\Contracts\VisitLogger;
use App\Repositories\Contracts\VisitedPagesRepository;
use App\Repositories\Contracts\VisitorsRepository;
use Illuminate\Support\Arr;

class VisitLog implements VisitLogger
{
    /**
     * @var Browser
     */
    protected $browser;

    /**
     * @var VisitorsRepository
     */
    protected $visitorsRepo;

    /**
     * @var $visitedPagesRepo
     */
    protected $visitedPagesRepo;

    /**
     * VisitLog constructor.
     * @param Browser $browser
     * @param VisitorsRepository $visitorsRepo
     * @param VisitedPagesRepository $visitedPagesRepo
     */
    public function __construct(
        Browser $browser,
        VisitorsRepository $visitorsRepo,
        VisitedPagesRepository $visitedPagesRepo
    ) {
        $this->browser = $browser;
        $this->visitorsRepo = $visitorsRepo;
        $this->visitedPagesRepo = $visitedPagesRepo;
    }

    /**
     * Saves visitor info into db.
     *
     * @return mixed
     */
    public function save()
    {
        $data = $this->getData();

        if ($this->isUnique()) {

            $attribute = $this->getVisitorAttribute();

            return $this->visitorsRepo->updateOrCreate($attribute, $data);
        }

        return $this->visitorsRepo->save($data);
    }

    /**
     * Saves visited page info into db.
     *
     * @param $instance
     * @param $visitPageData
     * @return mixed
     */
    public function saveVisitedPage($instance, $visitPageData)
    {
        $visitedPage = $this->visitedPagesRepo->firstOrNew($visitPageData);

        if ($visitedPage->id) {
            return $visitedPage->increment('count');
        }

        return $instance->visitedPages()->create($visitPageData);
    }

    /**
     * @return mixed
     */
    public function fileDownloaded()
    {
        $ip = $this->getVisitorIp();
        $attributes = ['is_download_file' => '1'];

        return $this->visitorsRepo->updateByIp($ip, $attributes);
    }

    /**
     * Gets Visitor Attribute.
     *
     * @return array
     */
    protected function getVisitorAttribute()
    {
        return [
            'ip' => $this->getVisitorIp()
        ];
    }

    /**
     * Gets OS information.
     *
     * @return string
     */
    protected function getBrowserInfo()
    {
        $browser = $this->browser->getBrowser() ?: 'Other';
        $browserVersion = $this->browser->getVersion();

        if (trim($browserVersion)) {
            return $browser . ' (' . $browserVersion . ')';
        }

        return $browser;
    }

    /**
     * Returns visit data to be saved in db.
     *
     * @return array
     */
    protected function getData()
    {
        $ip = $this->getVisitorIp();
        $cacheKey = $this->getCacheKey();

        // basic info
        $data = [
            'ip' => $ip,
            'browser' => $this->getBrowserInfo(),
            'os' => $this->browser->getPlatform() ?: 'Unknown',
        ];

        // info from http://freegeoip.net
        if ($this->isIpToLocation()) {

            if ($this->isCache()) {

                $freeGeoIpData = unserialize(cache($cacheKey));

                if (!$freeGeoIpData) {

                    $freeGeoIpData = $this->getDataFromApi();

                    if ($freeGeoIpData) {
                        cache()->forever($cacheKey, serialize($freeGeoIpData));
                    }
                }

            } else {
                $freeGeoIpData = $this->getDataFromApi();
            }

            if ($freeGeoIpData) {
                $data = array_merge($data, $freeGeoIpData);
            }
        }

        return $data;
    }

    /**
     *
     * Build url for https://ipstack.com/ api
     *
     * @return string
     */
    protected function buildUrl()
    {
        $ip = $this->getVisitorIp();
        $tokenString = $this->getTokenString();

        if ($this->isCustomFields()) {
            $tokenString .= $this->getReturnFieldsString();
        }

        return config('visit_log.free_geo_ip_url') . '/' . $ip . '?' . 'access_key=' . config('visit_log.token') . $tokenString;
    }

    /**
     * Receiving data from api
     *
     * @return array
     */
    protected function getDataFromApi()
    {
        $url = $this->buildUrl();

        // Initialize CURL:
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $result = json_decode($json, true);

        return $this->optimizationKeys($result);
    }

    /**
     * Optimizing keys for saving to the database
     *
     * @param $data
     * @return array
     */
    protected function optimizationKeys($data)
    {
        if (is_array($data)) {

            $arrayDot = Arr::dot($data);

            foreach ($arrayDot as $key => $val) {

                $keyExplode = explode('.', $key);

                if (count($keyExplode) > 1) {

                    $newKey = last($keyExplode);
                    $newKeyExplode = explode('_', $newKey);

                    if (count($newKeyExplode) == 1) {
                        $newKey = implode('_', $keyExplode);
                    }

                    $arrayDot[$newKey] = $val;
                    unset($arrayDot[$key]);
                }
            }

            return $arrayDot;
        }

        return $data;
    }

    /**
     * @return null|string
     */
    protected function getVisitorIp()
    {
        return request()->ip();
    }

    /**
     * Get Cache Key.
     *
     * @return string
     */
    protected function getCacheKey()
    {
        $ip = $this->getVisitorIp();

        return config('visit_log.cache_prefix') . $ip;
    }

    /**
     * Get Token String.
     *
     * @return string
     */
    protected function getTokenString()
    {
        return '&output=' . config('visit_log.output_format');
    }

    /**
     * Get Return Fields String.
     *
     * @return string
     */
    protected function getReturnFieldsString()
    {
        return '&fields=' . implode(',', config('visit_log.return_fields'));
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    protected function isCustomFields()
    {
        return config('visit_log.custom_fields');
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    protected function isIpToLocation()
    {
        return config('visit_log.ip_to_location');
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    protected function isUnique()
    {
        return config('visit_log.unique');
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    protected function isCache()
    {
        return config('visit_log.cache');
    }
}
