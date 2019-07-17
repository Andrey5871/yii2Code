<?php
use yii\helpers\Url;
$session = Yii::$app->session;
$session->open();
$this->title = "Добавить клиента";

 ?>

<div class="container cabinet pt-4">
	<div class="row">
		<div class="col-12">
			<h2 class="text-center pb-4">Добавить клиента</h2>
		</div>
		<div class="alert alert-danger errorServer" role="alert" style="display: none">
            Непридвиденная ошибка, попробуйте заново!
          </div>
	</div>
</div>



<div class="container mb-4 loginSuare">
  <div class="row">
    <div class="col-12">

<form>
  <div class="form-group">
    <!-- <label for="manufacturName">Введите имя</label> -->
    <input type="text" class="form-control" name="name" length="255" id="manufacturName" placeholder="Введите имя" autocomplete="off">
    <div class="invalid-feedback">
        Вы не ввели имя!
      </div>
  </div>
  <div class="form-group">
    <!-- <label for="manufacturSurname">Введите фамилию</label> -->
    <input type="text" class="form-control" name="surName" length="255" id="manufacturSurname" placeholder="Введите фамилию" autocomplete="off">
    <div class="invalid-feedback">
        Вы не ввели фамилию!
      </div>
  </div>
  <div class="form-group">
    <!-- <label for="manufacturPatronymic">Введите отчество</label> -->
    <input type="text" class="form-control" name="patronymic" length="255" id="manufacturPatronymic" placeholder="Введите отчество" autocomplete="off">
     <div class="invalid-feedback">
        Вы не ввели отчество!
      </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="form-group dates">
        <!-- <label for="manufacturBrithDay">Укажите дату рождения</label> -->
        <input type="text" class="form-control" name="date" id="manufacturBrithDay" placeholder="Укажите дату рождения">
        <div class="invalid-feedback" autocomplete="off">
            Вы не указали дату рождения!
          </div>
      </div>
    </div>


  <div class="col">
    <div class="form-group genders" id="manufacturGender">
      <!-- <label for="manufacturGender">Выберите пол</label> <br> -->
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <label class="btn btn-light active">
            <input type="radio" name="options" id="option1" autocomplete="off" checked> Мужской
          </label>
          <label class="btn btn-light">
            <input type="radio" name="options" id="option2" autocomplete="off"> Женский
          </label>
        </div>
    </div>
  </div>


  </div>





    <div class="form-group" style="position: relative">
      <!-- <label for="manufacturCity">Введите название города</label> -->
      <input type="text" class="form-control" name="city" id="manufacturCity" placeholder="Введите название города" autocomplete="off">
      <!-- BEGINVIEWCITY -->
      <div class="city" style="display: none;">
        <ul class="list-group">
        <?php if ($_GET['search']): ?>
            <?php foreach ($cityArray as $city): ?>
              <?php foreach ($regionArray as $region): ?>
                <?php if ($region['id'] == $city['region_id']): ?>
                        <li idCity="<?=$city['id']?>" class="list-group-item list-group-item-action list-group-item-default"><b><?=$city['name']?></b>, <?=$region['name']?></li>
                <?php endif ?>
              <?php endforeach ?>
            <?php endforeach ?>
          </ul>
          <?php else: ?>
            <li class="list-group-item list-group-item-action">
              Поиск города...
            </li>
              </ul>
        <?php endif ?>

      </div>
      <!-- ENDVIEWCITY -->
    <div class="invalid-feedback">
          Вы не ввели название города!
        </div>
    </div>
    <div class="form-group" style="position:relative">
      <!-- <label for="manufacturEducation">Введите название учебного заведения</label> -->
      <input type="text" class="form-control" name="educationName" id="manufacturEducation" placeholder="Введите название учебного заведения" autocomplete="off">
      <!-- BEGINVIEWeducation -->
      <div class="education" style="display: none">
        <ul class="list-group">
        <?php if ($_GET['search']): ?>
            <?php foreach ($educationArr as $education): ?>
                        <li idEducation="<?=$education['id']?>" class="list-group-item list-group-item-action list-group-item-default"><?=$education['subName']?> <b><?=$education['name']?></b></li>
              <?php endforeach ?>

          </ul>
          <?php else: ?>
            <li class="list-group-item list-group-item-action">
              Поиск учебного заведения...
            </li>
              </ul>
        <?php endif ?>

      </div>
      <!-- ENDVIEWeducation -->
      <div class="invalid-feedback">
          Вы не ввели название учебного заведения!
        </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <!-- <label for="manufacturEducationLevel">Введите курс</label> -->
          <input type="text" class="form-control" name="educationLevel" length="2" id="manufacturEducationLevel" placeholder="Укажите на каком курсе" autocomplete="off">
          <div class="invalid-feedback">
              Вы не указали на каком курсе!
            </div>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <!-- <label for="manufacturEducationType">Выберите степень квалификации</label> -->
          <select class="custom-select custom-select" id="manufacturEducationType" name="typeEducation">
            <option value="1" selected>Бакалавр</option>
            <option value="2">Магистр</option>
          </select>
        </div>
      </div>

    </div>
  <div class="form-group">
    <!-- <label for="manufacturEmail">Введите email</label> -->
    <input type="text" class="form-control" id="manufacturEmail" length="30" type="email" aria-describedby="emailHelp" placeholder="Введите email" autocomplete="off">
    <div class="invalid-feedback">
        Вы не ввели email!
      </div>
  </div>

  <div class="form-group">
    <!-- <label for="manufacturPhone">Введите телефон</label> -->
    <input type="text" class="form-control" id="manufacturPhone" length="32" type="phone" aria placeholder="Введите телефон" autocomplete="off">
    <div class="invalid-feedback">
        Вы не ввели номер телефона!
      </div>
  </div>

  <button class="btn btn-grey pr-5 pl-5 pt-3 pb-3 regSend" type="button">Добавить клиента</button>
