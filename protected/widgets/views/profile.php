<div class="block profile">
    <div class="block_head">Мой профиль</div>
    <div class="avatar">Аватар<br /><?=Yii::app()->user->getUsername()?><br /><?=Yii::app()->user->getSurname();?></div>
    <div class="edit"><a>Редактировать</a></div>
    <div class="rating">Рейтинг</div>
    <div class="reviews">Отзывы</div>
</div>