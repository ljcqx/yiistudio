<?php

/**
 * This is the model class for table "{{admin}}".
 *
 * The followings are the available columns in table '{{admin}}':
 * @property string $password
 * @property string $newpassword
 * @property string $oldpassword
 * @property string $verifypassword
 * @property string $currentpassword
 */
class ChangepasswordForm extends CFormModel
{
    public $oldpassword;
    public $password;
    public $verifypassword;
    public $currentpassword;
    public function __construct(){
        $this->currentpassword = Yii::app()->session['currentpassword'];
        echo $this->currentpassword;
        Yii::app()->end();
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('oldpassword, password, verifypassword', 'required'),
			array('password', 'length', 'max'=>128, 'min'=>6, 'message'=>Yii::t('AdminModule.user',"Incorrect password (minimal length 6 symbols).")),
			array('password', 'compare', 'compareAttribute'=>'verfiypassword', 'message'=>Yii::t('AdminMoudels.user', 'Retype password is incrorrect.')),
            array('oldpassword', 'compare', 'compareAttribute'=>'currentpassword', 'message'=>Yii::t('AdminModule.user', 'Current password is incorrect')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, realname, password, salt, email, profile, create_time, update_time, role_id, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'oldPassword'=>Yii::t("AdminModule.user", "Current password"),
            'password'=>Yii::t("AdminModule.user", "New password"),
            'verifyPassword'=>Yii::t("AdminModule.user", "Retype new password"),
		);
	}

}