<?php
use yii\helpers\Url;
$session = Yii::$app->session;
$session->open();
$this->title = "Добавление новости";
 ?>
<?php if ($session->get("hash") == NULL || $session->get("group") == '1'): ?>
      

          <script>
              location.href = '<?=Url::to(['site/login'])?>';
            </script>

<?php else: ?>

<div class="container cabinet">
  <div class="row">
            <div class="col-12 titleContent text-left pb-4">
              <h2>Добавление новости</h2>
            </div>
            <div class="alert alert-danger errorServer" role="alert" style="display: none">
                    Непридвиденная ошибка, попробуйте заново!
                  </div>
          </div>
</div>



<div class="container mb-4 squareEdit">
  <div class="row">
    <div class="col-12">
<form>


  <div class="form-group">
    <label id="countTitle"></label>
    <input type="text" class="form-control" name="name" length="100" id="manufacturName" placeholder="Введите заголовок"  autocomplete="off">
    <div class="invalid-feedback">
        Вы не ввели заголовок!
      </div>
  </div>
  <div class="form-group">
    <label id="minDesc"></label>
    <input type="text" class="form-control" name="surName" length="255" id="manufacturSurname" placeholder="Введите краткое описание"  autocomplete="off">
    <div class="invalid-feedback">
        Вы не ввели краткое описание!
      </div>
  </div>
  <div class="form-group">
    <label id="fullDesc"></label>
    <textarea type="text" class="form-control" name="patronymic" length="1024" id="manufacturPatronymic" placeholder="Введите полное описание" autocomplete="off"></textarea>
     <div class="invalid-feedback">
        Вы не ввели полное описание!
      </div>
  </div>
  <div class="result text-center" style="max-width:500px; max-height: 500px; overflow:hidden">

  </div>
  <div class="fileInput">
    <label>Размер изображения не должен превышать 5MB, а также формат изображения должен соответствовать форматам (jpeg, png)</label>
    <div class="actionVew">

    </div>
    <div class="input-group mb-3">
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="inputImg" name="imgNews" aria-describedby="inputGroupFileAddon01">

      <label class="custom-file-label" for="inputImg">Выберите изображение</label>

    </div>
  </div>
  </div>






  <button class="btn btn-grey pr-5 pl-5 pt-3 pb-3 regSend" type="button">Опубликовать</button>
</form>

    </div>

  </div>
</div>


<script>
  jQuery(document).ready(function($) {

          $("#manufacturName").on("input", function(e){
              var countChar = 100-$(this).val().length;
              
              if ($(this).val().length > 100) {
                  $("#countTitle").html("Вы ввели больше 100 символов");
              }else{
                $("#countTitle").html("Осталось " + countChar + " символов");
              }
          });


          $("#manufacturSurname").on("input", function(e){
              var countChar = 255-$(this).val().length;
              
              if ($(this).val().length > 255) {
                  $("#minDesc").html("Вы ввели больше 255 символов");
              }else{
                $("#minDesc").html("Осталось " + countChar + " символов");
              }
          });

          $("#manufacturPatronymic").on("input", function(e){
              var countChar = 1024-$(this).val().length;
              
              if ($(this).val().length > 1024) {
                  $("#fullDesc").html("Вы ввели больше 1024 символов");
              }else{
                $("#fullDesc").html("Осталось " + countChar + " символов");
              }
          });
  

          var formData = new FormData();
      $("#inputImg").on('change', function(){
        var img = $("#inputImg");
        if (img[0].files[0].type == "image/jpeg" || img[0].files[0].type == "image/png") {
              if (img[0].files[0].size < 5000000) {
                formData.set('img', img[0].files[0]);
                var reader = new FileReader();
                reader.onload = function(e){
                  var dataURL = e.target.result;
                  $(".result").html("<img src='"+dataURL+"' style='max-width:500px; max-height: 500px; margin: 10px'>");
                };
                  var url = reader.readAsDataURL(img[0].files[0]);
                  $(".actionVew").html("<div class='alert alert-success' role='alert'>Изображение готово к загрузке!</div>");
              }else{
                  $(".actionVew").html("<div class='alert alert-danger' role='alert'>Ошибка, размер изображения превышает 5MB!</div>");
              }
        }else{
            $(".actionVew").html("<div class='alert alert-danger' role='alert'>Ошибка, этот файл не является изображением!</div>");
        }

      });



      //Валидация форм и отпарвка формы
      $(".regSend").click(function(){
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var inputText = $("form input[type=text], textarea");
            var textEmpt = [];
            var length = [];
            inputText.each(function(index, el) {
              $(el).removeClass("is-invalid");
              if ($(el).val() == "") {
                var textInput = $(el).attr('placeholder');
                  $(el).parent().children(".invalid-feedback").text(textInput);
                  $(el).addClass("is-invalid");
                textEmpt.push(textInput);
              }else if ($(el).val().length > $(el).attr("length")) {
                  $(el).parent().children(".invalid-feedback").text("Вы ввели превышающее количество символов!");
                  $(el).addClass("is-invalid");
                  textEmpt.push($(el).val());

              }
            });
            
                      if (textEmpt.length < 1) {
                        
                    var title = $("form #manufacturName").val();
                    var minDesc = $("form #manufacturSurname").val();
                    var description = $("form #manufacturPatronymic").val();
                    var token = '<?=Yii::$app->request->getCsrfToken()?>';
                    formData.set('title', title);
                    formData.set('minDesc', minDesc);
                    formData.set('description', description);
                    formData.set('_csrf-backend', token);
                    $.ajax({
                            url: '<?=Url::to(['site/addnews', 'add'=>'add'])?>',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            beforeSend: function(){
                                $(".squareEdit").html("<div class='text-center' style='width:100%; height: 100%; position:relative;'><img style='margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);' src='<?=Yii::$app->request->baseUrl?>/img/load.gif'>");
                            }
                          })
                          .done(function(data) {
                            console.log(data);
                               location.href = "<?=Url::to(['site/news'])?>";
                          })
                          .fail(function() {
                            $("body").animate({scrollTop:0}, '500');
                            $(".errorServer").show();
                          })
                      }

      });

  });
</script>



	<?php endif;?>
