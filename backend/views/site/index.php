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
            <h2>Все клиенты</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <table class="table">
            <thead class="text-center">

              <tr>
                <th scope="col">
                  <!-- Сортировка -->
                </th>
                <th scope="col">

                </th>
                <th scope="col">
                    Торговый агент
                </th>
                <th scope="col">
                  Сумма вознаграждения
                </th>
                <th scope="col">
                  Выручка
                </th>
                <th scope="col">
                  Статус
                </th>
                <th scope="col">

                </th>
                <th scope="col">

                </th>
              </tr>
            </thead>
            <tbody>



              <?php foreach ($clients as $key => $valueClients): ?>

            <tr>
                <td colspan="3"><span><?=date("d.m.Y", strtotime($valueClients['createTime']))?></span> <span>id <?=$valueClients['client_id']?></span></td>
              </tr>
              <tr class="borderRow">
                <td>
                  <p><?=$valueClients['surname']?> <?=$valueClients['name']?> <?=$valueClients['patronymic']?></p>
                  <p>
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
                              <a href="<?=Url::to(['site/user', 'idUser'=>$valueFromUser['user_id']])?>"><?=$valueFromUser['surname']?> <?=$valueFromUser['name']?> <?=$valueFromUser['patronymic']?></a>
                          <?php endif; ?>
                    <?php endforeach; ?>
              </td>
                <td>
                  <p><?=$valueClients['sumUsers']?> р.</p>
                </td>
                <td>
                  <p><?=$valueClients['sumOrder']?> р.</p>
                </td>
                <td>
                  <p>
                <?php if ($valueClients['statusId'] == 0): ?>
                  Не обработан
                  <?php elseif($valueClients['statusId'] == 1): ?>
                    В работе
                    <?php elseif($valueClients['statusId'] == 2): ?>
                    Отказ
                    <?php elseif($valueClients['statusId'] == 3): ?>
                    Выполнен
                <?php endif ?>
                </p>
                </td>
                <td>
                  <p>

                  <div class="icon editRow" idClients='<?=$valueClients['client_id']?>'>
                    <a href="<?=Url::to(['site/edit', 'edit'=> $valueClients['client_id']])?>"></a>
                  <img src="<?=Yii::$app->request->baseUrl?>/img/edit.png" alt="edit">
                    </div>


              </p>
                </td>
                <td>
                  <p>

                  <div class="icon deleteRow" idClients='<?=$valueClients['client_id']?>'>

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

	<?php endif;?>
