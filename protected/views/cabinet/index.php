<div style="width: 100%;">
    <div style="width: 100%; clear: both; height: 50px;"><?php echo CHtml::link('Мои вопросы', [ 'question/list' ])?></div>
    <div style="width: 30%; float: left; clear: left;">
	<?php $this->widget('ProfilePanel'); ?>
    </div>
    <div style="width: 70%; float: right; height: 100%; clear: right;">
	Общая информация, блоки и ссылки на задать вопрос
	<?php echo CHtml::link('Задать вопрос', [ 'question/add' ]);?>
    </div>
    <div style="width: 30%; float: left; clear: left">
	<?php $this->widget('BalancePanel'); ?>
    </div>
</div>