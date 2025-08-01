<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
    <div class="col-xs-12">

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo __('Requirement Trackings'); ?></h3>
                <div class="box-tools pull-right">
                    <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> New Requirement Tracking'), array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="RequirementTrackings" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center"><?php echo $this->Paginator->sort('id'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('requirement_id'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('requirement_tracking_type_id'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('milestone_id'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('to'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('creared'); ?></th>
                            <th class="text-center"><?php echo $this->Paginator->sort('modified'); ?></th>
                            <th class="text-center"><?php echo __('Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requirementTrackings as $requirementTracking): ?>
                        <tr>
                            <td class="text-center"><?php echo h($requirementTracking['RequirementTracking']['id']); ?>&nbsp;</td>
                            <td class="text-center">
                                <?php echo $this->Html->link($requirementTracking['Requirement']['name'], array('controller' => 'requirements', 'action' => 'view', $requirementTracking['Requirement']['id'])); ?>
                            </td>
                            <td class="text-center">
                                <?php echo $this->Html->link($requirementTracking['RequirementTrackingType']['name'], array('controller' => 'requirement_tracking_types', 'action' => 'view', $requirementTracking['RequirementTrackingType']['id'])); ?>
                            </td>
                            <td class="text-center">
                                <?php echo $this->Html->link($requirementTracking['Milestone']['name'], array('controller' => 'milestones', 'action' => 'view', $requirementTracking['Milestone']['id'])); ?>
                            </td>
                            <td class="text-center"><?php echo h($requirementTracking['RequirementTracking']['to']); ?>&nbsp;</td>
                            <td class="text-center"><?php echo h($requirementTracking['RequirementTracking']['creared']); ?>&nbsp;</td>
                            <td class="text-center"><?php echo h($requirementTracking['RequirementTracking']['modified']); ?>&nbsp;</td>
                            <td class="text-center">
                                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $requirementTracking['RequirementTracking']['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
                                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $requirementTracking['RequirementTracking']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
                                <?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $requirementTracking['RequirementTracking']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $requirementTracking['RequirementTracking']['id'])); ?>
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
        $("#RequirementTrackings").dataTable({
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
