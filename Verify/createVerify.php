<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/17
 * Time: 16:42
 */
class createVerify {
    /*
     * 生成图形验证码图片地址
     * */
    public function verify(){
        $verify = new \Verify\Verify();
        $verify->entry(1);
    }
}
