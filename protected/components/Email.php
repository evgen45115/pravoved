<?php

class Email extends CComponent{
    
    public function init(){}

    public function send($to, $subject, $message){
	return mail($to, $subject, $message);
    }
}