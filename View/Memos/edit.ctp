<?php
    echo $this->Html->css('../js/plugins/tag-it/jquery.tagit');
    echo $this->Html->css('../js/plugins/tag-it/tagit.ui-zendesk');
?>
<div class="row">
    <div class="col-xs-12">
		<div class="box box-primary">
            <?php echo $this->Form->create('Memo', array('role' => 'form', 'type'=>'file')); ?>
            <section class="invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                    <i class="glyphicon glyphicon-list-alt"></i> <?php echo __('Memorandum'); ?>
                    <?php echo $this->request->data['Memo']['memo_number'].'-'.date('Y', strtotime($this->request->data['Memo']['created'])); ?>
                  </h2>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <p class="lead"><?php echo __('From'); ?></p>
                  <address>
                    <?php echo $this->Form->hidden('memo_number', array('class' => 'form-control')); ?> 
                    <?php echo $this->Form->hidden('Data.from', array('class' => 'form-control text-muted well well-sm no-shadow', 'label' => false, 'value' => $this->Session->read('Auth.User.username'))); ?>
                      <h2><?php echo $this->requestAction('memos/find_user_username/'.$this->Session->read('Auth.User.username')); ?></h2>
                  </address>
                </div>
                <!-- /.col -->
                 <div class="col-sm-4 invoice-col">
                    <p class="lead"><?php echo __('Addressee'); ?></p>
                  <address>
                      <?php $tos = NULL; ?>
                      <?php foreach($memoAddressee as $tracking):?>
                              <?php $tos .= $tracking['MemoTracking']['to'].'@minmujeryeg.gob.cl,'; ?>
                      <?php endforeach; ?>
                      <?php echo $this->Form->input('Data.to', array('class' => 'form-control tag-it', 'label' => false, 'required' => true, 'value' => $tos)); ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <p class="lead"><?php echo __('Notify'); ?></p>
                  <address>
                      <?php $notify = NULL; ?>
                      <?php foreach($memoNotify as $tracking):?>
                                <?php $notify .= $tracking['MemoTracking']['to'].'@minmujeryeg.gob.cl,'; ?>
                      <?php endforeach; ?>
                      <?php echo $this->Form->input('Data.notify', array('class' => 'form-control tag-it', 'label' => false, 'value' => $notify)); ?>
                  </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
                
              <div class="row invoice-info">
                <!-- accepted payments column -->
                <div class="col-xs-4">
                  <p class="lead"><?php echo __('Matters'); ?></p>

                  <div class="form-group">
                      <?php echo $this->Form->input('matter_id', array('class' => 'form-control', 'label' => false, 'required' => true, 'empty' => true)); ?>
                      <?php echo $this->Form->input('matter_text', array('class' => 'form-control', 'label' => false, 'style' => 'display: none', 'type' => 'text')); ?>
                  </div><!-- .form-group -->    
                </div>
                <div class="col-sm-8 invoice-col">
                    <p class="lead"><?php echo __('Importance'); ?></p>

                    <?php echo $this->Form->input('importance', array('type'=>'checkbox', 'data-toggle' => 'toggle', 'data-on' => __('Important'), 'data-off' => __('Normal'), 'data-onstyle' => 'danger', 'label' => false)); ?>
                    
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->     
                
              <div class="row invoice-info">
                <!-- accepted payments column -->
                <div class="col-xs-4">
                  <p class="lead"><?php echo __('Memo Date'); ?></p>

                  <div class="form-group">
                      <?php echo $this->Form->text('memo_date', array('class' => 'form-control dateform', 'label' => false, 'readonly' => true, 'required' => true)); ?>
                  </div><!-- .form-group -->    
                </div>
              </div>
              <!-- /.row -->    
              
                <div class="row invoice-info">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                  <p class="lead"><?php echo __('Reference'); ?></p>

                  <div class="form-group">
                      <?php echo $this->Form->input('reference', array('class' => 'form-control', 'label' => false, 'required' => true)); ?>
                  </div><!-- .form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
                
              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12 table-responsive">

                    <div class="box-header">
                        <p class="lead"><?php echo __('Description'); ?></p>
                      <!-- tools box -->
                      <div class="pull-right box-tools">

                      </div>
                      <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        
                        <textarea name="data[Memo][description]" id="MemoDescription"  class="form-control" rows="10" required>
                            <?php echo $this->request->data['Memo']['description']; ?>
                        </textarea>
                        
                    </div>
                  </div>

                <!-- /.col -->
              </div>
              <!-- /.row -->
                
              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12 table-responsive">

                    <div class="box-header">
                        <p class="lead">
                            <?php echo __('Attachments'); ?>&nbsp;
                            <small class="label pull-center bg-yellow"><i class="icon fa fa-info"></i>&nbsp;<?php echo __('Only PDF files are allowed'); ?></small>
                        </p>
                    </div>
                    
                    <a><button type="button" class="btn btn-linkedin" id="btn-success"><i class="glyphicon glyphicon-plus"></i> <?php echo __('Add more files'); ?></button></a>
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                       <?php $numAttach = 0;?>
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo __('Name'); ?></th>
                                        <th class="text-center"><?php echo __('Description'); ?></th>
                                        <th class="text-center"><?php echo __('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody  id="addTable">
                                    <?php if(!empty($memo['Attachment'])): ?>
                                        <?php
                                            $i = 0;
                                            foreach ($memo['Attachment'] as $numAttach => $attachment): ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                            echo $this->Form->hidden('Attachment.'.$numAttach.'.filename.id', array('value' => $attachment['id']));
                                                            echo $this->Form->hidden('Attachment.'.$numAttach.'.filename.name', array('value' => $attachment['name']));
                                                            echo $this->Form->hidden('Attachment.'.$numAttach.'.filename.delete', array('value' => 'false'));
                                                            echo $attachment['name']; 
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            echo $this->Form->hidden('Attachment.'.$numAttach.'.filename.description', array('value' => $attachment['name']));
                                                            echo $attachment['description']; 
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a target="_blank" href="<?php echo $this->Html->url('/files/'.$attachment['id'].'/'.$attachment['name']); ?>"><button type="button" class="btn btn-linkedin" ><i class="glyphicon glyphicon-eye-open"></i>  <?php echo __('View'); ?></button></a>
                                                            <a><button type="button" class="btn btn-danger" id="btn-danger" name="<?php echo $numAttach; ?>"><i class="glyphicon glyphicon-trash"></i> <?php echo __('Delete file'); ?></button></a>
                                                        </div>    
                                                    </td>
                                                </tr>
                                       <?php endforeach; ?>
                                        <tr>
                                            <td><?php echo $this->Form->input('Attachment.'.++$numAttach.'.filename', array('class' => 'form-control', 'type'=>'file', 'label' => false, 'accept' => 'application/pdf')); ?></td>
                                            <td><?php echo $this->Form->text('Attachment.'.$numAttach.'.filename.description', array('class' => 'form-control')); ?></td>
                                            <td class="text-center"></td>
                                        </tr>
                                    <?php else: ?>
                                        <tr>
                                            <td><?php echo $this->Form->input('Attachment.'.$numAttach.'.filename', array('class' => 'form-control', 'type'=>'file', 'label' => false, 'accept' => 'application/pdf')); ?></td>
                                            <td><?php echo $this->Form->text('Attachment.'.$numAttach.'.filename.description', array('class' => 'form-control')); ?></td>
                                            <td class="text-center"></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table><!-- /.table table-striped table-bordered -->
                        </div><!-- /.table-responsive -->
                    </div>
                </div>
                <!-- /.col -->
              </div><br><br>
              <!-- /.row -->    

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                  <p class="lead"><?php echo __('Initial Responsibility');?></p>
                  <?php echo $this->Form->input('initial_responsibility', array('class' => 'form-control text-muted well well-sm no-shadow', 'label' => false, 'readonly' => true)); ?>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-xs-12 text-center">
                    <div class="btn-group">  
                        <?php if($shunt): ?>
                            <button type="submit" class="btn btn-linkedin ajax" name="shunt" id="shunt">
                                <i class="glyphicon glyphicon-floppy-disk"></i> <?php echo __('Save'); ?>
                            </button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-linkedin ajax" name="send" id="send">
                                <i class="glyphicon glyphicon-send"></i> <?php echo __('Submit'); ?>
                            </button>
                            <?php if(!empty($subrogances)): ?>
                                    <button type="button" class="btn btn-linkedin dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-users"></i> <?php echo __('Subrogance'); ?>&nbsp;
                                        <span class="caret"></span>
                                        <span class="sr-only"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <?php foreach($subrogances as $idSubrogance => $nameSubrogance): ?>
                                            <li>
                                                <button style="width:100%" type="submit" class="btn send-subrogance" name="send" id="send" value="<?php echo $idSubrogance; ?>">
                                                    <?php echo $nameSubrogance; ?>
                                                </button>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>                                
                                <?php endif; ?>
                        <?php endif; ?>
                        <?php if(empty($this->request->data['Memo']['memo_number'])) : ?>
                            <button type="submit" class="btn btn-linkedin ajax" name="send_without" id="send_without">
                                <i class="glyphicon glyphicon-floppy-disk"></i> <?php echo __('Save without sending'); ?>
                            </button>
                        <?php endif; ?>
                        <?php echo $this->Form->end(); ?>
                    </div>    
                </div>
              </div>
            </section>
		</div><!-- /.form -->		
	</div><!-- /#page-content .col-sm-9 -->
</div><!-- /#page-container .row-fluid -->
<div class="modal modal-primary" id="myModalFrame" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __('Close'); ?></button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>
<?php
    echo $this->Html->script('plugins/datepicker/bootstrap-datepicker.js');
    echo $this->Html->script('plugins/datepicker/locales/bootstrap-datepicker.es.js');

    echo $this->Html->script('plugins/tag-it/tag-it');
    echo $this->Html->script('plugins/tag-it/tag-it.min');
?>
<script>
    
    // Limitar Adjuntos
    
    $('input[type="file"]').on('change', function(){
        var ext = $( this ).val().split('.').pop();
        ext = ext.toLowerCase();
        if ($( this ).val() != '') {
          if(ext == "pdf"){}
          else{
              $('.modal-title').text('<?php echo __('Caution'); ?>');
              $('.modal-body').html("<?php echo __('This system only allows PDF files, please try again'); ?>");
              $("#myModalFrame").modal();    
              $( this ).val('');
          }
        }
    });
    
    // Validar submit
    
    $("#send_without").click(function(){        
        
        $(".btn-google").remove();
        
        $("#DataTo").attr('required', false);
        $("#MemoDescription").attr('required', false);
        
        
        $("#MemoMatterId").attr('required', true);
        $('#MemoMatterId').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $("#MemoReference").attr('required', true);
        $('#MemoReference').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
    });
    
    $("#send, #shunt").click(function(){
        
        $(".btn-google").remove();
        
        $("#DataTo").attr('required', true);
        $('#DataTo').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $("#MemoDescription").attr('required', true);
        $('#MemoDescription').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
        
        $("#MemoMatterId").attr('required', true);
        $('#MemoMatterId').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $("#MemoReference").attr('required', true);
        $('#MemoReference').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
    });
    
    $(".send-subrogance").click(function(){
        
        $(".btn-google").remove();
        
        $("#DataTo").attr('required', true);
        $('#DataTo').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
        
        $('#MemoDescription').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
        
        $("#MemoMatterId").attr('required', true);
        $('#MemoMatterId').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $("#MemoReference").attr('required', true);
        $('#MemoReference').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
    });
    
    // Checkbox
    
    $('.checkbox').on( "click", function() {
        var value = $("input[name*='importance']").val();
        if (value == 0) {
            $("input[name*='importance']").val(1);
        } else {
            $("input[name*='importance']").val(0);
        }
    });
    
    // Editor
    
    $(function () {   

        editor = CKEDITOR.replace('MemoDescription')
        editor.addCommand("mySimpleCommand", {
            exec: function(edt) {
                editor.setData('');
            }
        });
        editor.ui.addButton('DeleteButton', {
            command: 'mySimpleCommand',
            toolbar: 'delete',
            label: 'Eliminar Contenido',
        });

    });

  $('.tag-it').tagit({
      singleField: true,
      autocomplete : {
          minLength: 3,
          source : '<?php echo $this->Html->webroot("users/find_user_fullname?memo=true"); ?>',
      }
  });
    
  $('body').on('keypress keyup blur focus', '.dateform', function(e){
      $(this).datepicker({ language: 'es', format: 'yyyy-mm-dd', weekStart:'1' });
  });
  
  var rowCount = <?php echo ++$numAttach; ?>;    
  
  $(function () {
    $(document).on('click', '#btn-success', function (event) {
        event.preventDefault();
        
        $('<tr id="trNew_' + rowCount +'">' + '</tr>').appendTo('#addTable');

        $('<td class="text-center"><input name="data[Attachment][' + rowCount + '][filename]" class="form-control" type="file" accept="application/pdf"></td>').appendTo('#trNew_' + rowCount);

        $('<td class="text-center"><input name="data[Attachment][' + rowCount + '][filename][description]" class="form-control" type="text"></td>').appendTo('#trNew_' + rowCount);
    
        $('<td class="text-center"></td>').appendTo('#trNew_' + rowCount);
      
        rowCount++;
    });
  });    
    
  $(function () {
    $(document).on('click', '#btn-danger', function (event) {
        event.preventDefault();
        $(this).closest('tr').hide();
        $('#Attachment'+ $(this).prop('name') +'FilenameDelete').val('true');
    });
  });
    
  $('#MemoEditForm').submit(function() {
      $('#loader').modal({
        show: 'true'
    });        
  });
    
  $(document).ready(function(){
      $("#MemoMatterId").change(function(){
          var matterId = $(this). children("option:selected"). val();
          if(matterId == '5bfff4ce-6954-416b-a357-2048c26b1ae0'){
              $('#MemoMatterText').show();
              $('#MemoMatterId').hide();
              $("#MemoMatterText").attr('required', true);
              $('#MemoMatterText').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
          }
      });
      
      $("input[name*='importance']").val(<?php echo $memo['Memo']['importance']; ?>);
      
  });     

</script>