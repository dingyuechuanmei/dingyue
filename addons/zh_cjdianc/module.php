<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


defined('IN_IA') or exit('Access Denied');

class zh_cjdiancModule extends WeModule
{
    

    public function welcomeDisplay()
    {   
        global $_GPC, $_W;
    	 if ($_W['role'] == 'operator') {
	        $url = $this->createWebUrl('store');
	        Header("Location: " . $url);
    	}else{
            $url = $this->createWebUrl('store');
	    	//$url = $this->createWebUrl('gaikuangdata');
	        Header("Location: " . $url);
    	}
    }
}