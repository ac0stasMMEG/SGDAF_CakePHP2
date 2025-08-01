<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
    <div class="col-xs-12">

    <div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo __('Supplier Ratings'); ?></h3>
			<div class="box-tools pull-right">
                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> New Supplier Rating'), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
		</div>	
			<div class="box-body table-responsive">
                <table id="SupplierRatings" class="table table-bordered table-striped">
					<thead>
						<tr>
                            <th class="text-center"><?php echo $this->Paginator->sort('id'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('memo_tracking_id'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('qualification_date'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('office'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('purchase_method'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('purchase_order_number'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('tender_number'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('product'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('service'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('amount'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('business_name'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('rut'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('entry'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('question_1'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('foundation_question_1'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('question_2'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('foundation_question_2'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('question_3'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('foundation_question_3'); ?></th>
                            <th class="text-center"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($supplierRatings as $supplierRating): ?>
	<tr>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['id']); ?>&nbsp;</td>
		<td class="text-center">
			<?php echo $this->Html->link($supplierRating['MemoTracking']['id'], array('controller' => 'memo_trackings', 'action' => 'view', $supplierRating['MemoTracking']['id'])); ?>
		</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['qualification_date']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['office']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['purchase_method']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['purchase_order_number']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['tender_number']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['product']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['service']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['amount']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['business_name']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['rut']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['entry']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['question_1']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['foundation_question_1']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['question_2']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['foundation_question_2']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['question_3']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($supplierRating['SupplierRating']['foundation_question_3']); ?>&nbsp;</td>
		<td class="text-center">
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $supplierRating['SupplierRating']['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $supplierRating['SupplierRating']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
			<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $supplierRating['SupplierRating']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $supplierRating['SupplierRating']['id'])); ?>
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
        $("#SupplierRatings").dataTable({
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