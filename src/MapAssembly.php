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

    public function MapAssembly($key){
        $this->__construct($key);
    }

    // 路线规划
    public function navi($start='',$dest,$destName='',$naviBy=''){
        $uri = "http://m.amap.com/navi/";
        $data['key'] = $this->key;
        if($start)
            $data['start'] = $start;
        $data['dest'] = $dest;
        $data['destName'] = $destName;
        if($naviBy)
            $data['naviBy'] = $naviBy;

        $qs = http_build_query($data);
        return "{$uri}?{$qs}";
    }

    // 导航界面
    public function naviget($from,$to,$pass='',$type='',$opt='',$dev='',$src=''){
        $uri = "http://m.amap.com/";
        $data['from'] = $from;
        $data['to'] = $to;
        if($pass)
            $data['pass'] = $pass;
        if($type)
            $data['type'] = $type;
        if($opt)
            $data['opt'] = $opt;
        if($dev)
            $data['dev'] = $dev;
        if($src)
            $data['src'] = $src;

        $qs = http_build_query($data);
        return "{$uri}?{$qs}";
    }

    // 选址组件
    public function picker($center=''){
        $uri = "http://m.amap.com/picker/";
        $data['key'] = $this->key;
        if($center)
            $data['center'] = $center;

        $qs = http_build_query($data);
        return "{$uri}?{$qs}";
    }
}