<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$session = Yii::$app->session;
$session->open();
$this->title = '2200';
?>


<section class="headerContent torgPredl" style="background-image:url('<?=Yii::$app->request->baseUrl?>/img/bgHead2200.jpg')">
  <div class="bgShadow"></div>
  <div class="container">
  <div class="row pt150">
  <div class="col-md-12 text-center text-white  text-md-left">
  <h2 class="t25 upc text-center">На все случаи в жизни – 2200</h2>
  <hr class="hr-light">
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
<div class="row bgOpClose" style="background-image: url('/frontend/web/img/2200_1.png');  background-size: 800px auto;">


<div class="col-12 col-lg-6">
    <h1 class="t25 card-title">ВСЕ, ЧТО ВЫ ПОЖЕЛАЕТЕ</h5>
<div class="card grey wow fadeInLeft" data-wow-duration="1s">
  <div class="img" style="margin-bottom: 20px; display: none">
    <img src="/frontend/web/img/rightImgTorg.png" alt="" style="width: 100%">
  </div>
    <p class="card-text">Мануфакторинг предлагает воспользоваться всеобщим
и единым для всех регионов России предложением. В других разделах сайта мы говорили, что специализируемся
на оказании консультаций по написанию дипломных работ
для магистров и бакалавров.  Но также нам известно, что Вас
это не остановит и Вы обязательно захотите обратиться в Мануфакторинг за консультацией в выполнении курсовых работ, эссе, научных статей или учебных практик. Мы не обсуждаем стоимость.
Мы сделаем любую из указанных работ за 2200 руб. для Вас. Работа будет у Вас в электронном ящике в течение нескольких часов после звонка.
</p>


  </div>

 </div>



  <div class="col-12 col-md-12 ">
  </div>
  </div>
  <div class="row bgOpClose2 mt-5" style="background-image: url('/frontend/web/img/2200_2.png'); background-size: 800px auto;">
   <div class="col-12 col-lg-6"></div>

   <div class="col-12 col-lg-6 pt90">
    <h1 class="t25 card-title text-right">ГАРАНТИИ</h5>
<div class="card grey text-right wow fadeInRight" data-wow-duration="1s">
  <div class="img" style="margin-bottom: 20px; display: none">
    <img src="/frontend/web/img/leftImgTorg.png" alt="" style="width: 100%">
  </div>
    <p class="card-text">Мануфакторинг не знает, что такое переделывание <br>
данных работ за дополнительную плату, ограниченные <br>
периоды гарантии и всех остальных нелепостей, <br>
с которыми Вы могли бы столкнуться <br>
где бы то ни было кроме Мануфакторинг
</p>


  </div>

 </div>



</div>
</div>
</section>


<section class="zebra money2200Foot">
    <div class="container">

          <div class="row">
            <div class="col-12">
              <p class="textPreForms">
                  Если вы хотите самостоятельно позвонить нам для обсуждения научной работы или написать об этом в WhatsApp: 8(988)-471-73-18<br>
                  Если вы хотите, чтобы мы сами связались с Вами по телефону – оставьте заявку в указанной ниже форме<br>
                    Оплата производится на номер карты: 2202 2001 1612 6440
              </p>
            </div>
            <div class="col-12">
                    <div class="forms">
                              <form class="form-inline">
                        <label class="sr-only" for="inlineFormInputName2">ФИО</label>
                        <input type="text" class="form-control" id="inlineFormInputName2" placeholder="Ф.И.О.">

                        <label class="sr-only" for="inlineFormInputGroupUsername2">Телефон</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Телефон">
                        </div>

                        <label class="sr-only" for="inlineFormInputGroupUsername3">Город</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="inlineFormInputGroupUsername3" placeholder="Ваш город">
                        </div>

                        <label class="sr-only" for="inlineFormInputGroupUsername4">Время для звонка по Москве</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="inlineFormInputGroupUsername4" placeholder="Время для звонка по Москве">
                        </div>

                        <button class="btn btn-grey sendMail" type="button">Отправить</button>
                      </form>
                      <p class="oferta">Нажимая на кнопку «Отправить», вы даете согласие на обработку персональных данных и соглашаетесь c политикой конфиденциальности</p>
                    </div>
                    <div class="sogl">

                    </div>
            </div>
          </div>

    </div>
</section>

<script>
  jQuery(document).ready(function($) {
    $(".forms #inlineFormInputGroupUsername2").mask("+7(999)999-99-99");
        $(".sendMail").click(function(){
            var inputText = $(".forms input[type=text]");
            var actionError = [];
            inputText.each(function(index, el) {
              $(el).removeClass("is-invalid");
              if ($(el).val() == "") {
                var textInput = $(el).attr('placeholder');
                  $(el).parent().children(".invalid-feedback").text(textInput);
                  $(el).addClass("is-invalid");
                  actionError.push("text");
              }
            });

            if (actionError.length < 1) {
                      var name = $('#inlineFormInputName2').val();
                      var phone = $('#inlineFormInputGroupUsername2').val();
                      var city = $('#inlineFormInputGroupUsername3').val();
                      var time = $('#inlineFormInputGroupUsername4').val();
                        $.ajax({
                            url: '<?=Url::to(['site/money2200', 'request'=>'request'])?>',
                            type: 'POST',
                            data: {name:name, phone:phone, city:city, time:time},
                            beforeSend: function(){
                                $(".money2200Foot .forms").html("<div class='text-center' style='width:100%; height: 100px; position:relative;'><img style='margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);' src='<?=Yii::$app->request->baseUrl?>/img/load.gif'>");
                            }
                          })
                          .done(function(data) {
                            console.log(data);
                              $(".money2200Foot .forms").html("<div class='text-center' style='width:100%; height: 100px; position:relative;'><div style='margin: 0; width:100%;  position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);' class='alert alert-success' role='alert'><h4>Ваша заявка отправлена!</h4></div></div>");
                          })
                          .fail(function() {
                            $("body").animate({scrollTop:0}, '500');
                            $(".errorServer").show();
                          })
                }
        });
  });
</script>
