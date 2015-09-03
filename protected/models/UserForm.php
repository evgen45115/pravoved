<?php

class UserForm extends CFormModel{
    
    public $name;
    public $email;
    public $type = UserModel::TYPE_CLIENT;
    
    public $surname;
    
    public $pass;

    public function rules(){
	return [
	    [ 'email', 'email' ],
	    [ 'email, name, type', 'required', 'on' => 'reg_client' ],
	    [ 'name, surname, email, type', 'required', 'on' => 'reg_jurist' ],
	    [ 'type', 'in', 'range' => array_keys(UserModel::model()->arr_of_type), 'on' => 'reg_client, reg_jurist' ],
	    [ 'email, pass', 'required', 'on' => 'login' ],
	    [ 'email', 'required', 'on' => 'forget' ],
	    [ 'email', 'exist', 'on' => 'forget', 'className' => 'UserModel', 'attributeName' => 'email', 'message' => 'Данной Электронной почты нет в базе' ]
	];	
    }
    
    public function setAttributes($values, $safeOnly = true) {
	if( $this->getScenario() == 'registration' )
	    if($values['type'] == UserModel::TYPE_JURIST)
		$this->setScenario ('reg_jurist');
	    else
		$this->setScenario ('reg_client');
	
	return parent::setAttributes($values, $safeOnly);
    }
    
    public function attributeLabels() {
	return [
	    'name' => 'Имя',
	    'surname' => 'Фамилия',
	    'email' => 'Электронная почта'
	];
    }
    
    public function login(){
	$identity=new UserIdentity($this->email, $this->pass);
	if($identity->authenticate())
	    return Yii::app()->user->login($identity);
	else{
	    $this->addError('email', $identity->errorMessage);
	    return FALSE;
	}
    }
}