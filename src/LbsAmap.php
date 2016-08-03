<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/3
 * Time: 20:02
 */

namespace com\amap\lbs;

class LbsAmap
{

    // 地理编码API服务
    public static function geocodeGeo($key,$address,$city='',$output='JSON'){
        $uri = "http://restapi.amap.com/v3/geocode/geo";
        $data['key'] = $key;
        $data['address'] = $address;
        $data['city'] = $city;
        $data['output'] = $output;

        $qs = http_build_query($data);
        return @file_get_contents("{$uri}?{$qs}");
    }

    // 逆地理编码API服务
    public static function geocodeRegeo($key,$location,$poitype='',$radius='0',$extensions='',$batch='false',$roadlevel='',$output='JSON',$homeorcorp='0'){
        $uri = "http://restapi.amap.com/v3/geocode/regeo";
        $data['key'] = $key;
        $data['location'] = $location;
        $data['poitype'] = $poitype;
        $data['radius'] = $radius;
        $data['extensions'] = $extensions;
        $data['batch'] = $batch;
        $data['roadlevel'] = $roadlevel;
        $data['output'] = $output;
        $data['homeorcorp'] = $homeorcorp;

        $qs = http_build_query($data);
        return @file_get_contents("{$uri}?{$qs}");
    }
}