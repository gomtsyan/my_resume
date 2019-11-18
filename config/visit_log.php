<?php

return [

    /*
    |--------------------------------------------------------------------------
    | IP to Location Service
    |--------------------------------------------------------------------------
    |
    | If "true", it will use http://freegeoip.net to get and save more information about visitor like
    | Continent Name, Country, Country Flag, Location Coordinates. If "false", it will only save IP, OS
    | and Browser info.
    |
    | Note: For requests from same IP, it will be cached so no further request is made to http://freegeoip.net
    |
    */

    'ip_to_location' => true,

    'free_geo_ip_url' => 'http://api.ipstack.com',

    'token' => 'PASTE_YOUR_TOKEN', //get your token here: https://ipstack.com/

    /*
    |--------------------------------------------------------------------------
    | Return Data Type from https://ipstack.com/
    |--------------------------------------------------------------------------
    |
    | Set to 'json' or 'xml' to choose between output formats.
    |
    */

    'output_format' => 'json',

    /*
    |--------------------------------------------------------------------------
    | Return Fields from https://ipstack.com/
    |--------------------------------------------------------------------------
    |
    | If "custom_fields" => "true", it will use the fields from "return_fields"
    | If "custom_fields" => "false", it will use all values that api will return
    | You can see these values from the documentation
    | https://ipstack.com/documentation#objects
    |
    */

    'custom_fields' => true,

    'return_fields' => [
        'continent_name',
        'country_code',
        'country_name',
        'location.country_flag',
        'region_name',
        'city',
        'latitude',
        'longitude'
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Requests
    |--------------------------------------------------------------------------
    |
    | If "true", it will cache the results for same IP so no more request will be made to
    | http://freegeoip.net
    |
    */

    'cache' => true,

    'cache_prefix' => 'visit_log',

    /*
    |--------------------------------------------------------------------------
    | Visit Log Type
    |--------------------------------------------------------------------------
    |
    | If "true", it will only log unique visits meaning same IP will not be logged again. If "false",
    | same IP will be logged repeatedly on each visit.
    |
    */

    'unique' => true,
];
