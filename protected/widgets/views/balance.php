<div class="block profile">
    <div class="block_head">Мой аккаунт</div>
    <div>Ваш баланс <?php echo Yii::app()->user->getBalance();?></div>
    <div>Блокировано <?php echo Yii::app()->user->getBlockBalance();?></div>
    <div>Внутренняя валюта <?php echo Yii::app()->user->getBalanceInter();?></div>
    <div><?php echo CHtml::link('Пополнить');?></div>
</div>