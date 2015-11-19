<?php
class UserIdentity extends CUserIdentity
{
private $_id;
public function authenticate()
{

$record=Users::model()->findByAttributes(array('login'=>$this->username));

if($record===null)
$this->errorCode=self::ERROR_USERNAME_INVALID;

else if(($this->password!==$record->password))
$this->errorCode=self::ERROR_PASSWORD_INVALID;
else
{
$this->_id=$record->id_user;
$this->setState('title', $record->login);
$this->errorCode=self::ERROR_NONE;
}
return !$this->errorCode;
}

public function getId()
{
return $this->_id;
}
}
?>