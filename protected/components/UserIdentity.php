<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    private $_id;
    public $userType = 'User';

    public function authenticate() {

        if ($this->userType == 'User') { // This is front login
            $record = IntLogin::model()->findByAttributes(array('username' => $this->username), 'status=:status', array(':status' => '0'));
            if ($record === null)
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            else if ($record->password !== $this->password)
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            else {
                $this->_id = $record->id;

                $this->setState("id", $record->id);
                $this->errorCode = self::ERROR_NONE;
            }
            return !$this->errorCode;
        }
        if ($this->userType == 'Admin') {
            $record = IntLogin::model()->findByAttributes(array('username' => $this->username), 'status=:status', array(':status' => '1'));
            if ($record === null)
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            else if ($record->password !== $this->password)
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            else {
                $this->_id = $record->id;

                $this->setState("id", $record->id);
                $this->setState('isAdmin', 1);
                $this->errorCode = self::ERROR_NONE;
            }
            return !$this->errorCode;
        }
        if ($this->userType == 'SAdmin') {
            $record = IntLogin::model()->findByAttributes(array('username' => $this->username), 'status=:status', array(':status' => '2'));
            if ($record === null)
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            else if ($record->password !== $this->password)
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            else {
                $this->_id = $record->id;

                $this->setState("id", $record->id);
                $this->setState('isSAdmin', 1);
                $this->errorCode = self::ERROR_NONE;
            }
            return !$this->errorCode;
        }
    }

    public function getId() {
        return $this->_id;
    }

}