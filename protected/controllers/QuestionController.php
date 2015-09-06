<?php

class QuestionController extends BaseController{
    
    public function actionIndex(){
	$this->render('list', [
	    'data' => QuestionModel::model()->topical()->findAll()
	]);
    }

    public function actionAdd(){
	$model = new QuestionModel();
	$msg = '';
	if(!empty($_POST['QuestionModel'])){
	    $model->attributes = $_POST['QuestionModel'];
	    if($model->validate()){
		$model->user_id = Yii::app()->user->getId();
		$model->save();
		$msg = 'Спасибо за Ваш вопрос. Стоимость вопроса ' . $model->getCost();
	    }
	}
	$this->render('add', [ 'model' => $model, 'msg' => $msg ]);
    }
    
    public function actionList(){
	$this->render('list', [ 
		'data' => QuestionModel::model()->current()->findAll( [ 'order' => 'date_add DESC' ] )
	    ]);
    }
    
    public function actionPay($q_id){
	// ToDo Pay for question
	echo $q_id;
    }
    
    public function actionDelete(){
	
    }
}