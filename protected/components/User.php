<?php

class User extends CWebUser{
    
    public $username;
    public $surname;
    public $otchestvo;
    
    public function login($identity, $duration = 0) {
	$result = parent::login($identity, $duration);
	if(!$result)
	    return $result;
	$session = Yii::app ()->getSession ();
	$info = UserInfo::model()->findByAttributes([ 'user_id' => $identity->getId() ]);
	$session ['username'] = $info->name;
	$session ['surname'] = $info->surname;
	$session ['otchestvo'] = $info->otchestvo;
	return $result;
    }
    
    public function getUsername(){
	return Yii::app()->session['username'];
    }
    
    public function setUsername($username){
	return Yii::app()->session['username'] = $username;
    }
    
    public function getSurname(){
	return Yii::app()->session['surname'];
    }
    
    public function setSurname($surname){
	return Yii::app()->session['surname'] = $surname;
    }
    
    public function getOtchestvo(){
	return Yii::app()->session['otchestvo'];
    }
    
    public function setOtchestvo($otchestvo){
	return Yii::app()->session['otchestvo'] = $otchestvo;
    }
    
    public function getBalance(){
	return 0;
    }
    
    public function getBlockBalance(){
	return 0;
    }
    
    public function getBalanceInter(){
	return 0;
    }
}