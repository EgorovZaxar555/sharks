<div class="category col-md-3">

    <div class="search">
        <form method="get" action="<?= \yii\helpers\Url::to(['article/search'])?>">
            <input type="search" name="q">
        </form>
    </div>

        <h4 class="category-head text-center">Рубрики</h4>
        <div class="category_title">
            <div class="category_title_lint">
            <?php foreach ($category as $category): ?>
            <div class="link"><a href="<?= \yii\helpers\Url::to(['site/category', 'id'=>$category->id])?>">
            <?= $category->name?>...................<?=$category->getArticlesCount();?></a></div>
            <?php endforeach;?>
        </div>
    </div>
</div>