<?php

/**
 * This is the model class for table "int_friends".
 *
 * The followings are the available columns in table 'int_friends':
 * @property integer $id
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $uniq_id
 * @property string $email
 * @property string $network
 */
class IntFriends extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return IntFriends the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'int_friends';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, user_id, firstname, lastname, uniq_id, network', 'required'),
            array('id, user_id', 'numerical', 'integerOnly' => true),
            array('firstname, lastname, email, network', 'length', 'max' => 100),
            array('uniq_id', 'length', 'max' => 15),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, firstname, lastname, uniq_id, email, network', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'uniq_id' => 'Uniq',
            'email' => 'Email',
            'network' => 'Network',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('uniq_id', $this->uniq_id, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('network', $this->network, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getFriends() {
        $criteria = new CDbCriteria;
        $criteria->condition = '`user_id` = 1'; //later remove hardcoded thing it should be dynamical
        $criteria->order = '`firstname` ASC';

        $items = IntFriends::model()->findAll($criteria);
        return $items;
    }

}