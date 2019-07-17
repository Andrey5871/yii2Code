<!-- PHOTOUPLOADBEGIN -->
<?php
use yii\helpers\Url;
$session = Yii::$app->session;
$session->open();
$this->title = "Изменение фотографии";
 ?>

<?php if ($session->get("hash") == NULL || $session->get("group") == '1'): ?>
                  
          <script>
              location.href = '<?=Url::to(['site/login'])?>';
            </script>
<?php else: ?>


<div class="container">
      <div class="row">
        <div class="col-12">
          <div class="alert alert-danger imgError" style="display:none" role="alert">
  Неверный формат изображения или этот файл не является изображением!
            </div>

        </div>
        <div class="col-12">
          <main class="page">
            <h5>Выберите изображение</h5>
            <!-- input file -->
            <div class="box">
              <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="file-input">
                <label class="custom-file-label" for="inputGroupFile01">Выберите файл</label>

              </div>
            </div>
            </div>
            <!-- leftbox -->
            <div class="box-2" >
              <div class="result" style="width:100%; height:400px; display:none"></div>
            </div>

            <div class="col-12 text-center mt-3">
              <!--rightbox-->
              <div class="box-2 img-result hide">
                <!-- result of crop -->
                <img class="cropped" src="" alt="">
              </div>
            </div>

            <!-- input file -->
            <div class="box mt-3">
              <div class="options hide" style="display:none">
                <input type="number" class="img-w" value="300" min="100" max="1200" />
              </div>
              <!-- save btn -->
              <button class="btn btn-primary save m-2" style="display:none">Предпросмотр</button>
              <button type="button" class="btn btn-dark sendImage m-2" style="display:none">Сохранить</button>
              <!-- download btn -->
            </div>
          </main>
        </div>
      </div>
</div>







<script type="text/javascript">
        $(document).ready(function(){
          // vars
        let result = document.querySelector('.result'),
        img_result = document.querySelector('.img-result'),
        img_w = document.querySelector('.img-w'),
        img_h = document.querySelector('.img-h'),
        options = document.querySelector('.options'),
        save = document.querySelector('.save'),
        cropped = document.querySelector('.cropped'),
        dwn = document.querySelector('.download'),
        upload = document.querySelector('#file-input'),
        cropper = '';

      // on change show image with crop options
      upload.addEventListener('change', (e) => {
        if (e.target.files[0].type == "image/jpeg" || e.target.files[0].type == "image/jpg" || e.target.files[0].type == "image/png") {
          $(".imgError").hide();
          if (e.target.files[0].size > 5000000) {
            $(".imgError").show();
            $(".imgError").text("Размер изображения превышает 1МБ");
          }else{
            $(".imgError").hide();
            if (e.target.files.length) {
              $(".result").show();
              $(".save").show();

              // start file reader
              const reader = new FileReader();
              reader.onload = (e)=> {
                if(e.target.result){
                  // create new image
                  let img = document.createElement('img');
                  img.id = 'image';
                  img.src = e.target.result
                  // clean result before
                  result.innerHTML = '';
                  // append new image
                  result.appendChild(img);
                  // show save btn and options
                  save.classList.remove('hide');
                  options.classList.remove('hide');
                  // init cropper
                  cropper = new Cropper(img);
                }
              };
              reader.readAsDataURL(e.target.files[0]);
            }
          }

        }else{
            $(".imgError").show();
            $(".emgError").text("Неверный формат изображения или этот файл не является изображением!");
        }

      });

      // save on click
      save.addEventListener('click',(e)=>{
        e.preventDefault();
        $(".sendImage").show();
        // get result to data uri
        let imgSrc = cropper.getCroppedCanvas({
          width: img_w.value // input value
        }).toDataURL();

        // remove hide class of img
        cropped.classList.remove('hide');
        img_result.classList.remove('hide');
        // show image cropped
        cropped.src = imgSrc;
        $(".sendImage").click(function(){
          cropper.getCroppedCanvas().toBlob(function (blob){
                  var formData = new FormData();
                 formData.append('avatar', blob);
                 $.ajax({
                   url: '<?=Url::to(['site/photoedit', 'upload'=>'file'])?>',
                   data: formData,
                   type: 'POST',
                   contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                   processData: false, // NEEDED, DON'T OMIT THIS
                   beforeSend: function(){
                     $("#exampleModal .modal-body").html("<div class='text-center' style='width:100%; height: 100%; position:relative;'><img style='margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);' src='<?=Yii::$app->request->baseUrl?>/img/load.gif'>");
                   },
                   success: function(data){
                     console.log(data);
                        location.href = '<?=Url::to(['site/index'])?>';
                   }
                }).fail(function(e){
                    console.log(e);
                });
          });
        });


});
        });
</script>

	<?php endif;?>
<!-- PHOTOUPLOADEND -->
