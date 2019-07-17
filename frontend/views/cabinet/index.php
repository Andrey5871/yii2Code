	<!-- TABLECLIENTSBEGIN -->
<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
$session = Yii::$app->session;
$session->open();
$this->title = "Личный кабинет";

?>
<?php if ($session->get("hash") != NULL): ?>

		<div class="row">
          <div class="col-12 titleContent text-left">
            <h2>Мои клиенты</h2>
          </div>
        </div>

				<div class="row">
					<div class="col-12">
						<div class="table-responsive">
						<table class="table">
					  <thead>

					    <tr>
					      <th scope="col">
					      	<!-- Сортировка -->
					      </th>
					      <th scope="col" colspan="3">
					      	<div class="input-group mb-3 search">

						</div>
					      </th>
					      <th scope="col" colspan="2" class="buttonAdd text-center">
					      	<a href="<?=Url::to(['cabinet/add'], true)?>" class="btn btn-add"><i class="fas fa-plus"></i></a>
					      </th>
					    </tr>
					  </thead>
					  <tbody>



					  	<?php foreach ($clients as $key => $valueClients): ?>

						<tr>
					      <td><span><?=date("d.m.Y", strtotime($valueClients['createTime']))?></span> <span>id <?=$valueClients['client_id']?></span></td>
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
					    		<p><?=$valueClients['sumUsers']?> р.</p>
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
					    			<?php if ($valueClients['statusId'] == 0): ?>
									<div class="icon editRow" idClients='<?=$valueClients['client_id']?>'>
										<a href="<?=Url::to(['cabinet/edit', 'edit'=> $valueClients['client_id']])?>"></a>
				    			<img src="<?=Yii::$app->request->baseUrl?>/img/edit.png" alt="edit">
				    				</div>
									<?php else:?>
										<div class="icon"  title="Редактирование запрещено, так как данная запись была обработана администратором" style="background-color: #e8e8e8; cursor: help;">
				    			<img src="<?=Yii::$app->request->baseUrl?>/img/edit.png" alt="edit">
				    				</div>
								<?php endif ?>

				    	</p>
					    	</td>
					    	<td>
					    		<p>
					    			<?php if ($valueClients['statusId'] == 0): ?>
									<div class="icon deleteRow" idClients='<?=$valueClients['client_id']?>'>

				    			<img src="<?=Yii::$app->request->baseUrl?>/img/delete.png"  alt="delete">
				    		</div>
									<?php else:?>
										<div class="icon" title="Удаление запрещено, так как данная запись была обработана администратором" style="background-color: #e8e8e8; cursor: help;">
				    			<img src="<?=Yii::$app->request->baseUrl?>/img/delete.png" alt="delete">
				    		</div>
								<?php endif ?>

					    		</p>
					    	</td>
					    </tr>



					  	<?php endforeach ?>



					  </tbody>
					</table>
				</div>
					<?php
						// отображаем постраничную разбивку
					echo LinkPager::widget([
					    'pagination' => $pages,
					]);
					 ?>
					</div>
				</div>
		</div>
		<!-- TABLECLIENTSEND -->


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


<script>
	jQuery(document).ready(function($) {
		$(".pagination .prev a, .pagination .prev span").html('<i class="fas fa-chevron-left"></i>');
		$(".pagination .next a, .pagination .next span").html('<i class="fas fa-chevron-right"></i>');

	});


</script>


<?php else: ?>
<script>
              location.href = '<?=Url::to(['site/index'])?>';
            </script>
	<?php endif;?>
