<?php
    if(empty($data))
	echo 'У Вас нет вопросов, для добавления вопроса воспользуйтесь ' . CHtml::link('ссылкой', [ 'question/add' ]);
    else{
	foreach($data as $d){
	    echo '<div style="width:100%; clear: both;">' 
		    . '<span>' . CHtml::link($d->title, [ 'question/view', 'id' => $d->id ]) . '</span>' . '<br />'
		    . '<span>' . substr($d->text, 0, 100) . ( strlen($d->text) > 100 ? '...' : '' ) . '</span>' . '<br />'
		    . '<span>' . $d->getStatus() . '</span>' . '<br />'
		    . '<span>Цена вопроса:' . $d->getCost() . '</span>'
		. '</div>' . '<br />';
	}
    }