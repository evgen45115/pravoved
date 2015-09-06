<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseController extends CController{
    
    const ROLE_CLIENT = 'client';
    const ROLE_JURIST = 'jurist';
    const ROLE_GUEST = 'guest';
    const ROLE_ALL = 'all';

    public function beforeAction($action) {
	Yii::app()->clientScript->registerCoreScript('jquery');
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
	return parent::beforeAction($action);
    }
    
}