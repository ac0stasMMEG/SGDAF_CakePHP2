<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
    <div class="col-xs-12">

    <div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo __('Memo Alerts'); ?></h3>
			<div class="box-tools pull-right">
                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> New Memo Alert'), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
		</div>	
			<div class="box-body table-responsive">
                <table id="MemoAlerts" class="table table-bordered table-striped">
					<thead>
						<tr>
													<th class="text-center"><?php echo $this->Paginator->sort('id'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('alert_type_id'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('memo_id'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('user_id'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('viewed'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('created'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('modified'); ?></th>
												<th class="text-center"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($memoAlerts as $memoAlert): ?>
	<tr>
		<td class="text-center"><?php echo h($memoAlert['MemoAlert']['id']); ?>&nbsp;</td>
		<td class="text-center">
			<?php echo $this->Html->link($memoAlert['AlertType']['name'], array('controller' => 'alert_types', 'action' => 'view', $memoAlert['AlertType']['id'])); ?>
		</td>
		<td class="text-center">
			<?php echo $this->Html->link($memoAlert['Memo']['id'], array('controller' => 'memos', 'action' => 'view', $memoAlert['Memo']['id'])); ?>
		</td>
		<td class="text-center">
			<?php echo $this->Html->link($memoAlert['User']['id'], array('controller' => 'users', 'action' => 'view', $memoAlert['User']['id'])); ?>
		</td>
		<td class="text-center"><?php echo h($memoAlert['MemoAlert']['viewed']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($memoAlert['MemoAlert']['created']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($memoAlert['MemoAlert']['modified']); ?>&nbsp;</td>
		<td class="text-center">
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $memoAlert['MemoAlert']['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $memoAlert['MemoAlert']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
			<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $memoAlert['MemoAlert']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $memoAlert['MemoAlert']['id'])); ?>
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
        $("#MemoAlerts").dataTable({
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