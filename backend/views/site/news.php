<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
$session = Yii::$app->session;
$session->open();
$this->title = "Новости";

?>
<?php if ($session->get("hash") == NULL || $session->get("group") == '1'): ?>

<script>
              location.href = '<?=Url::to(['site/login'])?>';
            </script>
<?php else: ?>


<div class="row news">
          <div class="col-12 titleContent text-left">
            <h2>Все новости</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <table class="table text-center">
            <thead>

              <tr>
                <th scope="col">
                  <p>ID</p>
                </th>
                <th scope="col">
                    <p>Заголовок</p>
                </th>
                <th scope="col">
                 <p>Краткое описание</p>
                </th>
                <th scope="col">
                  <p>Количество просмотров</p>
                </th>
                <th scope="col">
                  <p>Дата создания</p>
                </th>
                <th scope="col" colspan="2" class="buttonAdd text-center">
                  <a href="<?=Url::to(['site/addnews'], true)?>" class="btn btn-add" style="margin:0px !important"><i class="fas fa-plus"></i></a>
                </th>
              </tr>
            </thead>
            <tbody>



              <?php foreach ($news as $key => $valueClients): ?>

              <tr class="borderRow">
                  <td>
                   <p><?=$valueClients['id']?></p>

                    </td>
                <td>
                  <p><?=$valueClients['title']?></p>
                </td>
                <td>
                  <p><?=$valueClients['minDesc']?></p>
                </td>
                <td>
                    <p>
                      <?php $arrsNews = array(); ?>
                      <?php foreach ($view as  $valueView): ?>
                          <?php if ($valueView['idNews'] == $valueClients['id']): ?>
                            <?php array_push($arrsNews, $valueClients['id']) ?>
                          <?php endif ?>
                      <?php endforeach ?>
                      <?php echo count($arrsNews); ?>
                    </p>
              </td>
                <td>
                  <p><?=$valueClients['dateCreate']?></p>
                </td>
                <td>
                  <p>

                  <div class="icon editRow" idClients='<?=$valueClients['id']?>'>
                    <a href="<?=Url::to(['site/editnews', 'editnews'=> $valueClients['id']])?>"></a>
                  <img src="<?=Yii::$app->request->baseUrl?>/img/edit.png" alt="edit">
                    </div>


              </p>
                </td>
                <td>
                  <p>

                  <div class="icon deleteNews" idClients='<?=$valueClients['id']?>'>

                  <img src="<?=Yii::$app->request->baseUrl?>/img/delete.png"  alt="delete">
                </div>


                  </p>
                </td>
              </tr>



              <?php endforeach ?>



            </tbody>
          </table>

          <?php
            // отображаем постраничную разбивку
          echo LinkPager::widget([
              'pagination' => $pages,
          ]);
           ?>
          </div>
        </div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Загрузить новое изображение</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      ...
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
        $(document).ready(function(){
          $(".cabinet .deleteNews").click(function(event) {
            var idNews = $(this).attr("idClients");
            var el = $(this);
            var conf = confirm("Вы действительно хотите удалить запись?");
            if (conf == true) {
                $.ajax({
                        url: '<?=Url::to(['site/news', 'delete'=>'del'])?>',
                        type: 'POST',
                        data: {"_csrf-backend": '<?=Yii::$app->request->getCsrfToken()?>', id:idNews},
                         beforeSend: function(){
                              el.parent().parent().before("<td class='loadTable' colspan=6><p class='text-center'> <img src='<?=Yii::$app->request->baseUrl?>/img/load.gif'></p></td>");
                                  }
                                })
                        .done(function(data) {

                          $(".loadTable").remove();
                                    el.parent().parent().html("<td colspan=6><p class='text-center'>Запись удалена</p></td>");
                                })
                       .fail(function(data) {
                         console.log(data.responseText);
                         console.log("непридвиденная ошибка");
                       });
            }else{

            }

          });
        });
</script>

	<?php endif;?>
