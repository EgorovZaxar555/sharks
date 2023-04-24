<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $fio
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $admin
 *
 * @property Comment[] $comments
 */
class RegForm extends User
{
    public $passwordConfirm;
    public $agree;
  
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'login', 'email', 'password', 'passwordConfirm', 'agree'], 'required',  'message'=>'Нужно заполнить'],
            ['fio', 'match', 'pattern'=>'/^[А-Яа-я\s\-]{3,}$/u',  'message'=>'Только русские'],
            ['login', 'match', 'pattern'=>'/^[a-zA-Z]{1,}$/u',  'message'=>'Только инглиш'],
            ['login', 'unique', 'message'=>'Такой логин уже есть'],
            ['email', 'email', 'message'=>'Некоректный email'],
            ['passwordConfirm', 'compare', 'compareAttribute'=>'password', 'message'=>'Пароли должны совпадать'],
            ['agree', 'boolean'],
            ['agree', 'compare', 'compareValue'=>true, 'message'=>'Нужно согласиться'],
            [['admin'], 'integer'],
            [['fio', 'login', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'passwordConfirm' => 'Подтверждение пароля',
            'agree' => 'Согласие',
            'admin' => 'Admin',
        ];
    }
}
