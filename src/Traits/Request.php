<?php

namespace Myckhel\Mono\Traits;

use Illuminate\Support\Facades\Http;

class Props
{
    function __construct(array $props) {
        collect($props)->map(fn ($value, $key) =>
            $this->$key = is_array($value) ? new self($value) : $value
        );
    }
}


trait Request
{
    public static function config() {
        return new Props(Config::config());
    }

    public static function post($endpoint, $params = [], $version = null) {
        return self::request($endpoint, $params, 'post', $version);
    }

    public static function delete($endpoint, $params = [], $version = null) {
        return self::request($endpoint, $params, 'delete', $version);
    }

    public static function put($endpoint, $params = [], $version = null) {
        return self::request($endpoint, $params, 'put', $version);
    }

    public static function get($endpoint, $params = [], $version = null) {
        return self::request($endpoint, $params, 'get', $version);
    }

    public static function merge($ar, $arr){
        return array_merge($ar, $arr);
    }

    public static function request($endpoint, $params, $method = 'get', $version = null)
    {
        $cm       = self::config();
        $secret   = $cm->secret_key;

        self::injectVersion($version, $endpoint);

        $res = Http::withHeaders([
            'mono-sec-key'  => $secret,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json'
        ])
        ->$method(
            $cm->url.$endpoint,
            $params
        );

        if ($res->failed()) {
            abort($res->status(), $res->json()['message']);
        } else {
            return $res->json();
        }
    }

    static function injectVersion($version, &$endpoint) {
        if($version) $endpoint = "/v".Config::config('version').$endpoint;
    }
}
