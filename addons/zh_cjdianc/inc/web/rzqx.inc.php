<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */



global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$list = pdo_getall('cjdc_rzqx',array('uniacid' => $_W['uniacid']),array(),'','num asc');
if($_GPC['id']){
    $res=pdo_delete('cjdc_rzqx',array('id'=>$_GPC['id']));
    if($res){
        message('删除成功',$this->createWebUrl('rzqx',array()),'success');
    }else{
        message('删除失败','','error');
    }
}
include $this->template('web/rzqx');