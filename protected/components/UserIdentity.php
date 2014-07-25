<?php

class UserIdentity extends CUserIdentity
{
    private $_id;
    public $email;

    public function authenticate()
    {
        $username=strtolower($this->username);
        $user=User::model()->find('LOWER(email)=?',array($username));

        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if (!bCrypt::verify($this->password, $user->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$user->id;
            $this->email=$user->email;
            $this->setState('role', $user->role);
            $user->saveAttributes(array(
                'last_login_time'=>date("Y-m-d H:i:s", time()),
            ));
            $this->errorCode=self::ERROR_NONE;
        }

        return $this->errorCode==self::ERROR_NONE;
    }

    public function getId()
    {
        return $this->_id;
    }
}