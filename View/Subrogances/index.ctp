<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
    <div class="col-xs-12">

    <div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo __('Subrogances'); ?></h3>
			<div class="box-tools pull-right">
                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> New Subrogance'), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
		</div>	
			<div class="box-body table-responsive">
                <table id="Subrogances" class="table table-bordered table-striped">
					<thead>
						<tr>
                            <th class="text-center"><?php echo __('To'); ?></th>
                            <th class="text-center"><?php echo __('Foot Signature'); ?></th>
                            <th class="text-center"><?php echo __('File Name'); ?></th>
                            <th class="text-center"><?php echo __('Description'); ?></th>
                            <th class="text-center"><?php echo __('Created'); ?></th>
                            <th class="text-center"><?php echo __('Modified'); ?></th>
                            <th class="text-center"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($subrogances as $subrogance): ?>
	<tr>
		<td class="text-center"><?php echo h($subrogance['Subrogance']['to']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($subrogance['Subrogance']['foot_signature']); ?>&nbsp;</td>
        <td class="text-center"><?php echo h($subrogance['Subrogance']['file_name']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($subrogance['Subrogance']['description']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($subrogance['Subrogance']['created']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($subrogance['Subrogance']['modified']); ?>&nbsp;</td>
		<td class="text-center">
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $subrogance['Subrogance']['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $subrogance['Subrogance']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
			<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $subrogance['Subrogance']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $subrogance['Subrogance']['to'].': '.$subrogance['Subrogance']['foot_signature'])); ?>
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
        $("#Subrogances").dataTable({
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