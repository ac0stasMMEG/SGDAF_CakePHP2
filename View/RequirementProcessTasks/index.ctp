<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
    <div class="col-xs-12">

    <div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo __('Requirement Process Tasks'); ?></h3>
			<div class="box-tools pull-right">
                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> New Requirement Process Task'), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            </div>
		</div>	
			<div class="box-body table-responsive">
                <table id="RequirementProcessTasks" class="table table-bordered table-striped">
					<thead>
						<tr>
							<!-- <th class="text-center"><?php echo $this->Paginator->sort('id'); ?></th> -->
							<th class="text-center"><?php echo $this->Paginator->sort('requirement_process_id'); ?></th>
							<!-- <th class="text-center"><?php echo $this->Paginator->sort('requirement_process_area_id'); ?></th> -->
							<th class="text-center"><?php echo $this->Paginator->sort('order_task'); ?></th>
							<!-- <th class="text-center"><?php echo $this->Paginator->sort('area'); ?></th> -->
							<th class="text-center"><?php echo $this->Paginator->sort('name'); ?></th>
							<th class="text-center"><?php echo $this->Paginator->sort('description'); ?></th>
							<th class="text-center"><?php echo $this->Paginator->sort('plazo'); ?></th>
							<!-- <th class="text-center"><?php echo $this->Paginator->sort('deadline'); ?></th> -->
							<th class="text-center"><?php echo $this->Paginator->sort('created'); ?></th>
							<th class="text-center"><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="text-center"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php #pr($requirementProcessTasks) ?>
					<?php foreach ($requirementProcessTasks as $requirementProcessTask): ?>
						<tr>
							<!-- <td class="text-center"><?php echo h($requirementProcessTask['RequirementProcessTask']['id']); ?>&nbsp;</td> -->
							<td class="text-center">
								<?php echo $this->Html->link($requirementProcessTask['RequirementProcess']['name'], array('controller' => 'requirement_processes', 'action' => 'view', $requirementProcessTask['RequirementProcess']['id'])); ?>
							</td>
							<!-- <td class="text-center"><?php echo h($requirementProcessTask['RequirementProcessTask']['requirement_process_area_id']); ?>&nbsp;</td> -->
							<td class="text-center"><?php echo h($requirementProcessTask['RequirementProcessTask']['order_task']); ?>&nbsp;</td>
							<!-- <td class="text-center"><?php echo h($requirementProcessTask['RequirementProcessTask']['area']); ?>&nbsp;</td> -->
							<td class="text-center"><?php echo h($requirementProcessTask['RequirementProcessTask']['name']); ?>&nbsp;</td>
							<td class="text-center"><?php echo h($requirementProcessTask['RequirementProcessTask']['description']); ?>&nbsp;</td>
							<td class="text-center"><?php echo h($requirementProcessTask['RequirementProcessTask']['task_deadline']); ?>&nbsp;</td>
							<!-- <td class="text-center"><?php echo h($requirementProcessTask['RequirementProcessTask']['deadline']); ?>&nbsp;</td> -->
							<td class="text-center"><?php echo h($requirementProcessTask['RequirementProcessTask']['created']); ?>&nbsp;</td>
							<td class="text-center"><?php echo h($requirementProcessTask['RequirementProcessTask']['modified']); ?>&nbsp;</td>
							<td class="text-center">
								<?php 
									echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), 
										array('action' => 'view', $requirementProcessTask['RequirementProcessTask']['id']), 
										array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')
									);
								?>
								<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $requirementProcessTask['RequirementProcessTask']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
								<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $requirementProcessTask['RequirementProcessTask']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $requirementProcessTask['RequirementProcessTask']['id'])); ?>
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
        $("#RequirementProcessTasks").dataTable({
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