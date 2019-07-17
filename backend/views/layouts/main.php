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
                $session->open();

AppAsset::register($this);

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
</head>
<body>
<?php $this->beginBody() ?>

<header>
  <div class="bgHeadMenu"></div>
  <nav class="navbar navbar-expand-xl text-white">
    <a class="navbar-brand" href="/manufaktoring">Мануфакторинг</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin:0 auto;">
      <ul class="navbar-nav mr-auto" style="margin:0 auto;">
        <li class="nav-item">




          <a class="nav-link" href="/torgovoe_predlzhenie">Торговое предложение </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/2200">2200</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/1100">1100</a>
        </li>
      <li class="nav-item">
          <a class="nav-link" href="/globalnye_dannye">Глобальные данные</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="<?=Url::to(['cabinet/index'], true)?>">Перейти в личный кабинет</a>
        </li> -->
      </ul>
        <div class="rightAuth text-center">
            <div class="userIcons text-center">
                <img src="<?=Yii::$app->request->baseUrl?>/img/authUserIcons.png" alt="">
            </div>
            <div class="authHref">
              <?php if ($session->get("hash") == NULL || $session->get("group") == '1'): ?>
                    <a href="<?=Url::to(['site/login'], true)?>">Вход</a>
                    <?php else: ?>

                      <p><a href="<?=Url::to(['site/index'])?>">Личный кабинет</a> (<a href="<?=Url::to(['site/logout'], true)?>">Выйти</a>)</p>

              <?php endif ?>

            </div>
        </div>


    </div>
  </nav>
</header>

<div class="contents">
  <div class="wrapp">
  <?php if ($session->get("hash") == NULL || $session->get("group") == '1'): ?>
                <?= $content ?>
  <?php else: ?>
    <?php
    $date = new DateTime($session->get('year'));
    $now = new DateTime();
    $interval = $now->diff($date);
     ?>
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
                    <div class="avatar" style="background-image: url(/backend/web/img/upload/<?=$session->get('img')?>)">
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
                  <a class="nav-link active" href="<?=Url::to(['site/index'])?>"><i class="fas fa-user-tie" style="padding-right:10px;"></i>Таблица клиентов</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link users" href="<?=Url::to(['site/users'])?>"><i class="fas fa-users" style="padding-right:10px;"></i>Торговые агенты</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link news" href="<?=Url::to(['site/news'])?>"><i class="far fa-newspaper" style="padding-right:10px;"></i>Новости</a>
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
                  url: '<?=Url::to(['site/index', 'delete'=>'del'])?>',
                  type: 'POST',
                  data: {"_csrf-backend": '<?=Yii::$app->request->getCsrfToken()?>', id:idClients},
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
                      url: '<?=Url::to(['site/editprofile', 'edit'=>'profile'])?>',
                      type: 'POST',
                      data: {"_csrf-backend": '<?=Yii::$app->request->getCsrfToken()?>', idUser:<?=$session->get('userId')?>},
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
                        url: '<?=Url::to(['site/photoedit'])?>',
                        type: 'POST',
                        data: {"_csrf-backend": '<?=Yii::$app->request->getCsrfToken()?>', idUser:<?=$session->get('userId')?>},
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

  <?php endif; ?>


</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>

<script type="text/javascript">
    $(document).ready(function(){
      var width = $("header .navbar ul li a.active").width();
      $("header .navbar ul li a.active").append("<hr style='width:"+width+"px; margin:0px; padding:0px; border: 1px solid #fff'>");

      $("#manufacturBrithDay").mask('99.99.9999');


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
 <script>
              new WOW().init();
              </script>


</body>
</html>
<?php $this->endPage() ?>
