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
            
                <div class="post">
        <div class="row">
            <div class="col-12 rightNews">
                    
                    <?php if ($news['img'] == ""): ?>
                    <i class="far fa-image"></i>
                    <?php else: ?>
                        <img src="/common/img/<?=$news['img']?>" align="left" style="max-width:500px; margin-right:20px" alt="<?=$news['title']?>">
                <?php endif ?>
                <h2 class="titleNews"><?=$news['title']?></h2>
                    <p class="content"><?=$news['description']?></p>
                    <p class="date"><?=date("d.m.Y H:i", strtotime($news['dateUpdate']))?></p>
            </div>
        </div>
    </div>
           
                
                <div class="row bottomNews">
                    <?php foreach ($newsLast as $valueNewsLast): ?>
                           <div class="col-12 col-md-4 text-center">
                        
                        <div class="img">
                            <?php if ($valueNewsLast['img'] == ""): ?>
                    <i class="far fa-image"></i>
                    <?php else: ?>
                        <img src="/common/img/<?=$valueNewsLast['img']?>" alt="<?=$valueNewsLast['title']?>">
                <?php endif ?>
                        </div>
                        <div class="title">
                            <a href="<?=Url::to(['cabinet/post', 'id'=> $valueNewsLast['id']])?>"><?=$valueNewsLast['title']?></a>
                        </div>
                            </div>  
                    <?php endforeach ?> 
                </div>

    </div>
<?php else: ?>
<script>
              location.href = '<?=Url::to(['site/index'])?>';
            </script>
	<?php endif;?>

<!-- NEWSEND -->
