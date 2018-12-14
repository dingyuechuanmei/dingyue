<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu2();
$storeid=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($storeid);
$item=pdo_get('cjdc_order',array('id'=>$_GPC['id']));
$goods=pdo_getall('cjdc_order_goods',array('order_id'=>$_GPC['id']));
if(checksubmit('submit')){
	// $data['state']=$_GPC['state'];
	$data['money']=$_GPC['money'];
	$data['preferential']=$_GPC['preferential'];
	// if($_GPC['dn_state']=="2"){
	// 	$data['pay_time']=time();
	// }
	$res=pdo_update('wpdc_order',$data,array('id'=>$_GPC['id']));
	if($res){
             message('编辑成功！', $this->createWebUrl('inorder'), 'success');
        }else{
             message('编辑失败！','','error');
        }
}
include $this->template('web/inorderinfo');