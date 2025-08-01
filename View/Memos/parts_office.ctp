<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>
<div class="row">
    <div class="col-md-7 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-body table-responsive">
                <div class="box-body">
                    <div class="row">
                        <?php echo $this->Form->create('Memo', array('role' => 'form', 'id' => 'MemoIndexFormDate')); ?>
                        <div class="col-xs-5 has-feedback">
                            <?php echo $this->Form->input('reference', array('class' => 'form-control dateform', 'value' => @$reference, 'required' => false, 'label' => __('Fecha Inicio'), 'label' => __('Referencia'))); ?>
                        </div>
                        <div class="col-xs-2 has-feedback">
                            <?php echo $this->Form->input('startDate', array('class' => 'form-control dateform', 'value' => $startDate, 'required' => true, 'label' => __('Fecha Inicio'), 'placeholder' => __('Start Date'))); ?>
                        </div>
                        <div class="col-xs-2 has-feedback">
                            <?php echo $this->Form->input('endDate', array('class' => 'form-control dateform', 'value' => $endDate, 'required' => true, 'label' => __('Fecha Termino'), 'placeholder' => __('End Date'))); ?>
                        </div><br>
                        <div align="center">
                            <button type="submit" class="btn btn-linkedin">
                                <i class="glyphicon glyphicon-search"></i> <?php echo __('Search'); ?>
                            </button>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                    <hr>
                    <small>(*) Los criterios de búsqueda se realizan en base a: número , referencia o descripción.</small>
                </div>
            </div>
        </div>
    </div>
    <?php if(!empty($memos)): ?>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo __('Memos'); ?></h3>
                <div class="btn-group box-tools pull-right">
                    <button type="button" class="btn btn-linkedin"><i class="fa fa-file-excel-o"></i><?php echo __(' Excel')?></button>
                    <button type="button" class="btn btn-linkedin dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <?php foreach(range(date('Y'), 2018) as $year) :?>
                            <li>
                                <?php echo $this->Html->link('Periodo '.$year, array('action' => 'parts_office_excel', $year)); ?>
                            </li>    
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="Searchs" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center"><?php echo __('Number'); ?></th>
                            <th class="text-center" style="width:200px"><?php echo __('Oficina Partes'); ?></th>
                            <th class="text-center" style="width:200px"><?php echo __('Addressee'); ?></th>
                            <th class="text-center"><?php echo __('Reference'); ?></th>
                            <th class="text-center"><?php echo __('Nro. Externo'); ?></th>
                            <th class="text-center"><?php echo __('Nro. Interno'); ?></th>
                            <th class="text-center"><?php echo __('Memo Date'); ?></th>
                            <th class="text-center"><?php echo __('Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($memos as $memo): ?>
                        <tr>
                            <td class="text-center"><?php echo h('D'.$memo['Memo']['memo_number'].'-'.$memo['Memo']['year']); ?>&nbsp;</td>
                            <td class="text-center"><?php echo $this->requestAction('memos/find_owner/'.$memo['Memo']['id']); ?></td>
                            <td class="text-center">
                                <?php 
                                    echo $this->requestAction('memos/find_addressees/'.$memo['Memo']['id']);
                                ?>
                            </td>
                            <td class="text-center"><?php echo h($memo['Memo']['reference']); ?>&nbsp;</td>
                            <td class="text-center">
                                <?php 
                                        
                                    $externalOffice =  ($memo['Memo']['external_office']) ? : null;

                                    $internalOffice =  ($memo['Memo']['internal_office']) ? : null;

                                    echo $this->Form->input('external_office', array('class' => 'form-control office', 'label' => false, 'id' => $memo['Memo']['id'], 'value' => $externalOffice));
                                ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                    echo $this->Form->input('internal_office', array('class' => 'form-control office', 'label' => false, 'id' => $memo['Memo']['id'], 'value' => $internalOffice));
                                ?>
                            </td>
                            <td class="text-center">
                                <span style="display:none"><?php echo strtotime($memo['Memo']['created']); ?><br></span>
                                <?php echo date("d-m-Y H:i:s", strtotime($memo['Memo']['created'])); ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <?php 

                                        echo $this->Html->link(__('<i class="glyphicon glyphicon-time"></i> &nbsp; Time Line'), array('action' => 'time_line', $memo['Memo']['id'], true), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'línea de tiempo', 'target' => '_blank')); 

                                        echo $this->Form->button(__('<i class="glyphicon glyphicon-paperclip"></i> &nbsp; Adjuntar'), array('class' => 'btn btn-linkedin attach', 'escape' => false, 'title' => 'adjuntar', 'data-toggle' => 'modal',  'data-target' => '#myModalAttach', 'id' => $memo['Memo']['id'])); 
                                    ?>
                                </div>    
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive --
                </div><!-- /.index -->
        </div><!-- /#page-content .col-sm-9 -->
    </div><!-- /#page-container .row-fluid -->
    <?php elseif(is_null($memos)): ?>
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
            </div>
            <!-- /.table-responsive --
                </div><!-- /.index -->
        </div><!-- /#page-content .col-sm-9 -->
    </div><!-- /#page-container .row-fluid -->
    <?php endif; ?>
</div>

<div class="modal modal-primary" id="myModalAttach" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo __('Adjuntar'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="box-body table-responsive">
		
                <?php echo $this->Form->create('Attachment', array('url' => '/attachments/add_files', 'role' => 'form', 'type'=>'file')); ?>

                    <fieldset>
                        <div class="form-group">
                            <?php 
                            
                                echo $this->Form->hidden('Attachment.filename.attachment_type_id', array('class' => 'form-control', 'value' => '5b8588e3-f660-426b-8121-1f68c26b1ae0', 'type' => 'text'));
                            
                                echo $this->Form->hidden('Attachment.filename.memo_id', array('class' => 'form-control', 'type' => 'text'));
                                
                                echo $this->Form->input('filename', array('class' => 'form-control', 'type'=>'file', 'label' => __('Archivo'), 'accept' => 'application/pdf')); 
                            ?>
                        </div><!-- .form-group -->
                        <div class="form-group">
                            <?php echo $this->Form->input('Attachment.filename.description', array('class' => 'form-control', 'label' => __('Observación'), 'required' => true)); ?>
                        </div><!-- .form-group -->

                        <?php echo $this->Form->submit(__('Guardar'), array('class' => 'btn btn-large submit btn-outline pull-left')); ?>

                    </fieldset>

						<?php echo $this->Form->end(); ?>

		      </div><!-- /.form -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-option btn-outline pull-right" data-dismiss="modal"><?php echo __('Cerrar'); ?></button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
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

    $(".office").keyup(function() {
        var id = $(this).attr('id');
        var name = $(this).attr("name");
        var val = $(this).val();

        if (name == 'data[internal_office]') {
            external = 0;
        } else {
            external = 1;
        }

        $.ajax({
            type: 'POST',
            dataType: 'jsonp',
            url: '<?php echo $this->Html->webroot("memos/office_number/"); ?>' + id + '/' + external + '/' + val,
        });
    });

    $('.office').keyup(function(e) {
        if (/\D/g.test(this.value)) {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });
    
    $(".attach").click(function() {
        
        var id = $(this).attr('id');
        
        $("#AttachmentFilenameMemoId").val(id);
    });

</script>
