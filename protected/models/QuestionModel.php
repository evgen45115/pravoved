<?php

/**
 * This is the model class for table "question".
 *
 * The followings are the available columns in table 'question':
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property string $text
 * @property string $type
 * @property string $cost
 * @property string $status
 * @property date $date_add
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property SummaryQuestionOptions[] $activeOptions
 */
class QuestionModel extends CActiveRecord{
    
    public $options = [];

    public $type = self::TYPE_PAY;
	
    const TYPE_PAY = 'pay';
    const TYPE_FREE = 'free';
    
    const STATUS_NEW = 'new';
    const STATUS_PAID = 'paid';
    const STATUS_PROCESSING = 'processing';
    const STATUS_CLOSE = 'close';
    const STATUS_DELETE = 'delete';

    public $arr_type = [
	    self::TYPE_PAY => 'Платный вопрос',
	    self::TYPE_FREE => 'Бесплатный вопрос'
	];
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title, text, type', 'required'),
			array('title', 'length', 'max'=>255),
			array('cost', 'safe')
		);
	}
	
	public function topical(){
	    $criteria = new CDbCriteria();
	    $criteria->addInCondition('`status`', [
		self::STATUS_PAID,
		self::STATUS_PROCESSING,
		self::STATUS_CLOSE
	    ] );
	    
	    $this->getDbCriteria()->mergeWith($criteria);
	    
	    return $this;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'activeOptions' => array(self::HAS_MANY, 'SummaryQuestionOption', [ 'question' => 'id' ])
		);
	}
	
	public function beforeSave() {
	    if($this->isNewRecord)
		$this->date_add = new CDbExpression('NOW()');

	    return parent::beforeSave();
	}
	
	public function current(){
	    $criteria = new CDbCriteria();
	    $criteria->condition = 'user_id =:id';
	    $criteria->params = [ 'id' => Yii::app()->user->getId() ];
	    
	    $this->getDbCriteria()->mergeWith($criteria);
	    
	    return $this;
	}

	public function afterSave() {
	    if(!empty($_POST[__CLASS__]['options'])){
		SummaryQuestionOption::model()->deleteAll('question =:id', [ ':id' => $this->id ]);
		foreach ($_POST[__CLASS__]['options'] as $option)
		    Yii::app ()->db->createCommand ()->insert ('summary_question_option', [
			'question' => $this->id,
			'option' => $option
			]);
	    }
	    
	    return parent::afterSave();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'title' => 'Тема вопроса',
			'text' => 'Текст вопроса',
			'cost' => 'Цена'
		);
	}

	public function getCost(){
	    $sum = $this->cost;
	    if(!empty($this->activeOptions))
		foreach ($this->activeOptions as $option)
		    $sum += $option->opts->cost;
	    return $sum;
	}
	
	public function getStatus(){
	    switch ($this->status){
		case self::STATUS_NEW:
		    $str = 'Новый вопрос, ожидает оплаты, для оплаты перейдите по ' . CHtml::link('ссылки', [ 'question/pay',  'q_id' => $this->id ]);
		    break;
		case self::STATUS_PAID:
		    $str = 'Вопрос ожидает ответа юриста';
		    break;
		case self::STATUS_PROCESSING:
		    $str = 'Вопрос ожидает Вашего подтверждения';
		    break;
		case self::STATUS_CLOSE:
		    $str = 'Вопрос закрыт';
		    break;
		case self::STATUS_DELETE:
		    $str = 'Вопрос удален, поидеи не должно отображаться';
		    break;
		default :
		    $str = 'Ошибка статуса, свяжитесь с администрацией';
	    }
	    return $str;
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return QuestionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}