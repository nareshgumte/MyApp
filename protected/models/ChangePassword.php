<?php

/**
 * ChangePassword class.
 * ChangePassword is the data structure for keeping
 * Store Change password form data. It is used by the 'changepassword' action of 'StoreController'.
 */
class ChangePassword extends CFormModel {

    public $oldPassword;
    public $password;
    public $verifyPassword;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // email has to be a valid email address
            array('oldPassword,password,verifyPassword', 'required'),
            array('oldPassword, password, verifyPassword', 'length', 'max' => 128, 'min' => 4, 'message' => "Incorrect password (minimal length 4 symbols)."),
            array('verifyPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Retype Password is incorrect."),
            array('oldPassword', 'verifyOldPassword'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'oldPassword' => 'OldPassword',
            'password' => 'Password',
            'verifyPassword' => 'VerifyPassword',
        );
    }

    /**
     * Verify Old Password
     */
    public function verifyOldPassword($attribute, $params) {
        if (IntLogin::model()->findByPk(Yii::app()->user->id)->password != $this->$attribute)//md5($this->$attribute)
            $this->addError($attribute, "Old Password is incorrect.");
    }

}

