<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="box box-primary">
            <div class="box-body table-responsive">
                <h3><?php echo __('(*) Ingrese un término de búsqueda:'); ?></h3>
                <?php echo $this->Form->create('Memo', array('role' => 'form')); ?>
                
                    <div class="col-xs-12">    
                        <div class="col-sm-8">
                            <?php echo $this->Form->input('search', array('class' => 'form-control', 'required' => true, 'label' => false, 'required' => true, 'placeholder' => __('Ej: 1234 o una palabra'))); ?>
                        </div>    
                        <div class="col-sm-3">
                                <?php echo $this->Form->input('year', array('class' => 'form-control', 'label' => false, 'type' => 'date', 'dateFormat' => 'Y', 'minYear' => 2018, 'maxYear' => date('Y'))); ?>
                        </div>    
                    </div><br><br>
                    <div class="col-xs-12">      
                        <div class="col-sm-offset-1 col-sm-4">
                            <?php echo $this->Form->input('from', array('type'=>'checkbox', 'label' => __('Mostrar solo los enviados por mi.'))); ?>
                        </div>
                        <div class="col-sm-offset-2 col-sm-4">
                            <?php echo $this->Form->input('to', array('type'=>'checkbox', 'label' => __('Mostrar solo los enviados a mi.'))); ?>
                        </div>  
                    </div>    
                    <!-- .form-group --><br><br>
                    <div align="center">
                        <button type="submit" class="btn btn-linkedin ajax send_without">
                            <i class="glyphicon glyphicon-search"></i> <?php echo __('Search'); ?>
                        </button>
                    </div>        
                <hr>
                <small>(*) Los criterios de búsqueda se realizan en base a: número, referencia o descripción.</small>
                <?php echo $this->Form->end(); ?>

            </div><!-- /.form -->			
        </div><!-- /#page-content .col-sm-9 -->
    </div>

    <?php if(!empty($searchs)): ?> 
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Searchs'); ?></h3>
                    <div class="box-tools pull-right"></div>
                </div>	
                <div class="box-body table-responsive">
                    <table id="Searchs" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo __('Number'); ?></th>
                                <th class="text-center" style="width:200px"><?php echo __('Send By'); ?></th>
                                <th class="text-center" style="width:200px"><?php echo __('Addressee'); ?></th>
                                <th class="text-center"><?php echo __('Reference'); ?></th>
                                <th class="text-center"><?php echo __('Nro Externo'); ?></th>
                                <th class="text-center"><?php echo __('Nro Interno'); ?></th>
                                <th class="text-center"><?php echo __('Memo Date'); ?></th>
                                <th class="text-center"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($searchs as $search): ?>
                                <tr>
                                    <td class="text-center"><?php echo h('D'.$search['Memo']['memo_number'].'-'.$search['Memo']['year']); ?>&nbsp;</td>
                                    <td class="text-center"><?php echo $this->requestAction('memos/find_owner/'.$search['Memo']['id']); ?></td>
                                    <td>
                                        <?php
                                            if($this->request->data['Memo']['to']):
                                                echo $this->requestAction('memos/find_user_username/'.$search['MemoTracking']['to']);
                                            else:
                                                foreach($search['MemoTracking'] as $tracking):
                                                    if(($tracking['memo_tracking_type_id'] == "5b8588b3-667c-4f97-a1ec-1f68c26b1ae0") AND ($tracking['viewed'] == 0)): // Aprobación 
                                                        echo $this->requestAction('memos/find_user_username/'.$tracking['to']).'<br>';
                                                    endif; 
                                                endforeach; 
                                            endif;
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo h($search['Memo']['reference']); ?>&nbsp;</td>
                                    <td class="text-center"><?php echo h($search['Memo']['external_office']); ?>&nbsp;</td>
                                    <td class="text-center"><?php echo h($search['Memo']['internal_office']); ?>&nbsp;</td>
                                    <td class="text-center">
                                        <span style="display:none"><?php echo strtotime($search['Memo']['created']); ?><br></span>
                                        <?php echo date("d-m-Y H:i:s", strtotime($search['Memo']['created'])); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-time"></i> &nbsp; Time Line'), array('action' => 'time_line', $search['Memo']['id'], true), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'time_line', 'target' => '_blank')); ?> 
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.table-responsive --
                </div><!-- /.index -->
            </div><!-- /#page-content .col-sm-9 -->
        </div><!-- /#page-container .row-fluid -->  
    <?php elseif(is_null($searchs)): ?>
    <?php else: ?>
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Searchs'); ?></h3>
                    <div class="box-tools pull-right"></div>
                </div>	
                <div class="box-body table-responsive">
                    <table id="Searchs" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo __('Number'); ?></th>
                                <th class="text-center"><?php echo __('Send By'); ?></th>
                                <th class="text-center"><?php echo __('Addressee'); ?></th>
                                <th class="text-center"><?php echo __('Reference'); ?></th>
                                <th class="text-center"><?php echo __('Memo Date'); ?></th>
                                <th class="text-center"><?php echo __('Actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div><!-- /.table-responsive --
                </div><!-- /.index -->
            </div><!-- /#page-content .col-sm-9 -->
        </div><!-- /#page-container .row-fluid -->  
    <?php endif; ?>    
</div>     
<?php

	echo $this->Html->script('../js/plugins/datatables/jquery.dataTables');
	echo $this->Html->script('../js/plugins/datatables/dataTables.bootstrap');
?>
<script type="text/javascript">
    
    $(document).on('click', 'input[type="checkbox"]', function() {      
        $('input[type="checkbox"]').not(this).prop('checked', false);      
    });
    
    $(function() {
        $("#Searchs").dataTable({
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
            order: [4, "desc"],
        });
        
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>