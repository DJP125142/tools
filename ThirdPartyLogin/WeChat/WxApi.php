<?php

namespace WeChat;
require_once 'config.php';

class WxApi{
    /*
     *微信扫码登录后通过code获取access_token和openid
     * */
    public function getAccessTokenByCode($code){
        //引入扩展配置变量
        global $config;
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$config['appid'].'&secret='.$config['appsecret'].'&code='.$code.'&grant_type=authorization_code';
        $res = get_curl($url);
        $data = json_decode($res,true);
        return $data;
    }

    /*
     * 微信扫码登录后获取用户信息
     * */
    public function getUserinfo($code){
        $login_res = $this->getAccessTokenByCode($code);
        $access_token = $login_res['access_token'];
        $openid = $login_res['openid'];
        //获取用户信息
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid;
        $res = get_curl($url);
        $data = json_decode($res,true);
        return $data;

    }
}