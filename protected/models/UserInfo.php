<?php

/**
 * This is the model class for table "user_info".
 *
 * The followings are the available columns in table 'user_info':
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $surname
 * @property string $otchestvo
 * @property string $sex
 * @property string $birtday
 * @property string $city_id
 * @property string $avatar
 */
class UserInfo extends CActiveRecord
{
	public function tableName()
	{
		return 'user_info';
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
