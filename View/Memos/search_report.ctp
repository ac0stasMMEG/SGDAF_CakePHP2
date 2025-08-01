<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<?php if(!$excel): ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="box box-primary">
                <div class="box-body table-responsive">
                    <h3><?php echo __('Realice su búsqueda:'); ?></h3>
                    <?php echo $this->Form->create('Memo', array('role' => 'form')); ?>
                    <fieldset>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <?php echo $this->Form->input('startDate', array('class' => 'form-control dateform', 'value' => $startDate, 'required' => true, 'placeholder' => __('Start Date'), 'label' => __('Fecha de Inicio'), 'readonly' => true)); ?>
                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->input('endDate', array('class' => 'form-control dateform', 'value' => $endDate, 'required' => true, 'placeholder' => __('End Date'), 'label' => __('Fecha de Termino'), 'readonly' => true)); ?>
                            </div>
                            <div class="col-xs-12"><br></div>
                            <div class="col-xs-12">
                                <?php echo $this->Form->input('keyword', array('class' => 'form-control', 'required' => false, 'label' => __('Palabra Clave'))); ?>
                            </div>   
                            <div class="col-xs-12"><br></div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->input('header', array('class' => '', 'style' => 'margin-left:0px;transform:scale(1.5)', 'type' => 'checkbox', 'label' => __('Buscar en la Referencia del Memo'), 'checked' => true)); ?>
                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->input('description', array('class' => '', 'style' => 'margin-left:0px;transform:scale(1.5)', 'type' => 'checkbox', 'label' => __('Buscar en la Descripción del Memo'))); ?>
                            </div>  
                        </div>  
                    </fieldset><br>
                    <div align="center">
                        <button type="submit" class="btn btn-linkedin ajax send_without">
                            <i class="glyphicon glyphicon-search"></i> <?php echo __('Search'); ?>
                        </button>
                        <!--<button type="submit" class="btn btn-linkedin ajax send_without" name="excel">
                            <i class="fa fa-file-excel-o"></i> <?php //echo __('Exportar a EXCEL'); ?>
                        </button>-->
                    </div> 

                    <?php echo $this->Form->end(); ?>

                </div><!-- /.form -->			
            </div><!-- /#page-content .col-sm-9 -->
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Resultados'); ?></h3>
                    <div class="box-tools pull-right"></div>
                </div>	
                <div class="box-body">
                    <table id="MemoTrackings" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo __('N° Memo'); ?></th>
                                <th class="text-center"><?php echo __('Reference'); ?></th>
                                <th class="text-center"><?php echo __('Bandeja'); ?></th>
                                <th class="text-center"><?php echo __('Created'); ?></th>
                                <th class="text-center"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($searchs as $search): ?>
                            <tr>
                                <td class="text-center"><?php echo h('D'.$search['Memo']['memo_number'].'-'.$search['Memo']['year']); ?>&nbsp;</td>
                                <td class="text-center"><?php echo h($search['Memo']['reference']); ?>&nbsp;</td>
                                <td class="text-center">
                                    <?php
                                        if(is_null($search['Memo']['memo_number'])):
                                            echo h('Borrador');
                                        elseif($search['Memo']['state_id'] == '5e347552-4c10-49d8-947d-94bcc26b1ae0'):
                                            echo h('Gestionado');
                                        elseif($search['MemoTracking']['memo_tracking_type_id'] == '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0'):
                                            echo h('Enviados');
                                        elseif($search['MemoTracking']['memo_tracking_type_id'] == '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'):
                                            echo h('Recibidos');
                                        elseif($search['MemoTracking']['memo_tracking_type_id'] == '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0'):
                                            echo h('Notificación');
                                        endif;
                                    ?>
                                </td>
                                <td class="text-center"><?php echo h($search['Memo']['created']); ?>&nbsp;</td>
                                <td class="text-center">
                                    <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>&nbsp; Ver Detalle'), array('action' => 'view', $search['Memo']['id']), array('class' => 'btn btn-primary', 'escape' => false, 'data-toggle'=>'tooltip', 'target' => '_blank')); ?>
                                    <?php //echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $memoTracking['MemoTracking']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
                                    <?php //echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $memoTracking['MemoTracking']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $memoTracking['MemoTracking']['id'])); ?>
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
    else: 
        
        /*$filename ="Reporte_Memos.xls";
        header('Content-type: application/ms-excel');
        header('Content-Disposition: attachment; filename='.$filename);*/
