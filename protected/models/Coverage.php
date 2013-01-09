<?php

/**
 * This is the model class for table "{{coverage}}".
 *
 * The followings are the available columns in table '{{coverage}}':
 * @property string $id
 * @property string $pid
 * @property string $coverageName
 * @property string $coverageDesc
 *
 * The followings are the available model relations:
 * @property Coverage $p
 * @property Coverage[] $coverages
 */
class Coverage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Coverage the static model class
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
		return '{{coverage}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('coverageName, coverageDesc', 'required'),
			array('pid', 'length', 'max'=>10),
			array('coverageName', 'length', 'max'=>100),
			array('coverageDesc', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pid, coverageName, coverageDesc', 'safe', 'on'=>'search'),
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
			'p' => array(self::BELONGS_TO, 'Coverage', 'pid'),
			'coverages' => array(self::HAS_MANY, 'Coverage', 'pid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pid' => 'Pid',
			'coverageName' => 'Coverage Name',
			'coverageDesc' => 'Coverage Desc',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('pid',$this->pid,true);
		$criteria->compare('coverageName',$this->coverageName,true);
		$criteria->compare('coverageDesc',$this->coverageDesc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}