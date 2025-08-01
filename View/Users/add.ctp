<?php echo $this->Html->addCrumb(__('Index users'), 'index'); ?>
<?php
    echo $this->Html->css('../js/plugins/tag-it/jquery.tagit');
    echo $this->Html->css('../js/plugins/tag-it/tagit.ui-zendesk');
?>

<div class="row">
    <div class="col-md-3 col-xs-offset-1">
		<div class="box box-success">
			<div class="box-header">
                <h3 class="box-title"><?php echo __('Find User'); ?></h3>
			</div>
			<div class="box-body table-responsive">

				<fieldset>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i><?php echo __('Info'); ?></h4>
                        <?php echo __("write the user's name and then select it"); ?>
                    </div>
                    <div class="form-group">
						<?php echo $this->Form->input('full_name', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->

				</fieldset>

		</div><!-- /.form -->
			
	    </div><!-- /#page-content .col-sm-9 -->
    </div>
    <div class="col-md-6 col-xs-offset-1">
		<div class="box box-primary">
			<div class="box-header">
                <h3 class="box-title"><?php echo __('Add User'); ?></h3>
			</div>
			<div class="box-body table-responsive">
		
			<?php echo $this->Form->create('User', array('role' => 'form')); ?>

				<fieldset>

					<div class="form-group">
						<?php echo $this->Form->input('username', array('class' => 'form-control', 'readonly' => true)); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->hidden('password', array('class' => 'form-control', 'value' => 'mmeg.2019')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('group_id', array('class' => 'form-control', 'options' => $groups, 'empty' => true, 'required' => true)); ?>
					</div><!-- .form-group -->
                    <div class="form-group">
						<?php echo $this->Form->input('email', array('class' => 'form-control', 'options' => $active, 'default' => 1, 'required' => true, 'label' => __('Do you want to receive alerts?'))); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('merge', array('class' => 'form-control', 'options' => $active, 'required' => true, 'label' => __('Unir memorándum'))); ?>
					</div><!-- .form-group -->
                    <div class="form-group">
						<?php echo $this->Form->input('attach', array('class' => 'form-control', 'options' => $active, 'default' => 0, 'required' => true, 'label' => __('Ver todos los adjuntos'))); ?>
					</div><!-- .form-group -->

					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary')); ?>

				</fieldset>

						<?php echo $this->Form->end(); ?>

		    </div><!-- /.form -->			
	    </div><!-- /#page-content .col-sm-9 -->
    </div>    
</div><!-- /#page-container .row-fluid -->
<?php
    echo $this->Html->script('plugins/tag-it/tag-it');
    echo $this->Html->script('plugins/tag-it/tag-it.min');
?>
<script>
    
    $('#full_name').tagit({
        tagLimit: 1,
        singleField: true,
        required: false,
        autocomplete : {
                minLength: 3,
                source : '<?php echo $this->Html->webroot("users/find_user_fullname?memo=false"); ?>',
                select:function(evt, ui) {
                    $('#UserUsername').val(ui.item.userName);  
            }
        }
    });


</script>