</form>


    </div>
  </div>
</div>


<script>
  jQuery(document).ready(function($) {

          $("form #manufacturPhone").mask("+7(999)999-99-99");

            /*Переключатели выбора пола*/
          $(function () {
            $('[data-toggle="tooltip"]').tooltip()
          })

    /*При попадании фокуса в input показывает выпадающий список городов*/
      $("form input[name=city]").focus(function(){
        $(this).val("");
        $(this).removeAttr('idCity');
        $(this).next(".city").fadeIn(100);
          $(this).on("input", function(){
            var lengElem = $(this).val().length;
            var elemVal = $(this).val();
            var elem = $(this);
            /*Если длина введенных символов в input будет больше 2, то отправляем запрос по поиску городов*/
            if (lengElem > 1) {
              $.ajax({
                url: '<?=Url::to(['cabinet/add', 'search'=>'city'])?>',
                type: 'POST',
                dataType: 'html',
                data: {'_csrf-frontend': '<?=Yii::$app->request->getCsrfToken()?>', 'getCity': 'city', 'nameCity':elemVal},
                beforeSend: function(){
                    $(".city").html("<li class='list-group-item list-group-item-action text-center'> <img src='<?=Yii::$app->request->baseUrl?>/img/load.gif'></li>");
                }
              })
              .done(function(data) {
                var beginCityResult = data.indexOf("<!-- BEGINVIEWCITY -->");
                var endCityResutl = data.indexOf("<!-- ENDVIEWCITY -->");
                var result = data.substring(beginCityResult, endCityResutl);
                $(".city").html(result);
                $(".city").css({
                  display: 'block',
                });

                $(".form-group").on("click", " .city ul li ", function(e){
                    elem.val($(this).text());
                    elem.attr("idCity", $(this).attr("idCity"));
                    $(".city").fadeOut(100);
                });

              })
              .fail(function(data) {
                console.log("error - " + data);
              })
            }else{
              $(".city ul").html("<li class='list-group-item list-group-item-action'>Поиск города...</li>");
            }

          })
      });
      $("form input[name=city]").focusout(function(event) {
      	var elem = $(this);
        setTimeout(function(){
          elem.parent().children(".city").fadeOut(100);
        }, 300);
      });



      /*При попадании фокуса в input показывает выпадающий список учебных заведений*/
      $("form input[name=educationName]").focus(function(){
        $(this).val("");
        $(this).removeAttr('idEducation');
        $(this).next(".education").fadeIn(100);
          $(this).on("input", function(){
            var lengElem = $(this).val().length;
            var elemVal = $(this).val();
            var elem = $(this);
            /*Если длина введенных символов в inut будет больше 2, то отправляем запрос по поиску учебных заведений*/
            if (lengElem > 1) {
              $.ajax({
                url: '<?=Url::to(['cabinet/add', 'search'=>'education'])?>',
                type: 'POST',
                dataType: 'html',
                data: {'_csrf-frontend': '<?=Yii::$app->request->getCsrfToken()?>', 'getEducation': 'education', 'nameEducation':elemVal},
                beforeSend: function(){
                    $(".education").html("<li class='list-group-item list-group-item-action text-center'><img src='<?=Yii::$app->request->baseUrl?>/img/load.gif'></li>");
                }
              })
              .done(function(data) {
                var beginCityResult = data.indexOf("<!-- BEGINVIEWeducation -->");
                var endCityResutl = data.indexOf("<!-- ENDVIEWeducation -->");
                var result = data.substring(beginCityResult, endCityResutl);
                $(".education").html(result);
                $(".education").css({
                  display: 'block',
                });

                $(".form-group").on("click", " .education ul li ", function(e){
                    e.preventDefault();
                    elem.val($(this).text());
                    elem.attr("idEducation", $(this).attr("idEducation"));
                    $(".education").fadeOut(100);
                });

              })
              .fail(function(data) {
                console.log("error - " + data);
              })
            }else{
              $(".education ul").html("<li class='list-group-item list-group-item-action'>Поиск учебного заведения...</li>");
            }

          })
      });
      $("form input[name=educationName]").focusout(function(event) {
      	var elem = $(this);
         setTimeout(function(){
          elem.parent().children(".education").fadeOut(100);
        }, 300);

      });


      //Валидация форм и отпарвка формы
      $(".regSend").click(function(){
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var inputText = $("form input[type=text], form input[type=password], form input[type=date]");
            var dateYear = $("form #manufacturBrithDay").val().substr(0,4);
            var thisYear = new Date().getFullYear();
            var status;
            inputText.each(function(index, el) {
              $(el).removeClass("is-invalid");
              if ($(el).val() == "") {
                var textInput = $(el).attr('placeholder');
                  $(el).parent().children(".invalid-feedback").text(textInput);
                  $(el).addClass("is-invalid");
              }else if ($(el).val().length > $(el).attr("length")) {
                  $(el).parent().children(".invalid-feedback").text("Вы ввели превышающее количество символов!");
                  $(el).addClass("is-invalid");
              }else if(dateYear == thisYear || dateYear > thisYear){
                $("form #manufacturBrithDay").next(".invalid-feedback").text("Ошибка, укажите дату рождения!");
                  $("form #manufacturBrithDay").addClass("is-invalid");
                }else if(regex.test($("form #manufacturEmail").val()) == false){
                    $("form #manufacturEmail").next(".invalid-feedback").text("Ошибка, неверный email!");
                  $("form #manufacturEmail").addClass("is-invalid");
                }else if($("form #manufacturCity").attr("idcity") == undefined){
                        $("form #manufacturCity").parent().children(".invalid-feedback").text("Ошибка, вы не выбрали город или такого города не существует в базе данных!");
                  $("form #manufacturCity").addClass("is-invalid");
                }else if($("form #manufacturEducation").attr("ideducation") == undefined){
                  $("form #manufacturEducation").parent().children(".invalid-feedback").text("Ошибка, вы не выбрали учебное заведение или такого учебного заведения не существует в базе данных!");
                  $("form #manufacturEducation").addClass("is-invalid");
                }else{
                    status = "OK";
                }
            });
                      if (status == "OK") {
                    var name = $("form #manufacturName").val();
                    var surName = $("form #manufacturSurname").val();
                    var patronymic = $("form #manufacturPatronymic").val();
                    var brithDay = $("form #manufacturBrithDay").val();
                    var gender = $("form #manufacturGender .btn-group label.active").text();
                    var idCity = $("form #manufacturCity").attr("idcity");
                    var idEducation = $("form #manufacturEducation").attr("ideducation");
                    var levelEducation = $("form #manufacturEducationLevel").val();
                    var typeEducation = $("form #manufacturEducationType option:selected").val();
                    var password = $("form #manufacturPassword").val();
                    var email = $("form #manufacturEmail").val();
                    var phone = $("form #manufacturPhone").val();
                    var idUsers = <?=$session->get('userId')?>;

                    $.ajax({
                            url: '<?=Url::to(['cabinet/add', 'add'=>'clients'])?>',
                            type: 'POST',
                            data: {"_csrf-frontend": '<?=Yii::$app->request->getCsrfToken()?>', name:name, surName:surName, patronymic:patronymic, brithDay:brithDay, gender:gender, idCity:idCity, idEducation:idEducation, levelEducation:levelEducation, typeEducation:typeEducation, password:password, email:email, phone:phone, idUsers:idUsers},
                            beforeSend: function(){
                                $(".loginSuare").html("<div class='text-center' style='width:100%; height: 100%; position:relative;'><img style='margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);' src='<?=Yii::$app->request->baseUrl?>/img/load.gif'>");
                            }
                          })
                          .done(function(data) {
                             var beginCityResult = data.indexOf("<!-- hrefredirectBegin -->");
                              var endCityResutl = data.indexOf("<!-- hrefredirectEND -->");
                              var result = data.substring(beginCityResult+27, endCityResutl);
                                location.href = "<?=Url::to(['cabinet/index'])?>";
                          })
                          .fail(function() {
                            $("body").animate({scrollTop:0}, '500');
                            $(".errorServer").show();
                          })
                      }

      });

  });
</script>
