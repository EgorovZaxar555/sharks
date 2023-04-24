<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string $image
 * @property string $date
 * @property int $idCategory
 * @property int $idUser
 * @property int $views
 * @property int $comments
 *
 * @property Category $idCategory0
 * @property User $idUser0
 * @property Comment[] $comments0
 */
class ArticleCreateForm extends Article
{
  
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'image', 'idCategory', 'idUser', 'image'], 'required'],
            [['text', 'image'], 'string'],
            [['date'], 'safe'],
            [['idCategory', 'idUser', 'views', 'comments'], 'integer'],
            ['image', 'file', 'extensions' => 'png, jpg, jpeg, bmp', 'maxSize' => 10 * 1024 * 1024],
            [['title'], 'string', 'max' => 255],
            [['idCategory'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['idCategory' => 'id']],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUser' => 'id']],
        ];
    }
}
