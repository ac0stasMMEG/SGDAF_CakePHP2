<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
	<div class="col-xs-12">

		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php echo __('Historials'); ?></h3>
				<div class="box-tools pull-right">
					<?php //echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> New Historial'), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
				</div>
			</div>
			<div class="box-body table-responsive">
				<table id="Historials" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center"><?php echo __('¿Quién realizó la acción?'); ?></th>
							<th class="text-center"><?php echo __('Memo Referente'); ?></th>
							<th class="text-center"><?php echo __('Memo'); ?></th>
							<th class="text-center"><?php echo __('Creación'); ?></th>
							<th class="text-center"><?php echo __('Acción'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($historials as $historial): ?>
							<tr>
								<td class="text-center">
									<?php echo $this->requestAction('memos/find_user_username/'.$historial['Historial']['owner']); ?>
								</td>
								<td class="text-center">
									<?php 
										$memoOne = 'D'.$historial['Memo']['memo_number'].'-'.$historial['Memo']['year'];
										echo $memoOne; 
									?>
								</td>
								<td class="text-center">
									<?php 
										$memoTwo = $this->requestAction('historials/view/'.$historial['Historial']['id'].'/0');
										echo $memoTwo; 
									?>
								</td>
								<td class="text-center"><?php echo h($historial['Historial']['created']); ?>&nbsp;</td>
								<td class="text-center">
								<?php echo $this->Form->postLink(__('<i class="fa fa-scissors"></i> Separar'), array('action' => 'delete', $historial['Historial']['memo_one']), array('class' => 'btn btn-primary', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('¿Estás seguro de querer separar los memorándums '.$memoOne.' / '.$memoTwo.'?')); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- /.table-responsive -->


		</div><!-- /.index -->

	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->

<?php
echo $this->Html->script('../js/plugins/datatables/jquery.dataTables');
echo $this->Html->script('../js/plugins/datatables/dataTables.bootstrap');
?>
<script type="text/javascript">
	$(function() {
		$("#Historials").dataTable({
			language: {
				"decimal": "",
				"emptyTable": "No hay información",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
				"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
				"infoFiltered": "(Filtrado de _MAX_ total entradas)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ Entradas",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "Sin resultados encontrados",
				"paginate": {
					"first": "Primero",
					"last": "Ultimo",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			},
		});
	});
</script>