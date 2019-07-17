<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Торговое предложение';
?>


<section class="headerContent torgPredl" style="background-image:url('<?=Yii::$app->request->baseUrl?>/img/backHeadTorg.png')">
  <div class="bgShadow"></div>
  <div class="container">
  <div class="row pt150">
  <div class="col-md-12 text-center text-white  text-md-left">
  <h2 class="t25 upc text-center"><a href="<?=Url::to(['site/reg'], true)?>" style="color:#fff">ЗАРЕГИСТРИУЙТЕСЬ</a> В МАНУФАКТОРИНГ</h2>
  <hr class="hr-light">
  <h2 class="t25 upc text-center">ВАМ ОТКРОЕТСЯ УНИКАЛЬНОЕ <br>
ТОРГОВОЕ ПРЕДЛОЖЕНИЕ</h2>
  </div>
  </div>
  </div>
  </section>


  <section class="zebra">
    <div class="container">
      <div class="row text-center textEducation">
          <div class="col-12 col-md-4 mb-5">
            <p><img src="<?=Yii::$app->request->baseUrl?>/img/education.png" alt=""></p>
            <p>Мануфакторинг <br>
предлагает каждому студенту <br>
экономического факультета в России работать, получать <br>
официальный трудовой опыт <br>
и зарабатывать деньги, не выходя <br>
из собственного ВУЗа <br>
и не отрываясь от своей учёбы. </p>
          </div>
          <div class="col-12 col-md-4 mb-5">
            <p><img src="<?=Yii::$app->request->baseUrl?>/img/papers.png" alt=""></p>
            <p>У Вас появится трудовая книжка, реальная заработная плата <br>
и классический МРОТ. <br>
Если Вы уже где-то трудоустроены, то совмещать Вашу работу <br>
с работой в Мануфакторинг <br>
невероятно просто и легко.</p>
          </div>
          <div class="col-12 col-md-4 mb-5">
           <p><img src="<?=Yii::$app->request->baseUrl?>/img/stamp.png" alt=""></p>
           <p>Для каждого из Вас, <br>
мы разработали единую, <br>
инновационную систему <br>
юридических и финансовых <br>
отношений – Мануфакторинг. <br>
Аналогичных предложений <br>
на рынке не существует.</p>
          </div>
      </div>


    </div>
</section>


<section class="openClose">
<div class="container">
<div class="row">
<div class="col-md-12">


</div>
</div>
<div class="row bgOpClose" style="background-image: url('/frontend/web/img/rightImgTorg.png')">


<div class="col-12 col-lg-6">
    <h1 class="t25 card-title">ДЛЯ КАЖДОГО ИЗ ВАС</h5>
<div class="card grey wow fadeInLeft" data-wow-duration="1s">
  <div class="img" style="margin-bottom: 20px; display: none">
    <img src="/frontend/web/img/rightImgTorg.png" alt="" style="width: 100%">
  </div>
    <p class="card-text">Студенты-экономисты бакалавриата, специалитета
и магистратуры редко делают свои курсовые, рефераты,
эссе и дипломные работы самостоятельно. На этом утверждении и будет основываться наше Торговое предложение к каждому зарегистрированному или позвонившему студенту.
В Мануфакторинг абсолютно любой студент экономического
факультета может заработать деньги и официальный опыт.
Без преувеличения. Абсолютно любой.
</p>


  </div>

 </div>



  <div class="col-12 col-md-12 ">
  </div>
  </div>
  <div class="row bgOpClose2 mt-5" style="background-image: url('/frontend/web/img/leftImgTorg.png')">
   <div class="col-12 col-lg-6"></div>

   <div class="col-12 col-lg-6 pt90">
    <h1 class="t25 card-title text-right">УЗНАЙ О ТОРГОВОМ<br>ПРЕДЛОЖЕНИИ</h5>
<div class="card grey text-right wow fadeInRight" data-wow-duration="1s">
  <div class="img" style="margin-bottom: 20px; display: none">
    <img src="/frontend/web/img/leftImgTorg.png" alt="" style="width: 100%">
  </div>
    <p class="card-text"><a href="<?=Url::to(['site/reg'], true)?>">Пройди регистрацию на сайте</a> и узнай о нашем Торговом предложении.  Мы позвоним Вам по телефону сразу после регистрации. Также Вы можете самостоятельно позвонить
по любому из указанных номеров – мы всё расскажем. <br>
<strong>Звонить строго с 10.00 до 21.00 по московскому времени</strong><br>
          <a href="tel:8(928)-035-42-77">8(928)-035-42-77 <i class="fas fa-phone" style="transform: scale(-1, 1)"></i></a><br>
          <a href="tel:8(988)-471-73-18 ">8(988)-471-73-18 <i class="fas fa-phone" style="transform: scale(-1, 1)"></i></a><br>
          <a href="tel:8(982)-237-43-68">8(928)-237-43-68 <i class="fas fa-phone" style="transform: scale(-1, 1)"></i></a><br>
          <a href="https://vk.com/manufactoring" target="_blank"><img src="<?=Yii::$app->request->baseUrl?>/img/vk-brands.svg" style="height: 25px; margin-left:10px" alt=""></a>
          <a href="https://www.youtube.com/channel/UCHWAxmqryFLR5865ClYTObw"><img src="<?=Yii::$app->request->baseUrl?>/img/youtube-brands.svg" style="height: 25px; margin-left:10px"  alt=""></a>
          <!-- <a href="#"><img src="<?=Yii::$app->request->baseUrl?>/img/instagram-brands.svg" style="height: 25px; margin-left:10px"  alt=""></a> -->

</p>


  </div>

 </div>



</div>
</div>
</section>
