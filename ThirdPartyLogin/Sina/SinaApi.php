<?php

namespace Sina;
require_once 'config.php';

class SinaApi{
    /*
     *微博授权登录后通过code获取access_token
     * */
    public function getAccessTokenByCode($code){
        //引入扩展配置变量
        global $config;
        $url = 'https://api.weibo.com/oauth2/access_token?client_id='.$config['appkey'].'&client_secret='.$config['appsecret'].'&grant_type=authorization_code&redirect_uri='.$config['redirect_uri'].'&code='.$code;
        $postData = array();
        $res = post_curl($url,$postData);
        $data = json_decode($res,true);
        return $data;
    }

    /*
     * 微博授权登录后获取用户信息
     * */
    public function getUserinfo($code){
        $login_res = $this->getAccessTokenByCode($code);
        $access_token = $login_res['access_token'];
        $uid = $login_res['uid'];
        //获取用户信息
        $url = 'https://api.weibo.com/2/users/show.json?access_token='.$access_token.'&uid='.$uid;
        $res = get_curl($url);
        $data = json_decode($res,true);
        return $data;

    }
}