<?php

class CabinetController extends BaseController{
    
    public function beforeAction($action) {
	if(Yii::app()->user->isGuest)
	    $this->redirect ('/');
	
	return parent::beforeAction($action);
    }

    public function actionIndex(){
	$this->render('index');
    }
    
}