<?php

class AccessController extends BaseController{
    
    public function actionRegistration(){
	$msg = '';
	$model = new UserForm('registration');
	if(Yii::app()->request->isPostRequest && !empty($_POST['UserForm'])){
	    $model->setAttributes($_POST['UserForm']);
	    if($model->validate()){
		$user = new UserModel;
		$user->setAttributes([
		    'email' => $model->email,
		    'type' => $model->type,
		    'password' => UserModel::model()->cryptPass( $pass = UserModel::model()->genPassword() ),
		    'hash' =>  $hash = UserModel::model()->genHash($pass)
		], FALSE);
		$user->save();
		$info = new UserInfo;
		$info->setAttributes([
		    'user_id' => $user->id,
		    'name' => $model->name,
		    'surname' => $model->surname
		],FALSE);
		$info->save();
		Yii::app()->email->send($model->email, 'Регистрация', 'Ваш пароль:' . $pass .'. Для подтверждения учетной записи перейдите по ссылке: ' . $this->createAbsoluteUrl('access/accept', [ 'hash' => $hash ]));
		$msg = 'Спасибо за регистрацию! проверти почту';
	    }
	}
	
	$this->render('registration', [ 'model' => $model, 'msg' => $msg ]);
    }
    
    public function actionAccept($hash){
	if(preg_match('/^[A-z0-9]{32}$/', $hash)){
	    $user = UserModel::model()->findByAttributes([ 'hash' => $hash ]);
	    if($user){
		if($user->status == UserModel::STATUS_NEW){
		    $user->status = UserModel::STATUS_ACTIVE;
		    $user->hash = new CDbExpression('NULL');
		    $user->save();
		}
		$this->render('accept');
	    }else
		throw new Exception('Страница не найдена!', 404);
	}else
	    throw new Exception('Страница не найдена!', 404);
    }
    
    public function actionForget(){
	$model = new UserForm('foget');
	$msg = '';
	if(!empty($_POST['UserForm'])){
	    $model->attributes = $_POST['UserForm'];
	    if($model->validate()){
		$user = new UserModel;
		$user->password = UserModel::model()->cryptPass( $pass = UserModel::model()->genPassword() );
		$user->save();
		Yii::app()->email->send($model->email, 'Новый пароль', 'Ваш новый пароль:' . $pass);
		$msg = 'Новый пароль отправлен Вам на почту.';
	    }
	}
	
	$this->render('forget', [ 'model' => $model, 'msg' => $msg ]);
    }

    public function actionLogin(){
	$model = new UserForm('login');
	if(!empty($_POST['UserForm'])){
	    $model->attributes = $_POST['UserForm'];
	    if($model->validate() && $model->login())
		$this->redirect ( [ 'cabinet/' ] );
	}
	if(Yii::app()->request->isAjaxRequest)
	    $this->renderPartial ('login', [ 'model' => $model ]);
	else
	    $this->render('login', [ 'model' => $model ]);
    }

    public function actionLogout(){
	Yii::app()->user->logout();
	$this->redirect( '/' );
    }
}