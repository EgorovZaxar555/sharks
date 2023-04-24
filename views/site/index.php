<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
<link rel="stylesheet" href="/web/css/newstyle.css">
<div class="site-index">

    <div class="jumbotron">
        <h1>Зона акул</h1>
        <p class="lead">Удивительный мир морских хищников</p>
    </div>
    
    <div class="body-content">
        <div class="articles-category row">
           
            <div class="articles col-md-12">
                <div class="last-articles">Последние статьи</div>
                <div class="popular_articles">
                    <?php foreach ($populars as $article):?>
                    <div class="popular_article col-md-4">
                        <h4><?= $article->title?></h4>
                        <div class="popular_article_image"><a href="<?= \yii\helpers\Url::to(['site/article', 'id'=>$article->id])?>"><img src="/web/images/articles/<?= $article->image?>" alt=""></a></div>
                    </div>
                    <?php endforeach;?>
                </div>

                <div class="article_block">
                    <?php foreach ($articles as $article):?>
                    <div class="article row">
                        <div class="col-md-4 image-article"><a href="<?= \yii\helpers\Url::to(['site/article', 'id'=>$article->id])?>">
                        <img src="/web/images/articles/<?= $article->image?>" alt=""></a></div>
                        <div class="col-md-7">
                            <h3><?= $article->title?></h3>
                            <p><?=$string = substr($article->text , 0, 200); ?></p>
                            <div class="col-md-12">
                                <div class="text-info">
                                    <p>Автор - <span><?= $article->user->fio?></span></p>
                                    <p>Дата - <span><?= $article->date?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <?= \yii\widgets\LinkPager::widget(['pagination'=>$pages])?>
                </div>
            </div>
            <?= $this->render('/sidebar/sidebar', [
                 'category' => $category,
            ]);?>
        </div>
    </div>
</div>


