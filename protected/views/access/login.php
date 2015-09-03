    <div class="form">
	<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row">
	    <?php echo CHtml::activeLabel($model,'email'); ?>
	    <?php echo CHtml::activeTextField($model,'email'); ?>
	</div>

	<div class="row">
	    <?php echo CHtml::activeLabel($model,'pass'); ?>
	    <?php echo CHtml::activePasswordField($model,'pass'); ?>
	</div>
	
	<div class="row submit">
	    <?php echo CHtml::submitButton('вход'); ?>
	</div>

	<?php echo CHtml::endForm(); ?>
    </div>