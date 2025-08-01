<?php
echo $this->Html->css('../js/plugins/tag-it/jquery.tagit');
echo $this->Html->css('../js/plugins/tag-it/tagit.ui-zendesk');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h2 class="page-header">
                    <i class="glyphicon glyphicon-list-alt"></i> <?php echo __('Memorandum'); ?>
                    <div class="box-tools pull-right">
                        <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-chevron-left"></i> Back'), $this->request->referer(), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle' => 'tooltip', 'type' => 'button')); ?>
                    </div>
                </h2>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4 invoice-col">
                        <p class="lead"><?php echo __('From'); ?></p>
                        <address>
                            <?php echo $this->Form->create('Memo', array('role' => 'form', 'type' => 'file')); ?><!-- //, 'novalidate'=>true -->
                            <?php echo $this->Form->hidden('memo_type_id', array('class' => 'form-control', 'default' => '5b840e91-8774-48d8-8e6f-1f68c26b1ae0')); ?>
                            <?php echo $this->Form->hidden('memo_number', array('class' => 'form-control')); ?>
                            <?php echo ($parentMemoId) ? $this->Form->hidden('parent_id', array('class' => 'form-control', 'value' => $parentMemoId)) : NULL; ?>
                            <?php echo $this->Form->hidden('Data.from', array('class' => 'form-control text-muted well well-sm no-shadow', 'label' => false, 'value' => $this->Session->read('Auth.User.username'))); ?>
                            <h2><?php echo $this->requestAction('memos/find_user_username/' . $this->Session->read('Auth.User.username')); ?></h2>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <p class="lead"><?php echo __('Addressee'); ?></p>
                        <address>
                            <?php
                            $tos = NULL;
                            $memoAddressee = $this->Session->read('DataMemo.Data.to');
                            ?>
                            <?php
                            if (!empty($memoAddressee)) :
                                $memoAddressee = explode(',',  $memoAddressee);
                                foreach ($memoAddressee as $tracking) :
                                    $tracking = explode('@',  $tracking);
                                    $tos .= $tracking[0] . '@minmujeryeg.gob.cl,';
                                endforeach;
                            endif;
                            ?>
                            <?php echo $this->Form->input('Data.to', array('class' => 'form-control tag-it-one', 'label' => false, 'value' => $tos)); ?>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <p class="lead"><?php echo __('Notify'); ?></p>
                        <address>
                            <?php
                            $notify = NULL;
                            $memoNotify = $this->Session->read('DataMemo.Data.notify');
                            ?>
                            <?php
                            if (!empty($memoNotify)) :
                                $memoNotify = explode(',',  $memoNotify);
                                foreach ($memoNotify as $tracking) :
                                    $tracking = explode('@',  $tracking);
                                    $notify .= $tracking[0] . '@minmujeryeg.gob.cl,';
                                endforeach;
                            endif;
                            ?>
                            <?php echo $this->Form->input('Data.notify', array('class' => 'form-control tag-it', 'label' => false, 'value' => $notify)); ?>
                        </address>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <?php
                    $sessionMemoDate = $this->Session->read('DataMemo.Memo.memo_date');
                    $sessionMemoReference = $this->Session->read('DataMemo.Memo.reference');
                    $sessionMemoDescription = $this->Session->read('DataMemo.Memo.description');
                    $sessionMemoMatterId = $this->Session->read('DataMemo.Memo.matter_id');
                    ?>
                    <!-- accepted payments column -->
                    <div class="col-sm-4 invoice-col">
                        <p class="lead"><?php echo __('Matters'); ?></p>

                        <div class="form-group">
                            <?php echo $this->Form->input('matter_id', array('class' => 'form-control', 'label' => false, 'empty' => true, 'default' => ($parentMatterId) ?: $sessionMemoMatterId)); ?>
                            <?php echo $this->Form->input('matter_text', array('class' => 'form-control', 'label' => false, 'style' => 'display: none', 'type' => 'text')); ?>
                        </div><!-- .form-group -->

                    </div>
                    <div class="col-sm-4 invoice-col">
                        <p class="lead"><?php echo __('Importance'); ?></p>

                        <?php echo $this->Form->input('importance', array(
                            'type' => 'checkbox', 'data-toggle' => 'toggle', 'data-on' => __('Important'), 'data-off' => __('Normal'), 'data-onstyle' => 'danger', 'label' => false
                        )); ?>

                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <p class="lead"><?php echo __('Gestionar'); ?></p>

                        <?php echo $this->Form->input('requirements', array(
                            'type' => 'checkbox', 'data-toggle' => 'toggle', 'data-on' => __('Si'), 'data-off' => __('No'), 'data-onstyle' => 'success', 'label' => false
                        )); ?>

                    </div>
                </div>
                <div class="row">

                    <!-- accepted payments column -->
                    <div class="col-sm-4 invoice-col">
                        <p class="lead"><?php echo __('Memo Date'); ?></p>

                        <div class="form-group">
                            <?php echo $this->Form->text('memo_date', array('class' => 'form-control dateform', 'label' => false, 'readonly' => true, 'value' => ($sessionMemoDate) ?: date('Y-m-d'))); ?>
                        </div><!-- .form-group -->

                    </div>
                    <!-- /.col -->

                    <!-- accepted payments column -->
                    <div class="col-sm-12 invoice-col">
                        <p class="lead"><?php echo __('Reference'); ?></p>

                        <div class="form-group">
                            <?php echo $this->Form->input('reference', array('class' => 'form-control', 'label' => false, 'value' => ($parentReference) ?: $sessionMemoReference)); ?>
                        </div><!-- .form-group -->
                    </div>
                    <!-- /.col -->

                    <div class="col-sm-12 invoice-col">

                        <p class="lead"><?php echo __('Description'); ?></p>
                        <div class="box-body pad">
                            <textarea name="data[Memo][description]" id="MemoDescription" class="form-control" rows="10"><?php echo ($parentDescription) ?: $sessionMemoDescription; ?></textarea>
                        </div>
                    </div>
                    <!-- /.col -->


                    <div class="col-sm-12 invoice-col table-responsive">

                        <div class="box-header">
                            <p class="lead">
                                <?php echo __('Attachments'); ?>&nbsp;
                                <small class="label pull-center bg-yellow"><i class="icon fa fa-info"></i>&nbsp;<?php echo __('Only PDF files are allowed'); ?></small>
                            </p>
                            <!-- tools box -->
                            <small class="pull-right"></small>
                        </div>

                        <a><button type="button" class="btn btn-linkedin" id="btn-success"><i class="glyphicon glyphicon-plus"></i> <?php echo __('Add more files'); ?></button></a>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-striped" id="addTable">
                                <th><?php echo __('File Name'); ?></th>
                                <th><?php echo __('Description'); ?></th>
                                <th><?php echo __('Actions'); ?></th>
                                <tbody>
                                    <tr>
                                        <td><?php echo $this->Form->input('Attachment.0.filename', array('class' => 'form-control', 'type' => 'file', 'label' => false, 'accept' => 'application/pdf')); ?></td>
                                        <td><?php echo $this->Form->text('Attachment.0.filename.description', array('class' => 'form-control')); ?></td>
                                        <td></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <td><?php echo $this->Form->input('Attachment.1.filename', array('class' => 'form-control', 'type' => 'file', 'label' => false, 'accept' => 'application/pdf')); ?></td>
                                        <td><?php echo $this->Form->text('Attachment.1.filename.description', array('class' => 'form-control')); ?></td>
                                        <td><a><button type="button" class="btn btn-danger btn-flat" id="btn-danger"><i class="glyphicon glyphicon-trash"></i> <?php echo __('Delete file'); ?></button></a></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <td><?php echo $this->Form->input('Attachment.2.filename', array('class' => 'form-control', 'type' => 'file', 'label' => false, 'accept' => 'application/pdf')); ?></td>
                                        <td><?php echo $this->Form->text('Attachment.2.filename.description', array('class' => 'form-control')); ?></td>
                                        <td><a><button type="button" class="btn btn-danger btn-flat" id="btn-danger"><i class="glyphicon glyphicon-trash"></i> <?php echo __('Delete file'); ?></button></a></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <td><?php echo $this->Form->input('Attachment.3.filename', array('class' => 'form-control', 'type' => 'file', 'label' => false, 'accept' => 'application/pdf')); ?></td>
                                        <td><?php echo $this->Form->text('Attachment.3.filename.description', array('class' => 'form-control')); ?></td>
                                        <td><a><button type="button" class="btn btn-danger btn-flat" id="btn-danger"><i class="glyphicon glyphicon-trash"></i> <?php echo __('Delete file'); ?></button></a></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <td><?php echo $this->Form->input('Attachment.4.filename', array('class' => 'form-control', 'type' => 'file', 'label' => false, 'accept' => 'application/pdf')); ?></td>
                                        <td><?php echo $this->Form->text('Attachment.4.filename.description', array('class' => 'form-control')); ?></td>
                                        <td><a><button type="button" class="btn btn-danger btn-flat" id="btn-danger"><i class="glyphicon glyphicon-trash"></i> <?php echo __('Delete file'); ?></button></a></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <td><?php echo $this->Form->input('Attachment.5.filename', array('class' => 'form-control', 'type' => 'file', 'label' => false, 'accept' => 'application/pdf')); ?></td>
                                        <td><?php echo $this->Form->text('Attachment.5.filename.description', array('class' => 'form-control')); ?></td>
                                        <td><a><button type="button" class="btn btn-danger btn-flat" id="btn-danger"><i class="glyphicon glyphicon-trash"></i> <?php echo __('Delete file'); ?></button></a></td>
                                    </tr>
                                    <?php if (!empty($allAttachMemos)) : ?>
                                        <?php
                                        $i = 0;
                                        foreach ($allAttachMemos as $count => $attachment) : ?>
                                            <tr>
                                                <td><?php echo $attachment['Attachment']['name']; ?></td>
                                                <td><?php echo $attachment['Attachment']['description']; ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <?php
                                                        echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>&nbsp;' . __('View'), '/files/' . $attachment['Attachment']['id'] . '/' . $attachment['Attachment']['name'], array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle' => 'tooltip', 'target' => '_blank', 'type' => 'button'));
                                                        ?>
                                                        <a><button type="button" class="btn btn-danger btn-flat disableAttach" id="<?php echo $attachment['Attachment']['id']; ?>"><i class="glyphicon glyphicon-trash"></i> <?php echo __('Delete file'); ?></button></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div><br><br>
                    <!-- /.row -->
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead"><?php echo __('Initial Responsibility'); ?></p>
                        <?php echo $this->Form->input('initial_responsibility', array('class' => 'form-control text-muted well well-sm no-shadow', 'label' => false, 'value' => $initialResponsibility, 'readonly' => true)); ?>
                    </div><br>
                    <!-- /.col -->
                    <div class="col-xs-12 text-center">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-linkedin" name="send" id="send">
                                <i class="glyphicon glyphicon-send"></i> <?php echo __('Submit'); ?>
                            </button>
                            <?php if (!empty($subrogances)) : ?>
                                <button type="button" class="btn btn-linkedin dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-users"></i> <?php echo __('Subrogance'); ?>&nbsp;
                                    <span class="caret"></span>
                                    <span class="sr-only"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <?php foreach ($subrogances as $idSubrogance => $nameSubrogance) : ?>
                                        <li>
                                            <button style="width:100%" type="submit" class="btn send-subrogance" name="send" id="send" value="<?php echo $idSubrogance; ?>">
                                                <?php echo $nameSubrogance; ?>
                                            </button>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-linkedin ajax send_without">
                                <i class="glyphicon glyphicon-floppy-disk"></i> <?php echo __('Save without sending'); ?>
                            </button>
                            <?php //echo $this->Form->end(); 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"><br><br><br><br></div>
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

    $('input[type="file"]').on('change', function() {
        var ext = $(this).val().split('.').pop();
        ext = ext.toLowerCase();
        if ($(this).val() != '') {
            if (ext == "pdf") {} else {
                $('.modal-title').text('<?php echo __('Caution'); ?>');
                $('.modal-body').html("<?php echo __('This system only allows PDF files, please try again'); ?>");
                $("#myModalFrame").modal();
                $(this).val('');
            }
        }
    });

    // Checkbox
    $('.checkbox').on("click", function() {

        var value = $("input[name*='importance']").val();
        var value2 = $("input[name*='importance']").val();

        if (value == 0) {
            $("input[name*='importance']").val(1);
        } else {
            $("input[name*='importance']").val(0);
        }

        if (value2 == 0) {
            $("input[name*='requirements']").val(1);
        } else {
            $("input[name*='requirements']").val(0);
        }
    });

    // Validación formulario

    $('.ajax').click(function() {

        $(".btn-google").remove();

        $("#DataTo").attr('required', false);

        $("#MemoMatterId").attr('required', true);
        $('#MemoMatterId').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $("#MemoReference").attr('required', true);
        $('#MemoReference').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
    });

    $("#send").click(function() {

        $(".btn-google").remove();

        $("#DataTo").attr('required', true);
        $('#DataTo').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $('#MemoDescription').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $("#MemoMatterId").attr('required', true);
        $('#MemoMatterId').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $("#MemoReference").attr('required', true);
        $('#MemoReference').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
    });

    $(".send-subrogance").click(function() {

        $(".btn-google").remove();

        $("#DataTo").attr('required', true);
        $('#DataTo').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $('#MemoDescription').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $("#MemoMatterId").attr('required', true);
        $('#MemoMatterId').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');

        $("#MemoReference").attr('required', true);
        $('#MemoReference').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
    });

    // Editor

    $(function() {
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

    // Tag-it

    $('.tag-it-one').tagit({
        singleField: true,
        tagLimit: 1,
        autocomplete: {
            minLength: 3,
            source: '<?php echo $this->Html->webroot("users/find_user_fullname?memo=true"); ?>',
        }
    });

    $('.tag-it').tagit({
        singleField: true,
        autocomplete: {
            minLength: 3,
            source: '<?php echo $this->Html->webroot("users/find_user_fullname?memo=true"); ?>',
        }
    });

    // Fecha

    $('body').on('keypress keyup blur focus', '.dateform', function(e) {
        $(this).datepicker({
            language: 'es',
            format: 'yyyy-mm-dd',
            weekStart: '1'
        });
    });

    // Adjuntos

    var rowCount = 1;

    $(function() {
        $(document).on('click', '#btn-success', function(event) {
            event.preventDefault();
            if (rowCount < 6) {
                rowCount++;
                $("#addTable").find("tr:eq(" + rowCount + ")").show();
            }
        });
    });

    $(function() {
        $(document).on('click', '#btn-danger', function(event) {
            event.preventDefault();
            $("#addTable").find("tr:eq(" + rowCount + ")").hide();
            rowCount--;
        });
    });

    $('#MemoAddForm').submit(function() {
        $('#loader').modal({
            show: 'true'
        });
    });

    $(document).ready(function() {
        $("#MemoMatterId").change(function() {
            var matterId = $(this).children("option:selected").val();
            if (matterId == '5bfff4ce-6954-416b-a357-2048c26b1ae0') {
                $('#MemoMatterText').show();
                $('#MemoMatterId').hide();
                $("#MemoMatterText").attr('required', true);
                $('#MemoMatterText').before('<a class="btn btn-block btn-social btn-google"><i class="fa fa-pencil-square-o"></i><?php echo __(' This field is required'); ?></a>');
            }
        })
    });

    $(".disableAttach").click(function() {
        var id = $(this).attr('id');

        $.ajax({
            type: 'POST',
            dataType: 'jsonp',
            url: '<?php echo $this->Html->webroot("memos/disable_attach/"); ?>' + id,
        });

        $(this).parents('tr').hide()
    });

    /*
    $(document).ready(function () {
        $("#mytags").tagit({
            singleField: true,
            singleFieldNode: $('#mySingleField'),
            allowSpaces: true,
            minLength: 2,
            removeConfirmation: true,
            tagSource: function (request, response) {
                //console.log("1");
                $.ajax({
                    url: "../City/GetList",
                    data: { term: request.term },
                    dataType: "json",
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.label + " (" + item.id + ")",
                                value: item.value
                            }
                        }));
                    }
                });
            }
        });
    });    
    */
</script>