<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo __('Observation'); ?></h4>
      </div>
<div class="box-body table-responsive">

    <?php echo $this->Form->create('MemoTracking', array('role' => 'form')); ?>

        <fieldset>
            
            <div class="form-group">
                <?php echo $this->Form->input('observation', array('class' => 'form-control select2', 'label' => false, 'required' => true)); ?>
            </div><!-- .form-group -->

            <button type="submit" class="btn btn-linkedin ajax">
                <i class="glyphicon glyphicon-send"></i> <?php echo __('Submit'); ?>
            </button>

        </fieldset>

        <?php echo $this->Form->end(); ?>
    
</div><!-- /.form -->
