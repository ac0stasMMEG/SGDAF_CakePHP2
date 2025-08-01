<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
    <div class="col-xs-12">

    <div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo __('Dashboards'); ?></h3>
			<div class="box-tools pull-right">
                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> New Dashboard'), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
		</div>	
			<div class="box-body table-responsive">
                <table id="Dashboards" class="table table-bordered table-striped">
					<thead>
						<tr>
                            <th class="text-center"><?php echo $this->Paginator->sort('group_id'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('name'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('link'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('position'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('icon'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('color'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('created'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('modified'); ?></th>
                            <th class="text-center"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($dashboards as $dashboard): ?>
	<tr>
		<td class="text-center">
			<?php echo $this->Html->link($dashboard['Group']['name'], array('controller' => 'groups', 'action' => 'view', $dashboard['Group']['id'])); ?>
		</td>
		<td class="text-center"><?php echo h($dashboard['Dashboard']['name']); ?>&nbsp;</td>
        <td class="text-center"><?php echo h($dashboard['Dashboard']['link']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($dashboard['Dashboard']['position']); ?>&nbsp;</td>
		<td class="text-center"><?php echo "<i class='".$dashboard['Dashboard']['icon']."'></i> ".$dashboard['Dashboard']['icon']; ?>&nbsp;</td>
        <td class="text-center"><span class="<?php echo 'badge '.$dashboard['Dashboard']['color']; ?>"><?php echo $colors[$dashboard['Dashboard']['color']]; ?></span>&nbsp;</td>
		<td class="text-center"><?php echo h($dashboard['Dashboard']['created']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($dashboard['Dashboard']['modified']); ?>&nbsp;</td>
		<td class="text-center">
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $dashboard['Dashboard']['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $dashboard['Dashboard']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
			<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $dashboard['Dashboard']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $dashboard['Dashboard']['name'])); ?>
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
        $("#Dashboards").dataTable({
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