<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $text
 * @property int $idUser
 * @property int $idArticle
 * @property string $date
 *
 * @property Article $idArticle0
 * @property User $idUser0
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'idUser', 'idArticle', 'date'], 'required'],
            [['text'], 'string'],
            [['idUser', 'idArticle'], 'integer'],
            [['date'], 'safe'],
            [['idArticle'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['idArticle' => 'id']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'idUser' => 'Id User',
            'idArticle' => 'Id Article',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[IdArticle0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdArticle0()
    {
        return $this->hasOne(Article::className(), ['id' => 'idArticle']);
    }

    /**
     * Gets query for [[IdUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }

    public function getData()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

}
