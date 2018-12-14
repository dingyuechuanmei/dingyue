<?php
/**
 * 本程序由残风社区源码论坛提供
 *
 * www.92php.net
 * 
 * QQQ466421811  承接微擎模块破解、小程序前端、PHP解密
 */


defined('IN_IA') or exit('Access Denied');
global $_GPC, $_W;
$action = 'start';
$uid=$_COOKIE["uid"];
$storeid=$_COOKIE["storeid"];
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getNaveMenu($storeid, $action,$uid);
//$GLOBALS['frames'] = $this->getMainMenu2();
    $item=pdo_get('wpdc_store',array('id'=>$storeid));
    if(checksubmit('submit')){
            $data['is_yue']=$_GPC['is_yue']; 
            $data['is_jfpay']=$_GPC['is_jfpay'];
            if($_GPC['id']==''){                
                $res=pdo_insert('wpdc_store',$data);
                if($res){
                    message('添加成功',$this->createWebUrl2('dlinpay',array()),'success');
                }else{
                    message('添加失败','','error');
                }
            }else{
                $res = pdo_update('wpdc_store', $data, array('id' => $_GPC['id']));
                if($res){
                    message('编辑成功',$this->createWebUrl2('dlinpay',array()),'success');
                }else{
                    message('编辑失败','','error');
                }
            }
        }
    include $this->template('web/dlinpay');