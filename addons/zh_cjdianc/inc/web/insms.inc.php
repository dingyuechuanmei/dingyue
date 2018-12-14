<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


global $_GPC, $_W;
$storeid=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getMainMenu2();
$item=pdo_get('cjdc_sms',array('store_id'=>$storeid));
    if(checksubmit('submit')){
            $data['appkey']=trim($_GPC['appkey']);
            $data['wm_tid']=trim($_GPC['wm_tid']);
            $data['dn_tid']=trim($_GPC['dn_tid']);
            $data['yy_tid']=trim($_GPC['yy_tid']);
            $data['store_id']=$storeid;
            $data['tel']=$_GPC['tel'];
            $data['is_wm']=$_GPC['is_wm'];
            $data['is_dn']=$_GPC['is_dn'];
             $data['is_yy']=$_GPC['is_yy'];
            if($_GPC['id']==''){                
                $res=pdo_insert('cjdc_sms',$data);
                if($res){
                    message('添加成功',$this->createWebUrl('insms',array()),'success');
                }else{
                    message('添加失败','','error');
                }
            }else{
                $res = pdo_update('cjdc_sms', $data, array('id' => $_GPC['id']));
                if($res){
                    message('编辑成功',$this->createWebUrl('insms',array()),'success');
                }else{
                    message('编辑失败','','error');
                }
            }
        }
include $this->template('web/insms');