<?php

class UserModel extends CActiveRecord{
    
    public $id;
    public $email;
    public $password;
    public $type;
    public $status;
    public $date_add;
    public $hash;

    const TYPE_CLIENT = 'client';
    const TYPE_JURIST = 'jurist';
    
    public $arr_of_type = [
	self::TYPE_CLIENT => 'Клиент',
	self::TYPE_JURIST => 'Юрист'
    ];
    
    const STATUS_NEW = 'new';
    const STATUS_NOT_CONFIRM = 'not_confirm';
    const STATUS_ACTIVE = 'active';
    const STATUS_DELETE = 'delete';
    
    private $_salt = 'eyFn9vNgjkYv7frx8';
    
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }
    
    public function tableName() {
	return 'users';
    }
    
    public function beforeSave() {
	if($this->isNewRecord){
	    $this->date_add = new CDbExpression ('NOW()');
	    $this->status = self::STATUS_NEW;
	}
	
	return parent::beforeSave();
    }
    
    public function genPassword($lenght = 8){
	$chars='qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP';
	$size = strlen($chars) - 1;
	$pass = '';
	
	for($i = 0; $i < $lenght; $i++)
	    $pass .= $chars[rand(0,  $size)];
	
	return $pass;
    }
    
    public function cryptPass($pass){
	return sha1( sha1($this->_salt) . sha1($pass) . $this->_salt );
    }
    
    public function genHash($pass){
	return md5(($this->_salt.$pass).$pass);
    }
    
    public function validatePassword($pass){
	return $this->cryptPass($pass) == $this->password && $this->status == self::STATUS_ACTIVE;
    }
}