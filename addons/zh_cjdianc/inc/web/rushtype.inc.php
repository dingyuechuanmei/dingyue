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
$list = pdo_getall('cjdc_qgtype',array('uniacid' => $_W['uniacid']),array(),'','num ASC');
if($_GPC['op']=='del'){
    $res=pdo_delete('cjdc_qgtype',array('id'=>$_GPC['id']));
    if($res){
        message('删除成功',$this->createWebUrl('rushtype',array()),'success');
    }else{
        message('删除失败','','error');
    }
}
if($_GPC['op']=='upd'){
	$res=pdo_update('cjdc_qgtype',array('state'=>$_GPC['state']),array('id'=>$_GPC['id']));
	if($res){
			message('修改成功',$this->createWebUrl('rushtype',array()),'success');
		}else{
		message('修改失败','','error');
		}
}
include $this->template('web/rushtype');