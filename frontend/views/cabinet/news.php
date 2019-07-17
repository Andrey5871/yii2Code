<!-- NEWSBEGIN -->
<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
$session = Yii::$app->session;
$session->open();
$this->title = "Новости";

?>
<?php if ($session->get("hash") != NULL): ?>
				<div class="news">
					<div class="row">
          <div class="col-12 titleContent text-left">
            <h2>Новости</h2>
          </div>
        </div>
            <?php foreach ($news as $key => $valueNews): ?>
                <div class="post">
        <div class="row">
            <div class="col-12 col-md-6 text-center imgNews">
                <?php if ($valueNews['img'] == ""): ?>
                    <i class="far fa-image"></i>
                    <?php else: ?>
                        <img src="/common/img/<?=$valueNews['img']?>" alt="">
                <?php endif ?>
            </div>
            <div class="col-12 col-md-6 rightNews">
                    <h2 class="titleNews"><?=$valueNews['title']?></h2>
                    <p class="content"><?=$valueNews['minDesc']?></p>
                    <p class="date"><?=date("d.m.Y H:i", strtotime($valueNews['dateUpdate']))?></p>
                    <a href="<?=Url::to(['cabinet/post', 'id'=> $valueNews['id']])?>" class="more">Подробнее</a>
            </div>
        </div>
    </div>
            <?php endforeach ?>
                
            <?php
                        // отображаем постраничную разбивку
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                     ?>

    </div>
<?php else: ?>
<script>
              location.href = '<?=Url::to(['site/index'])?>';
            </script>
	<?php endif;?>

<!-- NEWSEND -->
