<?php echo $this->Html->css('../js/plugins/select2/select2.min.css'); ?>

<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo __('Shunt'); ?></h4>
      </div>
<div class="box-body table-responsive">

    <?php echo $this->Form->create('Data', array('role' => 'form')); ?>

        <fieldset>
            
            <div class="form-group">
                <?php echo $this->Form->input('users', array('class' => 'form-control select2', 'multiple' => 'multiple', 'label' => false, 'required' => true, 'options' => $listUsers)); ?>
            </div><!-- .form-group -->
            
            <div class="form-group">
                <?php echo $this->Form->input('observation', array('class' => 'form-control', 'label' => false, 'required' => true, 'type' => 'textarea')); ?>
            </div><!-- .form-group -->

            <button type="submit" class="btn btn-linkedin ajax">
                <i class="glyphicon glyphicon-send"></i> <?php echo __('Submit'); ?>
            </button>

        </fieldset>

        <?php echo $this->Form->end(); ?>
    
</div><!-- /.form -->

<?php echo $this->Html->script('plugins/select2/select2.full.min.js'); ?>

<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
    });
</script>  