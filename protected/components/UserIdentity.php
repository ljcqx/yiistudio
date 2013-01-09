<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    public $user;
	public $_id;
	public $username;
	public function authenticate()
	{
        //$user=User::model()->find('username=:username',array(':username'=>$this->username));//两种写法
        $user = User::model()->find('LOWER(username)=?', array(strtolower(trim($this->username))));
        if($user===null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif(!$user->validatePassword($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else{
            $this->_id = $user->id;
            $this->username = $user->username;
            $this->setUser($user);
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode == self::ERROR_NONE;//return ture or false
	}

    public function getUser()
    {
        return $this->user;
    }

    public function getId()
        {
                return $this->_id;
        }

    public function getUserName()
        {
                return $this->username;
        }

    public function setUser(CActiveRecord $user)
    {
        $this->user=$user->attributes;
    }

    /*public function authenticate()
    {
        $users=array(
            // username => password
            'demo'=>'demo',
            'admin'=>'admin',
        );
        if(!isset($users[$this->username]))
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        elseif($users[$this->username]!==$this->password)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
            $this->errorCode=self::ERROR_NONE;
        return !$this->errorCode;
    }*/
}