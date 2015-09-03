<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseController extends CController{

    public function beforeAction($action) {
	Yii::app()->clientScript->registerCoreScript('jquery');
	return parent::beforeAction($action);
    }
    
}