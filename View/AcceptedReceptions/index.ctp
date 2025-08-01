<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
    <div class="col-xs-12">

    <div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo __('Accepted Receptions'); ?></h3>
			<div class="box-tools pull-right">
                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> New Accepted Reception'), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
		</div>	
			<div class="box-body table-responsive">
                <table id="AcceptedReceptions" class="table table-bordered table-striped">
					<thead>
						<tr>
                            <th class="text-center"><?php echo $this->Paginator->sort('id'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('memo_tracking_id'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('name'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('supplier_name'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('supplier_rut'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('purchase_order'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('amount'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('purchase_order_received'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('purchase_order_received_p'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('office_guide_number'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('office_guide_date'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('invoice_number'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('invoice_date'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('purchase_order_number'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('purchase_order_date'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('created'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('modified'); ?></th>
                            <th class="text-center"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($acceptedReceptions as $acceptedReception): ?>
	<tr>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['id']); ?>&nbsp;</td>
		<td class="text-center">
			<?php echo $this->Html->link($acceptedReception['MemoTracking']['id'], array('controller' => 'memo_trackings', 'action' => 'view', $acceptedReception['MemoTracking']['id'])); ?>
		</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['name']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['supplier_name']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['supplier_rut']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['purchase_order']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['amount']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['purchase_order_received']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['purchase_order_received_p']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['office_guide_number']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['office_guide_date']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['invoice_number']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['invoice_date']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['purchase_order_number']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['purchase_order_date']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['created']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($acceptedReception['AcceptedReception']['modified']); ?>&nbsp;</td>
		<td class="text-center">
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $acceptedReception['AcceptedReception']['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $acceptedReception['AcceptedReception']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
			<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $acceptedReception['AcceptedReception']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $acceptedReception['AcceptedReception']['id'])); ?>
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
        $("#AcceptedReceptions").dataTable({
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