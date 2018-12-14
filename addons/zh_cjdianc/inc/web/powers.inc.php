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
$stores=pdo_getall('cjdc_store',array('uniacid'=>$_GPC['uniacid']));
 $item=pdo_get('cjdc_system',array('uniacid'=>$_GPC['uniacid']));
    if(checksubmit('submit')){
            $data['msgn']=$_GPC['msgn'];//平台模式功能1多2单
            $data['model']=$_GPC['msgn'];

            $data['fxgn']=$_GPC['fxgn'];//分销功能
            if($_GPC['fxgn']==2){
               pdo_update('cjdc_fxset',array('is_open'=>2),array('uniacid'=>$_W['uniacid']));
            }

            $data['jfgn']=$_GPC['jfgn'];//积分功能
            if($_GPC['jfgn']==2){
                 $data['is_jf']=2;
            }
            $data['hygn']=$_GPC['hygn'];//分销功能
            if($_GPC['hygn']==2){
                 $data['is_hy']=2;
            }
            $data['uniacid']=$_GPC['uniacid'];

            if($_GPC['id']==''){                
                $res=pdo_insert('cjdc_system',$data);
                if($res){
                    message('添加成功',$this->createWebUrl('powers',array('uniacid'=>$_GPC['uniacid'])),'success');
                }else{
                    message('添加失败','','error');
                }
            }else{
                $res = pdo_update('cjdc_system', $data, array('id' => $_GPC['id']));
                if($res){
                    message('编辑成功',$this->createWebUrl('powers',array('uniacid'=>$_GPC['uniacid'])),'success');
                }else{
                    message('编辑失败','','error');
                }
            }
        }
include $this->template('web/powers');