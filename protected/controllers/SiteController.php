<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SiteController extends BaseController{
    
    public function actionIndex(){
	$this->render('index');
    }
    
    public function actionError(){
	if($error=Yii::app()->errorHandler->error)
	    $this->render('error', $error);
    }
}