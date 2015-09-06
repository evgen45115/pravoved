<?php if(!empty($msg)): ?>
    <?php echo '<h1>'.$msg.'</h1>'; ?>
<?php else: ?>
    <div class="form">
	<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($model); ?>
	
	<?php echo CHtml::activeRadioButtonList($model, 'type', UserModel::model()->arr_of_type);?>

	<div class="row">
	    <?php echo CHtml::activeLabel($model,'name'); ?>
	    <?php echo CHtml::activeTextField($model,'name'); ?>
	</div>

	<div class="row" id="surname" style="display: none;">
	    <?php echo CHtml::activeLabel($model,'surname'); ?>
	    <?php echo CHtml::activeTextField($model,'surname'); ?>
	</div>

	<div class="row">
	    <?php echo CHtml::activeLabel($model,'email'); ?>
	    <?php echo CHtml::activeTextField($model,'email'); ?>
	</div>

	<div class="row submit">
	    <?php echo CHtml::submitButton('Регистрация'); ?>
	</div>

	<?php echo CHtml::endForm(); ?>
    </div>
    <script>
	$(document).ready(function(){
	    $('input:radio').change(function(){
		check($(this).val());
	    });
	    check($('input:radio:checked').val());
	});
	
	function check(val){
	    if(val == '<?php echo UserModel::TYPE_CLIENT;?>')
		$('#surname').hide();
	    else
	        $('#surname').show();
	}
    </script>
<?php endif;?>