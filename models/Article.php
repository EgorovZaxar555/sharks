<?php

namespace app\models;

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
 * @property int|null $views
 * @property int $comments
 *
 * @property Category $idCategory0
 * @property User $idUser0
 * @property Comment[] $comments0
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'image', 'idCategory', 'idUser', 'comments'], 'required'],
            [['text', 'image'], 'string'],
            [['date'], 'safe'],
            [['idCategory', 'idUser', 'views', 'comments'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['idCategory'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['idCategory' => 'id']],
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
            'title' => 'Название',
            'text' => 'Описание',
            'image' => 'Фото',
            'date' => 'Дата',
            'idCategory' => 'Категория',
            'idUser' => 'Id User',
            'views' => 'Views',
            'comments' => 'Comments',
        ];
    }

    /**
     * Gets query for [[IdCategory0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'idCategory']);
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

    /**
     * Gets query for [[Comments0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['idArticle' => 'id']);
    }



    public static function getAll()
    {
        $query = Article::find();
        $pages = new \yii\data\Pagination(['totalCount'=>$query->count(), 'pageSize'=>4]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->all();

        $data['articles'] = $articles;
        $data['pages'] = $pages;

        return $data;
    }

    public static function getPopular()
    {
        return Article::find()->orderBy(['date' => SORT_DESC])->limit(3)->all();
    }


    
}
