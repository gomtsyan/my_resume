<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait Authorizable
{
    /**
     * Policy model
     *
     * @var $policyModel
     */
    public $policyModel;

    /**
     * @var array
     */
    private $abilities = [
        'index' => 'viewAny',
        'show' => 'view',
        'create' => 'create',
        'store' => 'create',
        'edit' => 'update',
        'update' => 'update',
        'destroy' => 'delete'
    ];

    /**
     * Override of callAction to perform the authorization before
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        if ($ability = $this->getAbility($method)) {
            $this->authorize($ability, [$this->getPolicyModel()]);
        }

        return parent::callAction($method, $parameters);
    }

    /**
     * @param $method
     * @return mixed|null
     */
    public function getAbility($method)
    {
        $action = Arr::get($this->getAbilities(), $method);

        return $action ?? null;
    }

    /**
     * @return array
     */
    private function getAbilities()
    {
        return $this->abilities;
    }

    /**
     * @return mixed
     */
    public function getPolicyModel()
    {
        return $this->policyModel;
    }

    /**
     * @param $abilities
     */
    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}
