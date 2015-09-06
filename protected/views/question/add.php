<?php
/* @var $this QuestionModelController */
/* @var $model QuestionModel */
/* @var $form CActiveForm */
?>
<?php if(!empty($msg)):?>
    <?php echo $msg;?>
<?php else:?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'question-model-add-form',
	'enableAjaxValidation'=>false
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text'); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
	    <?php echo $form->radioButtonList($model, 'type', QuestionModel::model()->arr_type);?>
	</div>
    
	<div class="row" id="cost">
		<?php echo $form->labelEx($model,'cost'); ?>
		<?php echo $form->textField($model,'cost'); ?>
		<?php echo $form->error($model,'cost'); ?>
	</div>

	<?php echo QuestionOptionModel::model()->getSelectHtml('QuestionModel', (!empty($_POST['QuestionModel']) && !empty($_POST['QuestionModel']['options']) ? $_POST['QuestionModel']['options'] : []));?>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>

<?php $this->endWidget(); ?>
    <script>
	$(document).ready(function(){
	    $('input:radio').change(function(){
		check($(this).val());
	    });
	    check($('input:radio:checked').val());
	});
	
	function check(val){
	    if(val == '<?php echo QuestionModel::TYPE_FREE?>')
		$('#cost').hide();
	    else
	        $('#cost').show();
	}
    </script>
</div>
<?php endif;?>