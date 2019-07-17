<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
	$this->title = "Авторизация";
$session = Yii::$app->session;
$session->open();
?>
<?php if ($session->get("hash") == NULL || $session->get("group") == '1'): ?>
          <div class="container mt-4">
            <div class="row">
              <div class="col-12">
                <div class="h1 text-center">Авторизация</div>
              </div>
            </div>
          </div>

          <div class="container mt-4 mb-4 loginSuare" style="position:relative">
						<div class="load" style="background-color: #fff; position: absolute; width: 100%; height: 100%; z-index: 999; display: none"><img style='margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);' src='<?=Yii::$app->request->baseUrl?>/img/load.gif'></div>
            <div class="row">
              <div class="col-12">

								<div class="alert alert-danger actionError" role="alert" style="display:none">
									<!-- hrefredirectBegin -->
													<?php echo $action ?>
									<!-- hrefredirectEND -->
		</div>

		<form class="auth">
			<div class="form-group">
				<!-- <label for="exampleInputEmail1">Введите email</label> -->
				<input type="email" class="form-control" name="email" id="manufacturEmail"  placeholder="Введите email" required>
				<div class="invalid-feedback">
					 Введите email!
					</div>
			</div>
			<div class="form-group">
				<!-- <label for="exampleInputPassword1">Введите пароль</label> -->
				<input type="password" class="form-control" name="password" id="manufacturPassword" placeholder="Введите пароль" required>
				<div class="invalid-feedback">
					 Введите пароль!
					</div>
			</div>
			 <button class="btn btn-grey mt-2 pr-4 pl-4 pt-2 pb-2 login" type="button">Войти</button>
		</form>

          </div>
          </div>
          </div>

					<script type="text/javascript">
								$(document).ready(function(){
									//Валидация форм и отпарвка формы
									$(".login").click(function(){
												var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
												var inputText = $(".auth input[type=email], .auth input[type=password]");
												var actionError = [];
												inputText.each(function(index, el) {
													$(el).removeClass("is-invalid");
													if ($(el).val() == "") {
														var textInput = $(el).attr('placeholder');
															$(el).parent().children(".invalid-feedback").text(textInput);
															$(el).addClass("is-invalid");
															actionError.push("text");

													}else if(regex.test($("form #manufacturEmail").val()) == false){
																$("form #manufacturEmail").next(".invalid-feedback").text("Ошибка, неверный email!");
															$("form #manufacturEmail").addClass("is-invalid");
															actionError.push("email");

														}
												});
																	if (actionError.length < 1) {

																var password = $("form #manufacturPassword").val();
																var email = $("form #manufacturEmail").val();

																$.ajax({
																				url: '<?=Url::to(['site/login', 'loginIn'=>'auth'])?>',
																				type: 'POST',
																				data: {"_csrf-backend": '<?=Yii::$app->request->getCsrfToken()?>', password:password, email:email},
																				beforeSend: function(){
																					$(".loginSuare .load").show();

																				}
																			})
																			.done(function(data) {
																				 var beginCityResult = data.indexOf("<!-- hrefredirectBegin -->");
																					var endCityResutl = data.indexOf("<!-- hrefredirectEND -->");
																					var result = data.substring(beginCityResult+27, endCityResutl);

																					if (result.trim() == "Пользователь не найден" || result.trim() == "Неверный email или пароль" || result.trim() == "Этот пользователь не является администратором!") {
																						$(".loginSuare .load").hide();
																						$(".loginSuare .actionError").show();
																						$(".loginSuare .actionError").text(result);
																					}else{
																						location.href = '<?=Url::to(['cabinet/index'])?>';
																					}
																			})
																			.fail(function() {
																				$("body").animate({scrollTop:0}, '500');
																				$(".errorServer").show();
																			})
																	}

									});
								});
					</script>
  <?php else: ?>
    <script>
              location.href = '<?=Url::to(['site/index'])?>';
            </script>
  <?php endif;?>
