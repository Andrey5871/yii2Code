<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
$session = Yii::$app->session;
AppAsset::register($this);
$session->open();

?>

  <?php $this->beginPage() ?>
<?php $this->endBody() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(53448394, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/53448394" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
<body>
<?php $this->beginBody() ?>

<header>
  <div class="bgHeadMenu"></div>
  <nav class="navbar navbar-expand-xl text-white">
    <a class="navbar-brand" href="<?=Url::to(['site/index'])?>">Мануфакторинг</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars" style="color:#fff"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin:0 auto;">
      <ul class="navbar-nav mr-auto" style="margin:0 auto;">
        <li class="nav-item">
          <?php if (Yii::$app->controller->action->id == "salesoffer"): ?>
              <a class="nav-link active" href="<?=Url::to(['site/salesoffer'], true)?>">Торговое предложение </a>
              <?php else: ?>
                <a class="nav-link" href="<?=Url::to(['site/salesoffer'], true)?>">Торговое предложение </a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <?php if (Yii::$app->controller->action->id == "money2200"): ?>
              <a class="nav-link active" href="<?=Url::to(['site/money2200'], true)?>">2200</a>
            <?php else: ?>
              <a class="nav-link" href="<?=Url::to(['site/money2200'], true)?>">2200</a>
              <?php endif; ?>

        </li>
        <li class="nav-item">
          <?php if (Yii::$app->controller->action->id == "money1100"): ?>
          <a class="nav-link active" href="<?=Url::to(['site/money1100'], true)?>">1100</a>
          <?php else: ?>
            <a class="nav-link" href="<?=Url::to(['site/money1100'], true)?>">1100</a>
            <?php endif; ?>
        </li>
      <li class="nav-item">
        <?php if (Yii::$app->controller->action->id == "globaldata"): ?>
            <a class="nav-link active" href="<?=Url::to(['site/globaldata'], true)?>">Глобальные данные</a>
          <?php else: ?>
            <a class="nav-link" href="<?=Url::to(['site/globaldata'], true)?>">Глобальные данные</a>
            <?php endif; ?>

        </li>
      </ul>
        <div class="rightAuth text-center">
            <div class="userIcons text-center">
                <img src="<?=Yii::$app->request->baseUrl?>/img/authUserIcons.png" alt="">
            </div>
            <div class="authHref">
              <?php if ($session->get('hash') == NULL): ?>
                    <a href="<?=Url::to(['site/login'], true)?>">Вход</a> / <a href="<?=Url::to(['site/reg'], true)?>">Регистрация</a>
                    <?php else: ?>

                      <p><a href="<?=Url::to(['cabinet/index'])?>">Личный кабинет</a> (<a href="<?=Url::to(['site/logout'], true)?>">Выйти</a>)</p>

              <?php endif ?>

            </div>
        </div>


    </div>
  </nav>
</header>

<div class="contents">
  <div class="wrapp">
    <?php
    $date = new DateTime($session->get('year'));
    $now = new DateTime();
    $interval = $now->diff($date);
     ?>
  <?php if ($session->get("hash") == NULL): ?>
                <?= $content ?>
  <?php else: ?>
            <?php if (Yii::$app->controller->id == "site"): ?>

                                  <?= $content ?>
                <?php else: ?>

                          <div class="container cabinet">
  <div class="row">
    <div class="col-12 col-md-3">
      <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                  <div class="icon editProfile">
                  <img src="<?=Yii::$app->request->baseUrl?>/img/settings.png" alt="norify">
                </div>
              </div>
              <div class="col-6">

              </div>
            </div>
            <div class="row">
                  <div class="col-12 text-center avatars">
                    <div class="avatar" style="background-image: url(/frontend/web/img/upload/<?=$session->get('img')?>)">
                          <div class="edit">
                              <p>Изменить</p>
                          </div>
                    </div>
                  </div>
            </div>
            <div class="row pt-5 text-center userInfo">
              <div class="col-12">
                <p class="nameUser">
                  <b><?=$session->get('nameUser')?></b> (<?=$interval->y?>)
                </p>

              </div>
            </div>

            <div class="row leftMenu">
              <div class="col-12">
                <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="<?=Url::to(['cabinet/index'])?>"><i class="fas fa-users" style="padding-right:10px;"></i>Таблица клиентов</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link statistic" href="<?=Url::to(['cabinet/statistic'])?>"><i class="fas fa-chart-line" style="padding-right:10px;"></i>Статистика</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link news" href="<?=Url::to(['cabinet/news'])?>"><i class="far fa-newspaper" style="padding-right:10px;"></i>Новости  <?php if (Yii::$app->params['countNews'] != 0): ?>
                      <span style="float:right" class="badge badge-dark badge-pill"><?=Yii::$app->params['countNews']?></span>
                  <?php endif; ?></a>
                </li>
              </ul>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- TABLECLIENTSBEGIN -->
    <div class="col-12 col-md-9 content">
      <?= $content ?>

    </div>
    <!-- TABLECLIENTSEND -->
  </div>
</div>
</div>
  <script>
  jQuery(document).ready(function($) {
    $(".pagination .prev a, .pagination .prev span").html('<i class="fas fa-chevron-left"></i>');
    $(".pagination .next a, .pagination .next span").html('<i class="fas fa-chevron-right"></i>');

    $(".cabinet .editRow").click(function(){
      var href = $(this).children("a").attr("href");
      location.href = href;
    });
    $(".cabinet .deleteRow").click(function(event) {
      var idClients = $(this).attr("idClients");
      var el = $(this);
      var conf = confirm("Вы действительно хотите удалить запись?");
      if (conf == true) {
          $.ajax({
                  url: '<?=Url::to(['cabinet/index', 'delete'=>'del'])?>',
                  type: 'POST',
                  data: {"_csrf-frontend": '<?=Yii::$app->request->getCsrfToken()?>', id:idClients},
                   beforeSend: function(){
                        el.parent().parent().before("<td class='loadTable' colspan=6><p class='text-center'> <img src='<?=Yii::$app->request->baseUrl?>/img/load.gif'></p></td>");
                            }
                          })
                  .done(function(data) {
                    $(".loadTable").remove();
                              el.parent().parent().html("<td colspan=6><p class='text-center'>Запись удалена</p></td>");
                          })
                 .fail(function() {
                   console.log("непридвиденная ошибка");
                 });
      }else{

      }

    });





          $(".editProfile").click(function(){
            $(this).addClass("active");
              $.ajax({
                      url: '<?=Url::to(['cabinet/editprofile', 'edit'=>'profile'])?>',
                      type: 'POST',
                      data: {"_csrf-frontend": '<?=Yii::$app->request->getCsrfToken()?>', idUser:<?=$session->get('userId')?>},
                       beforeSend: function(){
                         $(".content").html("<div class='text-center' style='width:100%; height: 100%; position:relative;'><img style='margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);' src='<?=Yii::$app->request->baseUrl?>/img/load.gif'>");
                                }
                              })
                      .done(function(data) {
                        var beginCityResult = data.indexOf("<!-- BEGINEDITPROFILEUSERS -->");
                         var endCityResutl = data.indexOf("<!-- ENDEDITPROFILEUSERS -->");
                         var result = data.substring(beginCityResult, endCityResutl);
                            $(".content").html(result);
                              })
                     .fail(function() {
                       console.log("Непридвиденная ошибка");
                     });

          });

          $(".avatar").click(function(){
                $('#exampleModal').modal('show');
                $.ajax({
                        url: '<?=Url::to(['cabinet/photoedit'])?>',
                        type: 'POST',
                        data: {"_csrf-frontend": '<?=Yii::$app->request->getCsrfToken()?>', idUser:<?=$session->get('userId')?>},
                         beforeSend: function(){
                           $("#exampleModal .modal-body").html("<div class='text-center' style='width:100%; height: 100%; position:relative;'><img style='margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);' src='<?=Yii::$app->request->baseUrl?>/img/load.gif'>");
                                  }
                                })
                        .done(function(data) {
                          var beginPhotoResult = data.indexOf("<!-- PHOTOUPLOADBEGIN -->");
                           var endPhotoResutl = data.indexOf("<!-- PHOTOUPLOADEND -->");
                           var result = data.substring(beginPhotoResult, endPhotoResutl);
                              $("#exampleModal .modal-body").html(result);
                                })
                       .fail(function() {
                         console.log("Непридвиденная ошибка");
                       });
          });

          $(".cabinet .avatar").hover(function(){
              $(".cabinet .avatar .edit").css({
                "transform":"translateY(0)"
              });
          }, function(){
            $(".cabinet .avatar .edit").css({
              "transform":"translateY(100px)"
            });
          });

          $(".cabinet .icon").hover(function(){
              $(this).css({
                "background-color":"#2f2f2f"
              });
              $(this).children("img").css({
                "-webkit-filter": "invert(100%)",
                  "filter": "invert(100%)"
              });
          }, function(){
            $(this).children("img").css({
              "-webkit-filter": "invert(0)",
                "filter": "invert(0)"
            });
            $(this).css({
              "background-color":"#fff"
            });
          });







  });


</script>
            <?php endif ?>

<?php endif; ?>
</div>
<footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
            <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="pull-left"><a href="tel:8(928)-035-42-77">8(928)-035-42-77</a></p>
           <p class="pull-left"><a href="<?=Url::to(['site/policy'], true)?>">Политика конфиденциальности</a></p>  
        </div>
          <div class="col-12 col-lg-6 text-center">
            <div class="row">
                <div class="col-lg-8"></div>

            </div>

            <div class="row mt-3">
               <div class="col-lg-8"></div>
            <div class="col-lg-4">
                <div style="display:block">
                  <a href="http://stgconsult.ru" target="_blank">
                  <div class="row" style="width:125px">
                    <div class="col-6" style="border-right:solid 2px #fff; padding-right:45px">
                        <img  src="<?=Yii::$app->request->baseUrl?>/img/stgWhite.svg" style="width:40px; padding-top:5px" alt="Создание и продвижение">
                    </div>
                    <div class="col-6" style="padding:0px; padding-left:5px">
                      <div style="display:block; font-weight:lighter; font-size:15px; color:#fff !important; text-align: left">
                          <span id="stgType">Продвижени</span>
                      </div>
                    </div>
                  </div>
               </a>
                </div>

              </div>
            </div>

          </div>
      </div>

    </div>
</footer>
<script>

  $(document).ready(function(){
    $("#stgType").typed({
    strings: ["Разработка", "Продвижение"],
    typeSpeed: 70,
    backDelay: 1500,
    startDelay: 2500,
    loop: true,
    loopCount: 100,
    contentType: 'html',
    });
  });


</script>
 <script>
              new WOW().init();


              </script>

              <script type="text/javascript">
                  $(document).ready(function(){
                    var width = $("header .navbar ul li a.active").width();
                    $("header .navbar ul li a.active").append("<hr style='width:"+width+"px; margin:0px; padding:0px; border: 1px solid #fff'>");

                      $("#manufacturBrithDay").mask('99.99.9999');

                      $(".pswForgoutHref").click(function(e){
                        e.preventDefault();
                        $(".pswForgout").show();
                        var scrlTop = $(".pswForgout").offset().top;
                        $("html, body").animate({
                          scrollTop: scrlTop
                        }, 500);
                        $(".pswForgout form button").click(function(){
                          var email = $(".pswForgout #emailForgout").val();
                          $.ajax({
                                  url: '<?=Url::to(['site/login', 'forgoutPsw'=>'forgoutPsw'])?>',
                                  type: 'POST',
                                  data: {"_csrf-frontend": '<?=Yii::$app->request->getCsrfToken()?>', email:email},
                                   beforeSend: function(){
                                     $(".pswForgout .action").html("<div class='text-center' style='width:100%; height: 100px; position:relative;'><img style='margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);' src='<?=Yii::$app->request->baseUrl?>/img/load.gif'>");
                                            }
                                          })
                                  .done(function(data) {
                                    console.log(data);
                                    var beginPhotoResult = data.indexOf("<!--BEGINACTIONEMAILFOF-->");
                                     var endPhotoResutl = data.indexOf("<!--ENDACTIONEMAILFOF-->");
                                     var result = data.substring(beginPhotoResult +27, endPhotoResutl);
                                     if (result.trim() == "emailSuccess") {
                                        $(".pswForgout .col-12").html("<div class='alert alert-success' role='alert'>На данный email был отправлен пароль!</div>");
                                     }else{
                                       $(".pswForgout .action").html("<div class='alert alert-danger' role='alert'>С данным email пользователя не существует!</div>");
                                     }

                                          })
                                 .fail(function() {
                                   console.log("Непридвиденная ошибка");
                                 });
                        });

                      });

                    if ($(window).scrollTop() > 0) {
                            $("header").css({
                              "position":"fixed",
                              "top:": "0",
                              "z-index": "9999",
                              "opacity": "0.8",
                            });
                          }else{
                              $("header").css({
                              "position":"relative",
                              "top:": "0",
                              "z-index": "9999",
                              "opacity": "1",
                            });
                          }

                    $(document).scroll(function(e){

                          if ($(window).scrollTop() > 0) {
                            $("header").css({
                              "position":"fixed",
                              "top:": "0",
                              "z-index": "9999",
                              "opacity": "0.8",
                            });
                          }else{
                              $("header").css({
                              "position":"relative",
                              "top:": "0",
                              "z-index": "9999",
                              "opacity": "1",
                            });
                          }
                      });
                  });
              </script>
</body>
</html>
<?php $this->endPage() ?>
