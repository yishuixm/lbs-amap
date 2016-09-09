<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/9
 * Time: 11:28
 */

namespace yishuixm\lbs;


class MapAssembly
{
    private $key = '';// 服务所用KEY

    public function __construct($key){
        $this->key = $key;
    }

    public function WebServiceApi($key){
        $this->__construct($key);
    }

    // 路线规划
    public function geocodeGeo($start,$dest,$destName='',$naviBy=''){
        $uri = "http://m.amap.com/navi/";
        $data['key'] = $this->key;
        $data['start'] = $start;
        $data['dest'] = $dest;
        $data['destName'] = $destName;
        if($naviBy)
            $data['naviBy'] = $naviBy;

        $qs = http_build_query($data);
        return "{$uri}?{$qs}";
    }
}