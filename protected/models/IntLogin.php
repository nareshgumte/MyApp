<?php

/**
 * This is the model class for table "int_login".
 *
 * The followings are the available columns in table 'int_login':
 * @property integer $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $profile_image
 * @property string $password
 * @property integer $login_via
 * @property string $status
 */
class IntLogin extends CActiveRecord {

    public $confirmPassword;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return IntLogin the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'int_login';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, email, password', 'required'),
            array('profile_image', 'required'),
            array('login_via', 'numerical', 'integerOnly' => true),
            array('username, firstname, lastname', 'length', 'max' => 56),
            array('email, profile_image, password', 'length', 'max' => 100),
            array('status', 'length', 'max' => 1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, firstname, lastname, email, profile_image, password, login_via, status', 'safe', 'on' => 'search'),
            array('password', 'length', 'max' => 100, 'min' => 6, 'on' => 'registration'),
            array('password', 'compare', 'compareAttribute' => 'username', 'operator' => '!=', 'message' => 'Password must not be the same as username', 'on' => 'registration'),
            array('password', 'compare', 'compareAttribute' => 'confirmPassword', 'message' => 'Please enter the same password twice', 'on' => 'registration'),
            array('confirmPassword', 'safe'),
            array('profile_image', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true, 'on' => 'update'),
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
            'username' => 'Username',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'profile_image' => 'Profile Image',
            'password' => 'Password',
            'login_via' => 'Login Via',
            'status' => 'Status',
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('profile_image', $this->profile_image, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('login_via', $this->login_via);
        $criteria->compare('status', '0');
        //$criteria->condition = "status='0'";
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}