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
$item=pdo_get('cjdc_system',array('uniacid'=>$_W['uniacid']),array('ps_name','is_sj','is_dada','is_kfw','is_pt','id'));
$ps_name=empty($item['ps_name'])?'超级跑腿':$item['ps_name'];
if(checksubmit('submit')){
    $data['is_sj']=$_GPC['is_sj'];
    $data['is_dada']=$_GPC['is_dada'];
    $data['is_kfw']=$_GPC['is_kfw'];
    $data['is_pt']=$_GPC['is_pt'];
    $data['uniacid']=$_W['uniacid'];         
    if($_GPC['id']==''){                
        $res=pdo_insert('cjdc_system',$data);
        if($res){
            message('添加成功',$this->createWebUrl('dispatch',array()),'success');
        }else{
            message('添加失败','','error');
        }
    }else{
        $res = pdo_update('cjdc_system', $data, array('id' => $_GPC['id']));
        if($res){
            message('编辑成功',$this->createWebUrl('dispatch',array()),'success');
        }else{
            message('编辑失败','','error');
        }
    }
}
include $this->template('web/dispatch');