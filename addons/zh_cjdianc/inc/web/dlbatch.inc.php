<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
$action = 'start';
$uid=$_COOKIE["uid"];
$storeid=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getNaveMenu($storeid, $action,$uid);
$type = pdo_getall('cjdc_table_type',array('uniacid' => $_W['uniacid'],'store_id'=>$storeid));
if(checksubmit('submit')){
for($i=0;$i<$_GPC['table_count'];$i++){
	$data['name']=$_GPC['name'].$i;
	$data['num']=$_GPC['num'];
	$data['type_id']=$_GPC['type_id'];
	$data['tag']=$_GPC['tag'];
	$data['uniacid']=$_W['uniacid'];
	$data['store_id']=$storeid;
	$data['orderby']=$_GPC['orderby'];		
	$data['status']=0;
	$res=pdo_insert('cjdc_table',$data);
}
if($res){
	message('添加成功',$this->createWebUrl2('dltable2',array()),'success');
}else{
	message('添加失败','','error');
}

}

include $this->template('web/dlbatch');