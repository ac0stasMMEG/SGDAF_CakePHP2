<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<?php if($id2): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-widget">
                <div class="box-header">
                    <div class="user-block ">
                        <div class="box-tools pull-right">        
                            <div class="btn-group"> 
                                <button name="<?php echo Router::url('/memos/pdf/', true).$memo['Memo']['id'].'/0.pdf'; ?>" class="btn btn-linkedin online" data-toggle="modal" data-target="#myModalFrame"><?php echo __('<i class="glyphicon glyphicon-resize-full"></i> &nbsp; Online Memo'); ?></button>
                                <?php if($memo['Memo']['memo_number']): ?>    
                                    <button type="button" class="btn btn-linkedin" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-download-alt"></i> &nbsp;<?php echo __('Export ');?>&nbsp;<span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><?php echo $this->Html->link(__('Eo (Pxport MemDF)'), array('action' => 'pdf', $memo['Memo']['id'], 'ext' => 'pdf'), array('class' => '', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export')); ?></li>
                                        <li><?php echo $this->Html->link(__('Export Attach (ZIP)'), array('action' => 'create_zip', $memo['Memo']['id']), array('class' => '', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export'), __('It is in the process of exporting the memorandum (s) and their attachments. This process may delay. %s (PDF/ZIP)', $memo['Memo']['reference'])); ?></li>
                                        <li><?php echo $this->Html->link(__('Exportar Memos y Formularios de Conformidad'), array('action' => 'all_files', $memo['Memo']['id'].'/Sistema Digital - Ministerio de la Mujer y la Equidad de Género', 'ext' => 'pdf'), array('name' => Router::url('/memos/all_files/', true).$memo['Memo']['id'].'/Sistema Digital - Ministerio de la Mujer y la Equidad de Género.pdf', 'class' => 'online', 'data-toggle' => 'modal', 'data-target' => '#myModalFrame')); ?></li>
                                    </ul>
                    
                                    <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-time"></i> &nbsp; Time Line'), array('action' => 'time_line', $memo['Memo']['id']), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'linea de tiempo')); ?>  
                                    <?php
                                        /*if(($memo['Memo']['state_id'] != '60ef08b2-e448-4759-9e42-32b8c26b1ae0') AND ($box === 'box_2')):
                                            echo $this->Html->link(__('<i class="glyphicon glyphicon-sort"></i> &nbsp; Recuperar'), array('action' => 'recover', $memo['Memo']['id']), array('class' => 'btn btn-info', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'recuperar')); 
                                        elseif(($memo['Memo']['state_id'] == '60ef08b2-e448-4759-9e42-32b8c26b1ae0') AND ($box === 'box_2')):
                                            echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>&nbsp;'.__('Edit'), array('action' => 'edit', $memo['Memo']['id']), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit', 'type' => 'button'));
                                        endif;*/
                                    ?>  
                                <?php endif; ?>
                                <?php    
                                    if(is_null($memo['Memo']['memo_number']) AND is_null($menu)){

                                        echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>&nbsp;'.__('Edit'), array('action' => 'edit', $memo['Memo']['id']), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit', 'type' => 'button'));

                                        echo $this->Html->link('<i class="glyphicon glyphicon-send"></i>&nbsp;'.__(' Send'), array('action' => 'send', $memo['Memo']['id']), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'send', 'type' => 'button'));
                                ?>        
                                        <?php if(!empty($subrogances)): ?>
                                            <button type="button" class="btn btn-linkedin dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-users"></i> <?php echo __('Subrogance'); ?>&nbsp;
                                                <span class="caret"></span>
                                                <span class="sr-only"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <?php foreach($subrogances as $idSubrogance => $nameSubrogance): ?>
                                                    <li><?php echo $this->Html->link($nameSubrogance, array('action' => 'send', $memo['Memo']['id'], $idSubrogance), array('class' => '', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export')); ?></li>
                                                <?php endforeach; ?>
                                            </ul>                                
                                        <?php endif; ?>
                                <?php } ?>
                                <?php 
                                
                                    $editBtn = false;
                                
                                    if(($memo['Memo']['parent_id']) AND is_null($menu)){
                                        if(($refusedParent === '1') AND ($refused === '0')){
                                            echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>&nbsp;'.__('Edit'), array('action' => 'edit', $memo['Memo']['id']), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit', 'type' => 'button'));
                                            
                                            echo $this->Html->link(__('<i class="fa fa-close"></i> &nbsp; Refuse'), array('controller' => 'memo_trackings', 'action' => 'refuse', $memo['Memo']['id'], $memo['Memo']['parent_id']), array('class' => 'btn btn-danger', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'refuse', 'data-toggle' => 'modal',  'data-target' => '#myModalNormal'));
                                            
                                            $editBtn = true;
                                        }
                                    }
                                
                                    if($refused === '0'){
                                        if(!$editBtn){
                                            echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>&nbsp;'.__('Edit'), array('action' => 'edit', $memo['Memo']['id']), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit', 'type' => 'button'));
                                        }
                                        
                                    }elseif($shuntMemoObservation){
                                        
                                        echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>&nbsp;'.__('Edit'), array('action' => 'edit', $memo['Memo']['id'],1), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit', 'type' => 'button'));
                                        
                                        echo $this->Html->link(__('<i class="fa fa-share-alt"></i> &nbsp; Shunt'), array('controller' => 'memo_trackings', 'action' => 'shunt', $memo['Memo']['id']), array('class' => 'btn btn-warning', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'refuse', 'data-toggle' => 'modal',  'data-target' => '#myModalShunt'));
                                    }
                                
                                ?>
                                <?php
                                    if(is_null($approved) AND ($memo['Memo']['memo_number']) AND is_null($memo['Memo']['state_id']) AND is_null($menu)){

                                        echo $this->Html->link(__('<i class="fa fa-check"></i> &nbsp; Approve'), array('action' => 'add', $memo['Memo']['id']), array('class' => 'btn btn-success', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'add')); 

                                        echo $this->Html->link(__('<i class="fa fa-close"></i> &nbsp; Refuse'), array('controller' => 'memo_trackings', 'action' => 'refuse', $memo['Memo']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'refuse', 'data-toggle' => 'modal',  'data-target' => '#myModalNormal'));
                                        
                                        echo $this->Html->link(__('<i class="fa fa-share-alt"></i> &nbsp; Shunt'), array('controller' => 'memo_trackings', 'action' => 'shunt', $memo['Memo']['id']), array('class' => 'btn btn-warning', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'refuse', 'data-toggle' => 'modal',  'data-target' => '#myModalShunt'));
                                        
                                        echo $this->Html->link(__('<i class="fa fa-clipboard"></i> &nbsp; Gestionado'), array('controller' => 'states', 'action' => 'complete', $memo['Memo']['id']), array('class' => 'btn bg-purple', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'gestionado', 'data-toggle' => 'modal',  'data-target' => '#myModalState'));
                                    }elseif(($memo['Memo']['state_id'] == '61114fa2-ba9c-462d-84ce-4d34c26b1ae0') AND ($box === 'box_1')){
                                        echo $this->Html->link(__('<i class="fa fa-check"></i> &nbsp; Approve'), array('action' => 'add', $memo['Memo']['id']), array('class' => 'btn btn-success', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'add')); 

                                        echo $this->Html->link(__('<i class="fa fa-close"></i> &nbsp; Refuse'), array('controller' => 'memo_trackings', 'action' => 'refuse', $memo['Memo']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'refuse', 'data-toggle' => 'modal',  'data-target' => '#myModalNormal'));
                                        
                                        echo $this->Html->link(__('<i class="fa fa-share-alt"></i> &nbsp; Shunt'), array('controller' => 'memo_trackings', 'action' => 'shunt', $memo['Memo']['id']), array('class' => 'btn btn-warning', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'refuse', 'data-toggle' => 'modal',  'data-target' => '#myModalShunt'));
                                        
                                    }elseif(($memo['Memo']['state_id'] == '5e347552-4c10-49d8-947d-94bcc26b1ae0') AND ($box === 'box_5')){ // Gestionado
                                        echo $this->Html->link(__('<i class="fa fa-clipboard"></i> &nbsp; Restaurar'), array('controller' => 'states', 'action' => 'complete', $memo['Memo']['id'], 0), array('class' => 'btn bg-purple', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'gestionado', 'data-toggle' => 'modal',  'data-target' => '#myModalState'));
                                    }
                                ?>
                                <!-- button type="button" class="btn btn-linkedin" id="return_memo"><i class="glyphicon glyphicon-retweet"></i>&nbsp;&nbsp;<?php //echo __('Return'); ?></button> -->
                                <?php //echo $tabMemo; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-widget widget-user-2">        
                <div class="widget-user-header bg-memo-active">
                    <div class="widget-user-image">
                        <?php $thumbnailphoto = $this->requestAction('memos/find_owner/'.$memo['Memo']['id'].'/1'); ?>
                        <?php if($thumbnailphoto != 'Sin Información'): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($thumbnailphoto); ?>"  class="img-circle">
                        <?php else:?>
                            <?php echo $this->Html->image('../dist/img/digital.png', array('class' => 'img-circle')); ?> 
                        <?php endif;?>
                    </div>
                    <!-- /.widget-user-image -->
                    <h5 class="widget-user-desc"><i class="fa fa-calendar margin-r-5"></i><?php echo $memo['MemoTracking'][0]['created']; ?></h5>
                    <h3 class="widget-user-username"><b><?php echo h('D'.$memo['Memo']['memo_number'].'-'.$memo['Memo']['year']); ?></b></h3>
                    <h5 class="widget-user-desc"><?php echo $this->requestAction('memos/find_owner/'.$memo['Memo']['id']); ?></h5>
                    <?php if($memo['Memo']['importance']): ?><br>
                        <h5 class="widget-user-desc"><span class="label label-danger"><?php echo __('Memo sent with high importance'); ?></span></h5>
                    <?php endif; ?>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>
                            <a>
                                <b><?php echo __('Reference'); ?>:</b>
                                <?php echo $memo['Memo']['reference']; ?>
                            </a>
                        </li>  
                        <li><a><b><?php echo __('Addressee'); ?>:</b>
                            <?php if(!empty($memoAddressee)): ?>
                            <?php foreach($memoAddressee as $tracking):?>
                                <?php echo $this->requestAction('memos/find_user_username/'.$tracking['MemoTracking']['to']); ?>
                            <?php endforeach; ?>
                            <?php $observationReject = $tracking['MemoTracking']['observation']; ?>
                        <?php endif; ?></a>
                        </li>
                        <li><a><b><?php echo __('Notify'); ?>:</b>
                        <?php if(!empty($memoNotify)): ?>
                            <?php foreach($memoNotify as $tracking):?>
                                <?php echo $this->requestAction('memos/find_user_username/'.$tracking['MemoTracking']['to']); ?> /
                            <?php endforeach; ?>
                            <?php endif;?></a>
                        </li> 
                        <li>
                            <a>
                                <b><?php echo __('Matter'); ?>:</b>
                                <?php echo $memo['Matter']['name']; ?>
                            </a>
                        </li>
                        <?php if(!empty($observationReject)): ?>
                        <li>
                            <a>
                                <b><?php echo __('Reason for return'); ?>: </b>
                                <?php echo $observationReject; ?>  
                            </a>
                        </li>      
                        <?php endif;?>
                        <?php if(!empty($shuntMemoObservation)): ?>
                        <li>
                            <a>
                                <b><?php echo __('Reason for shunt'); ?>: </b>
                                <?php echo $shuntMemoObservation; ?>  
                            </a>
                        </li>      
                        <?php endif;?>
                    </ul>
                </div>
            </div>   
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-memo">
                    <h3 class="widget-user-username"><b><?php echo __('Description'); ?></b></h3>
                </div>
            </div>
            <?php echo $memo['Memo']['description']; ?> <br>
        </div>  
    </div>
    <?php if(!empty($allAttachMemos) OR ($memo['Matter']['forms'] === '1')): ?>
        <div class="row">
            <div class="col-md-12">	
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-memo">
                        <h3 class="widget-user-username"><b><?php echo __('Attachments'); ?></b></h3>
                    </div>
                </div>
                <div class="">
                    <div class="box box-widget">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered table-striped" id="Attachs">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo __('Name'); ?></th>
                                        <th class="text-center"><?php echo __('Description'); ?></th>
                                        <th class="text-center"><?php echo __('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($memo['Matter']['forms'] === '1'): ?>
                                        <tr>
                                            <td class="text-left"><?php echo __('Accepted Reception'); ?></td>
                                            <td></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <?php 
                                                        if(!$idformAcceptedReception):
                                                            echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> Add'), array('controller' => 'accepted_receptions', 'action' => 'add', $memo['Memo']['id']), array('class' => 'btn btn-linkedin', 'escape' => false));    
                                                        else:
                                                            echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('controller' => 'accepted_receptions', 'action' => 'edit', $idformAcceptedReception), array('class' => 'btn btn-linkedin', 'escape' => false));
                                                    ?>
                                                            <button name="<?php echo Router::url('/accepted_receptions/pdf/', true).$idformAcceptedReception.'.pdf'; ?>" class="btn btn-linkedin online" data-toggle="modal" data-target="#myModalFrame"><i class="glyphicon glyphicon-eye-open"></i>  <?php echo __('View'); ?></button>
                                                    <?php
                                                    endif;
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"><?php echo __('Supplier Rating'); ?></td>
                                            <td></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <?php 
                                                        if(!$idformSupplierRating):
                                                            echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> Add'), array('controller' => 'supplier_ratings', 'action' => 'add', $memo['Memo']['id']), array('class' => 'btn btn-linkedin', 'escape' => false));
                                                        else:
                                                            echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('controller' => 'supplier_ratings', 'action' => 'edit',  $idformSupplierRating), array('class' => 'btn btn-linkedin', 'escape' => false));
                                                    ?>
                                                            <button name="<?php echo Router::url('/supplier_ratings/pdf/', true).$idformSupplierRating.'.pdf'; ?>" class="btn btn-linkedin online" data-toggle="modal" data-target="#myModalFrame"><i class="glyphicon glyphicon-eye-open"></i>  <?php echo __('View'); ?></button>
                                                    <?php
                                                        endif; 
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(!empty($allAttachMemos)): ?>
                                        <?php 
                                            $i = 0;
                                            foreach ($allAttachMemos as $count => $attachment): ?>
                                                <tr>
                                                    <td><?php echo $attachment['Attachment']['name']; ?></td>
                                                    <td><?php echo $attachment['Attachment']['description']; ?></td>
                                                    <td class="text-center">
                                                        <a target="_blank" href="<?php echo $this->Html->url('/files/'.$attachment['Attachment']['id'].'/'.$attachment['Attachment']['name']); ?>"><button type="button" class="btn btn-linkedin" ><i class="glyphicon glyphicon-eye-open"></i> &nbsp;<?php echo __('View'); ?></button></a>
                                                    </td>
                                                </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table><!-- /.table table-striped table-bordered -->
                        </div><!-- /.table-responsive -->
                    </div>    
                </div>
            </div>    
        </div>    
    <?php endif; ?>  
    <?php if(count($allMemos) > 1): ?>
        <div class="row">    
            <div class="col-md-12">		
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-memo">
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username"><b><?php echo __('Related Memos'); ?></b></h3>
                    </div>
                </div>
                <div class="box box-widget">
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="Memos">
                            <thead>
                                <tr>
                                    <th class="text-center"><?php echo __('Description'); ?></th>
                                    <th class="text-center" hidden><?php echo __('Description'); ?></th>
                                    <th class="text-center"><?php echo __('Actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                    foreach ($allMemos as $memos): ?>
                                        <?php if ($memos['Memo']['id'] <> $memo['Memo']['id']): ?>
                                        <tr>
                                            <td>
                                                <div class="post">
                                                    <div class="user-block">
                                                        <span class="username">
                                                            <?php if($memos['Memo']['importance']): ?>
                                                                <a><font color="#dd4b39"><?php echo h('D'.$memos['Memo']['memo_number'].'-'.$memo['Memo']['year']); ?></font></a>
                                                            <?php else: ?>
                                                                <a><?php echo h('D'.$memos['Memo']['memo_number'].'-'.$memo['Memo']['year']); ?></a>    
                                                            <?php endif; ?>

                                                            <a href="" class="pull-right btn-box-tool"><?php echo $this->requestAction('memos/find_owner/'.$memos['Memo']['id']); ?></a>
                                                        </span>
                                                        <span class="description"><?php echo h($memos['Memo']['reference']); ?></span>
                                                    </div>
                                                    <ul class="list-inline">
                                                        <?php if($memos['Memo']['importance']): ?>
                                                            <li><a href="" class="link-black text-sm"><i class="fa fa-exclamation margin-r-5"></i><?php echo __('importance');?></a>
                                                        <?php endif; ?>  

                                                        <li class="pull-right">
                                                        <a href="" class="link-black text-sm"><i class="fa fa-calendar margin-r-5"></i><?php echo h($memos['MemoTracking'][0]['created']); ?></a></li>
                                                    </ul>
                                                </div>
                                            </td>    
                                            <td class="text-center" hidden><?php echo strip_tags($memo['Memo']['description']); ?>&nbsp;</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i> View'), array('action' => 'view', $memos['Memo']['id']), array('class' => 'btn btn-primary', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button')); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table><!-- /.table table-striped table-bordered -->
                    </div><!-- /.table-responsive -->
                </div><!-- /.related -->
            </div><!-- /#page-content .span9 -->
        </div>
    <?php endif; ?>
<?php else: ?>
    <hr>
    <div class="text-center"><h3><?php echo __('Memorándum no encontrado ...');?></h3></div>
<?php endif; ?>    
<?php
	echo $this->Html->script('../js/plugins/datatables/jquery.dataTables');
	echo $this->Html->script('../js/plugins/datatables/dataTables.bootstrap');
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.online').click(function(){
            var url = $(this).attr('name');

            $("#popUp").attr('src', url);  
        });
        
        
        $("#Memos").dataTable({
            destroy: true,
            "ordering": false,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Memos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Memos",
                "infoFiltered": "(Filtrado de _MAX_ total memos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Memos",
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
        
        $("#Attachs").dataTable({
            destroy: true,
            "ordering": false,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Adjuntos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Adjuntos",
                "infoFiltered": "(Filtrado de _MAX_ total adjuntos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Adjuntos",
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
