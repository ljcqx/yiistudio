<?php
/**
 * @Filename: RegisterForm.php
 * @author: <ljc6qx@gmail.com>
 * @time: 2012-12-14 16:53
 */
class RegisterForm extends CFormModel
{
    public $username;
    public $email;
    public $password;
    public $repassword;
    //public $mobile;
    public $verifyCode;


    public function rules()
    {
        return array(
            array('username, email, password, repassword, verifyCode', 'required'),
            array('email', 'email'),
            //array('mobile','numerical'),//如果是数字的话
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
        );
    }

    public function attributeLabels()
    {
        return array(
            'username'=>'用户名',
            'password'=>'密 码',
            'verifyCode'=>'验证码',
        );
    }
}
