<?php
namespace App;

trait Refcurl{
    public function go($deal_id='',$instance=''){
        if(empty($deal_id) && empty($instance)){return false;}
        $get = [
            'deal_id'  => $deal_id,
            'instance' => $instance,
            'sync'     => 1
        ];
        $server = (empty($_SERVER['HTTP_ORIGIN']) ? ((80 == $_SERVER['SERVER_PORT']) ? 'http://' : 'https://').$_SERVER['SERVER_NAME'] : $_SERVER['HTTP_ORIGIN']);
        $html = file_get_contents($server .'/?'. http_build_query($get));

return $html;}}