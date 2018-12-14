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
$list=pdo_getall('cjdc_typead',array('uniacid'=>$_W['uniacid']),array(),'','orderby ASC');
if($_GPC['op']=='delete'){
	$res=pdo_delete('cjdc_typead',array('id'=>$_GPC['id']));
	if($res){
		 message('删除成功！', $this->createWebUrl('typead'), 'success');
		}else{
			  message('删除失败！','','error');
		}
}
if($_GPC['status']){
	$data['status']=$_GPC['status'];
	$res=pdo_update('cjdc_typead',$data,array('id'=>$_GPC['id']));
	if($res){
		 message('编辑成功！', $this->createWebUrl('typead'), 'success');
		}else{
			  message('编辑失败！','','error');
		}
}
include $this->template('web/typead');