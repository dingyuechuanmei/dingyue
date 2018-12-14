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
 $sql="select a.* ,b.md_name from " . tablename("wpdc_seller") . " a"  . " left join " . tablename("wpdc_store") . " b on b.id=a.store_id   WHERE a.uniacid=:uniacid";
$list=pdo_fetchall($sql,array(':uniacid'=>$_W['uniacid']));
if($_GPC['op']=='delete'){
	$res=pdo_delete('wpdc_seller',array('id'=>$_GPC['id']));
	if($res){
		 message('删除成功！', $this->createWebUrl('admin'), 'success');
		}else{
			  message('删除失败！','','error');
		}
}
if($_GPC['state']){
	$data['state']=$_GPC['state'];
	$res=pdo_update('wpdc_seller',$data,array('id'=>$_GPC['id']));
	if($res){
		 message('编辑成功！', $this->createWebUrl('admin'), 'success');
		}else{
			  message('编辑失败！','','error');
		}
}
include $this->template('web/admin');