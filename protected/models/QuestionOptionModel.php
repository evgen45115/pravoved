<?php

/**
 * This is the model class for table "question_option".
 *
 * The followings are the available columns in table 'question_option':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $group
 * @property string $coast
 *
 * The followings are the available model relations:
 * @property QuestionOptionModel[] $sub_group
 * @property SummaryQuestionOption[] $summaryQuestionOptions
 */
class QuestionOptionModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'question_option';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>255),
			array('group', 'length', 'max'=>20),
			array('coast', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description, group, coast', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'sub_group' => array(self::HAS_MANY, 'QuestionOptionModel', 'group'),
			'summaryQuestionOptions' => array(self::HAS_MANY, 'SummaryQuestionOption', 'option'),
		);
	}
	
	public function getSelectHtml($form_name, $selected = []){
	    $form_name .= '[options][]';
	    $html = '<div class="main">';
	    foreach (self::model()->findAll('`group` IS NULL') as $r){
		$html .= '<div>';
		if(!empty($r->sub_group)){
		    $html .= '<div>' . $r->name . '<br />' . $r->description . '</div>';
		    foreach ($r->sub_group as $sub)
			$html .= '<div>' . $this->_getOptionBlock ($form_name, $selected, $sub, 'radioButton') . '</div>';
		}else
		    $html .= $this->_getOptionBlock ($form_name, $selected, $r);
		
		$html .= '</div>';
	    }
	    
	    return $html . '</div>';
	}
	
	private function _getOptionBlock($form_name, $selected, $option, $class = 'checkBox'){
	    return CHtml::$class ($form_name, in_array ($option->id, $selected), [ 'id' => 'opt_' . $option->id, 'value' => $option->id ] ) . 
		    CHtml::label($option->name, 'opt_' . $option->id) . '<br />' .
		    CHtml::openTag('span') . $option->description . CHtml::closeTag('span') .
		    CHtml::openTag('span', [ 'class' => 'cost' ]) . ($option->cost ? : 'бесплатно') . CHtml::closeTag('span');
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'group' => 'Group',
			'coast' => 'Coast',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('group',$this->group,true);
		$criteria->compare('coast',$this->coast,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return QuestionOptionModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
