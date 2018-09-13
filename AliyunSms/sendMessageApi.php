<?php

class sendMessageApi {
    /*
     * 发送短信接口
     * @param string $user_phone 短信接收号码
     * @param string $imgverify 图形验证码
     * @param string $signName 短信签名名称
     * @param string $templateCode 短信模版code
     * */
    public function send_message_api($user_phone = null, $imgverify = null, $signName = null, $templateCode = null){
        //验证图形验证码
//        if(!check_verify($imgverify)){
//            return ['status'=>'fail','msg'=>'验证码输入错误！','data'=>''];
//        }
        //短信接收号码
        $phoneNumber = $user_phone;
        //生成随机六位整数
        $verify = mt_rand(100000, 999999);
        $options = array('code'=>$verify);

        //实例发送类对象
        $SendMsg = new \AliyunSms\SendMsg();
        set_time_limit(0);
        header('Content-Type: text/plain; charset=utf-8');

        $response = $SendMsg::sendSms($phoneNumber, $options, $signName, $templateCode);

        $response = objectToarray($response);
        if($response['Code'] == 'OK'){
            cache('verify:'.$phoneNumber,$verify,120);
            return ['status'=>'success','msg'=>'发送成功！','data'=>''];
        }else{
            return ['status'=>'fail','msg'=>'发送失败！','data'=>$response];
        }
    }
}
