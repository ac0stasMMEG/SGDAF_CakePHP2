<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
    <div class="col-xs-12">

    <div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo __('Requirement Attachments'); ?></h3>
			<div class="box-tools pull-right">
                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> New Requirement Attachment'), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
		</div>	
			<div class="box-body table-responsive">
                <table id="RequirementAttachments" class="table table-bordered table-striped">
					<thead>
						<tr>
													<th class="text-center"><?php echo $this->Paginator->sort('id'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('requiremet_attachment_type_id'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('name'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('description'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('type'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('data'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('size'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('disable'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('created'); ?></th>
													<th class="text-center"><?php echo $this->Paginator->sort('modified'); ?></th>
												<th class="text-center"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($requirementAttachments as $requirementAttachment): ?>
	<tr>
		<td class="text-center"><?php echo h($requirementAttachment['RequirementAttachment']['id']); ?>&nbsp;</td>
		<td class="text-center">
			<?php echo $this->Html->link($requirementAttachment['RequiremetAttachmentType']['name'], array('controller' => 'requiremet_attachment_types', 'action' => 'view', $requirementAttachment['RequiremetAttachmentType']['id'])); ?>
		</td>
		<td class="text-center"><?php echo h($requirementAttachment['RequirementAttachment']['name']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($requirementAttachment['RequirementAttachment']['description']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($requirementAttachment['RequirementAttachment']['type']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($requirementAttachment['RequirementAttachment']['data']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($requirementAttachment['RequirementAttachment']['size']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($requirementAttachment['RequirementAttachment']['disable']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($requirementAttachment['RequirementAttachment']['created']); ?>&nbsp;</td>
		<td class="text-center"><?php echo h($requirementAttachment['RequirementAttachment']['modified']); ?>&nbsp;</td>
		<td class="text-center">
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $requirementAttachment['RequirementAttachment']['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
			<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $requirementAttachment['RequirementAttachment']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
			<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $requirementAttachment['RequirementAttachment']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $requirementAttachment['RequirementAttachment']['id'])); ?>
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
        $("#RequirementAttachments").dataTable({
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