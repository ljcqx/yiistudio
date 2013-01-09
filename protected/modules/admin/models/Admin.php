<?php

/**
 * This is the model class for table "{{admin}}".
 *
 * The followings are the available columns in table '{{admin}}':
 * @property integer $id
 * @property string $username
 * @property string $realname
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $profile
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $role_id
 * @property integer $status
 */
class Admin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Admin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{admin}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, realname, password, email, role_id', 'required'),
			array('create_time, update_time, role_id, status', 'numerical', 'integerOnly'=>true),
			array('username, realname, password, salt, email', 'length', 'max'=>128),
			array('profile', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, realname, password, email, create_time, update_time, role_id, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'realname' => 'Realname',
			'password' => 'Password',
			'salt' => 'Salt',
			'email' => 'Email',
			'profile' => 'Profile',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'role_id' => 'Role',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Validate of the validity of user password
     * 验证用户密码的有效性
     */
    public function validatePassword($password){
        return $this->hasPassword($password, $this->salt) === $this->password;
    }

    public function hasPassword($password, $salt){
        return md5($salt.$password);
    }

    /**
     * Generaters a salt that can be used to generate a password hash
     * @return string the salt
     */
    protected function generateSalt()
    {
        return uniqid('',true);
    }

    /**
     * Generater a salt 32 characters
     * @return string the md5(salt)
     */
    public function hashSalt()
    {
        return md5($this->generateSalt());
    }

    public function beforeSave()
    {
        if(parent::beforeSave()){
            if($this->isNewRecord){
                $this->salt = $this->hashSalt();
                $this->password = $this->hasPassword($this->password, $this->salt);
                $this->create_time = $this->update_time = time();
                $this->status = 1;
            }else{
                $this->password = $this->hasPassword($this->password, $this->salt);
                $this->update_time = time();
            }
            return true;
        }else{
            return false;
        }
    }
}