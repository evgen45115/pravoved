<?php

class SiteController extends BaseController{
    
    public function actionIndex(){
	$this->render('index');
    }
    
    public function actionJurist(){
	$this->render('jlist', [
	    'lists' => UserModel::model()->jurist()->findAll()
	]);
    }

    public function actionError(){
	if($error=Yii::app()->errorHandler->error)
	    $this->render('error', $error);
    }
}