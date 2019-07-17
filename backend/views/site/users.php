<!-- USERSBEGIN -->
<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
$session = Yii::$app->session;
$session->open();
$this->title = "Личный кабинет";

?>
<?php if ($session->get("hash") == NULL || $session->get("group") == '1'): ?>


          <script>
              location.href = '<?=Url::to(['site/login'])?>';
            </script>

<?php else: ?>


<div class="row">
          <div class="col-12 titleContent text-left">
            <h2>Все торговые агенты</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <table class="table">
              <thead class="text-center">
                <tr>
                  <td></td>
                  <td><b>Чистая прибыль <br>торгового агента</b></td>
                  <td><b>Выручка с <br>торгового агента</b></td>
                  <td></td>
                  <td></td>
                </tr>
              </thead>
            <tbody>



              <?php foreach ($users as $key => $valueClients): ?>

            <tr>
                <td colspan="3"><span><?=date("d.m.Y", strtotime($valueClients['createTime']))?></span> <span>id <?=$valueClients['user_id']?></span></td>
              </tr>
              <tr class="borderRow">
                <td>

                    <p>  <a href="<?=Url::to(['site/user', 'idUser'=>$valueClients['user_id']])?>"><?=$valueClients['surname']?> <?=$valueClients['name']?> <?=$valueClients['patronymic']?></a></p>
                    <!-- Начало перебора массива на университет -->
            <?php foreach ($education as $valueEduc): ?>
                  <?php if ($valueClients['nameEducationId'] == $valueEduc['id']): ?>
                    <?=$valueEduc['subName']?>
                  <?php endif ?>
                <?php endforeach ?>
          <!-- Конец перебора массива на университет -->

          <!-- Начало перебора массива на город -->
                <?php foreach ($city as $valueCity): ?>
                  <?php if ($valueCity['id'] == $valueClients['cityId']): ?>
                    г. <?=$valueCity['name']?>
                  <?php endif ?>
                <?php endforeach ?>
                <!-- Конец перебора массива на город -->
                    </p>
                </td>
                <td>
                  <?php foreach ($sumAgent as $valueAgent): ?>
                    <?php if ($valueClients['user_id'] == $valueAgent['id']): ?>
                        <p><?=$valueAgent['sum']?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
              </td>
                <td>
                  <?php foreach ($sumResult as $valueAgent): ?>
                    <?php if ($valueClients['user_id'] == $valueAgent['id']): ?>
                        <p><?=$valueAgent['sum']?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
                </td>
                <td>
                  <p>
                    <?php foreach ($educationType as $valueType): ?>
                      <?php if ($valueType['idEducationType'] == $valueClients['educationTypeId']): ?>
                        <?=$valueType['name']?>
                      <?php endif ?>
                    <?php endforeach ?>
                  </p>
                  <p><?=$valueClients['phone']?></p>
                </td>
                <td>
                    <?php foreach ($usersFrom as $valueFromUser): ?>
                          <?php if ($valueFromUser['user_id'] == $valueClients['user_id_add']): ?>
                              <p><?=$valueFromUser['surname']?> <?=$valueFromUser['name']?> <?=$valueFromUser['patronymic']?></p>
                          <?php endif; ?>
                    <?php endforeach; ?>
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


	<?php endif;?>

<!-- USERSEND -->