?>
    <table>
        <thead>
            <tr>
                <th><?php echo __('N° Memo'); ?></th>
                <th><?php echo __('Send By'); ?></th>
                <th><?php echo __('Addressee'); ?></th>
                <th><?php echo __('Reference'); ?></th>
                <th><?php echo __('Description'); ?></th>
                <th><?php echo __('Bandeja'); ?></th>
                <th><?php echo __('Created'); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($searchs as $search): ?>
            <tr>
                <td><?php echo h('D'.$search['Memo']['memo_number'].'-'.$search['Memo']['year']); ?>&nbsp;</td>
                <td><?php echo $this->requestAction('memos/find_owner/'.$search['Memo']['id']); ?></td>
                <td>
                    <?php 
                        foreach($search['MemoTracking'] as $tracking):
                            if(($tracking['memo_tracking_type_id'] == "5b8588b3-667c-4f97-a1ec-1f68c26b1ae0") AND ($tracking['viewed'] == 0)): // Aprobación 
                                echo $this->requestAction('memos/find_user_username/'.$tracking['to']).'<br>';
                            endif; 
                        endforeach; 
                    ?>
                </td>
                <td><?php echo h($search['Memo']['reference']); ?>&nbsp;</td>
                <td><?php echo h($search['Memo']['description']); ?>&nbsp;</td>
                <td>
                    <?php
                        if(is_null($search['Memo']['memo_number'])):
                            echo h('Borrador');
                        elseif($search['Memo']['state_id'] == '5e347552-4c10-49d8-947d-94bcc26b1ae0'):
                            echo h('Gestionado');
                        elseif($search['MemoTracking']['memo_tracking_type_id'] == '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0'):
                            echo h('Enviados');
                        elseif($search['MemoTracking']['memo_tracking_type_id'] == '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'):
                            echo h('Recibidos');
                        elseif($search['MemoTracking']['memo_tracking_type_id'] == '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0'):
                            echo h('Notificación');
                        endif;
                    ?>
                </td>
                <td><?php echo h($search['Memo']['created']); ?>&nbsp;</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    
<?php endif;?>

<!-- <table id="MemoTrackings1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><?php /*echo __('Año'); ?></th>
                <th><?php echo __('Número de Registro'); ?></th>
                <th><?php echo __('Fecha de Registro'); ?></th>
                <th><?php echo __('Emisor'); ?></th>
                <th><?php echo __('Destinatario'); ?></th>
                <th><?php echo __('Materia'); ?></th>
                <th><?php echo __('Referencia'); ?></th>
                <th><?php echo __('Materia o Descripción'); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($searchs as $search): ?>
            <tr>
                <td><?php echo h($search['Memo']['year']); ?>&nbsp;</td>
                <td><?php echo h('D'.$search['Memo']['memo_number'].'-'.$search['Memo']['year']); ?>&nbsp;</td>
                <td><?php echo h($search['Memo']['created']); ?>&nbsp;</td>
                <td><?php echo h($search['Memo']['initial_responsibility']); ?>&nbsp;</td>
                <td><?php echo $this->requestAction('memos/find_user_username/'.$search['MemoTracking'][0]['to']); ?>&nbsp;</td>
                <td><?php echo h($search['Matter']['name']); ?>&nbsp;</td>
                <td><?php echo h($search['Memo']['reference']); ?>&nbsp;</td>
                <td><?php echo strip_tags($search['Memo']['description']); ?>&nbsp;</td>
            </tr>
        <?php endforeach; */?>
        </tbody>
    </table>-->
 <?php //debug($searchs);

        echo $this->Html->script('../js/plugins/datatables/jquery.dataTables');
        echo $this->Html->script('../js/plugins/datatables/dataTables.bootstrap');

        echo $this->Html->script('../js/plugins/datepicker/bootstrap-datepicker.js');
        echo $this->Html->script('../js/plugins/datepicker/locales/bootstrap-datepicker.es.js');

    ?>
    <script>

        $(function() {
            $("#MemoTrackings").dataTable({
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
                order: [0, "desc"],
            });
        });

    </script>