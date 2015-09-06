<?php
if(!empty($lists))
    foreach($lists as $j){
	echo '<div style="width:100%; clear: both;">' 
		. '<span>' . $j->info->fio() . '</span>'
	    . '</div>' . '<br />';
    }