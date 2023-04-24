<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Article';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="/web/css/newstyle.css">
 <div class="body-content">
    <div class="articles-category row">
        <div class="arcticle_page">
            <div class="article_about"> 
                <h3><?= $articles->title?></h3>
                <div class="text-info">
                    <p>Автор - <span><?= $articles->user->fio?></span></p>
                    <p>Дата - <span><?= $articles->date?></span></p>
                </div>
                <p>
                    <div class="col-md-4 image-article"><img src="/web/images/articles/<?= $articles->image?>" alt=""></div>
                    <div align="justify"><?= $articles->text?></div>
                </p>
            </div>
            <?php if(!empty($comments)): ?>
                <?php foreach($comments as $comment): ?>
                    <div class="user_comment row">
                        <div class="user_img col-md-1"><img src="" alt="" width="50px"></div>
                        <div class="user_info col-md-10">
                            <h4><?= $comment->user->fio?></h4>
                            <p class="date_comment"><?= $comment->date;?></p>
                            <p><?= $comment->text;?></p>
                        </div>
                    </div>        
                <?php endforeach;?>
            <?php endif;?>
            <?php if(!Yii::$app->user->isGuest):?>
                <?php $form= \yii\widgets\ActiveForm::begin(['action'=>['site/comment', 'id'=>$articles->id],
            'options'=>['class'=>'blog_comment col-md-8', 'role'=>'form']])?>
         
                <h3>Добавить комментарий</h3>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($commentForm, 'comment')->textarea(['class'=>'input', 'placeholder'=>'Напишите комментарий'])->label(false)?>
                        <!-- <textarea type="text" class="input" placeholder="Напишите комментарий" v-model="newItem" @keyup.enter="addItem()"></textarea> -->
                        <button type="submit" class="primaryContained" float-right>Добавить</button>
                    </div>
                </div>
            <?php \yii\widgets\ActiveForm::end();?>
            <?php endif;?>
        </div>
        <?= $this->render('/sidebar/sidebar', [
                 'category' => $category,
            ]);?>

    </div>
</div>

