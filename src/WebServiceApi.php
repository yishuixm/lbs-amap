<?php
namespace yishuixm\lbs;

class WebServiceApi
{

    private $key = '';// 服务所用KEY

    public function __construct($key){
        $this->key = $key;
    }

    public function WebServiceApi($key){
        $this->__construct($key);
    }

    // 结果格式化
    private function resultFormat($result){
        $return = json_decode($result, true);

        if($return['status']==='1'&&$return['infocode']==='10000'){
            $info = $return;
            unset($info['status']);
            unset($info['infocode']);
            unset($info['info']);
            return [
                "accessGranted"      => true,
                "errors"            => $return['info'],
                "result"            => $info
            ];
        }else{
            return [
                "acessGranted"      => false,
                "errors"            => $return['info'],
            ];
        }
    }

    // 地理编码API服务
    public function geocodeGeo($address,$city='',$output='JSON'){
        $uri = "http://restapi.amap.com/v3/geocode/geo";
        $data['key'] = $this->key;
        $data['address'] = $address;
        $data['city'] = $city;
        $data['output'] = $output;

        $qs = http_build_query($data);
        return $this->resultFormat(@file_get_contents("{$uri}?{$qs}"), 'geocodes');
    }

    // 逆地理编码API服务
    public function geocodeRegeo($location,$poitype='',$radius='1000',$extensions='',$batch='false',$roadlevel='',$output='JSON',$homeorcorp='0'){
        $uri = "http://restapi.amap.com/v3/geocode/regeo";
        $data['key'] = $this->key;
        $data['location'] = $location;
        $data['poitype'] = $poitype;
        $data['radius'] = $radius;
        $data['extensions'] = $extensions;
        $data['batch'] = $batch;
        $data['roadlevel'] = $roadlevel;
        $data['output'] = $output;
        $data['homeorcorp'] = $homeorcorp;

        $qs = http_build_query($data);
        return $this->resultFormat(@file_get_contents("{$uri}?{$qs}"), 'regeocode');
    }

    // 路径坑规划   行驶距离测量
    public function distance($origins,$destination,$type,$sign='',$output='JSON',$callback=''){
        $uri = "http://restapi.amap.com/v3/distance";
        $data['key'] = $this->key;
        $data['origins'] = $origins;
        $data['destination'] = $destination;
        $data['type'] = $type;
        if($sign)
            $data['sign'] = $sign;
        $data['output'] = $output;
        if($callback)
            $data['callback'] = $callback;

        $qs = http_build_query($data);
        return $this->resultFormat(@file_get_contents("{$uri}?{$qs}"), 'results');
    }

    // IP 定位
    public function ip($ip, $sign, $output='JSON'){
        $uri = "http://restapi.amap.com/v3/ip";
        $data['key'] = $this->key;
        $data['ip'] = $ip;
        if($sign)
            $data['sign'] = $sign;
        $data['output'] = $output;

        $qs = http_build_query($data);
        return $this->resultFormat(@file_get_contents("{$uri}?{$qs}"));
    }

    // 天气查询
    public function weatherInfo($city, $extensions, $output='JSON'){
        $uri = "http://restapi.amap.com/v3/weather/weatherInfo";
        $data['key'] = $this->key;
        $data['city'] = $city;
        switch ($extensions){
            case 'base':
                // 实况天气
                $data['extensions'] = 'base';
                break;
            case 'all':
                // 预报天气
                $data['extensions'] = 'all';
                break;
            default:
                $data['extensions'] = 'base';
                break;
        }

        $data['output'] = $output;

        $qs = http_build_query($data);
        return $this->resultFormat(@file_get_contents("{$uri}?{$qs}"));
    }
}