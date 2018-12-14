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
$store_id=$_GPC['id'];

$list=pdo_getall('cjdc_distribution',array('store_id'=>$store_id));
if($_GPC['op']=='delete'){
	$res=pdo_delete('cjdc_distribution',array('id'=>$_GPC['id']));
	if($res){
		 message('删除成功！', $this->createWebUrl('psmoney',array('id'=>$_GPC['store_id'])), 'success');
		}else{
			  message('删除失败！','','error');
		}
}
include $this->template('web/psmoney');