<?php

namespace app\models;

use Yii;
use yii\base\Model;


class CommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return
        [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }



    public function saveComment($idArticle)
    {
        $comment = new Comment;
        $comment->text = $this->comment;
        $comment->idUser = Yii::$app->user->id;
        $comment->idArticle = $idArticle;
        $comment->date = date('Y-m-d');
        return $comment->save();
    }





}
