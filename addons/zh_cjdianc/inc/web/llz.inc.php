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
$pageindex = max(1, intval($_GPC['page']));
$pagesize=10;
$sql="select * from".tablename('cjdc_llz')." where uniacid={$_W['uniacid']}";
$total=pdo_fetchcolumn("select count(*) from".tablename('cjdc_llz')." where uniacid={$_W['uniacid']} ");
$select_sql =$sql." LIMIT " .($pageindex - 1) * $pagesize.",".$pagesize;
$list=pdo_fetchall($select_sql);
$pager = pagination($total, $pageindex, $pagesize);
if($_GPC['op']=='delete'){
	$res=pdo_delete('cjdc_llz',array('id'=>$_GPC['id']));
	if($res){
		 message('删除成功！', $this->createWebUrl('llz'), 'success');
		}else{
			  message('删除失败！','','error');
		}
}
if($_GPC['status']){
	$data['status']=$_GPC['status'];
	$res=pdo_update('cjdc_llz',$data,array('id'=>$_GPC['id']));
	if($res){
		 message('编辑成功！', $this->createWebUrl('llz'), 'success');
		}else{
			  message('编辑失败！','','error');
		}
}
include $this->template('web/llz');