<?php
   echo $this->Html->css('../js/plugins/tag-it/jquery.tagit');
   echo $this->Html->css('../js/plugins/tag-it/tagit.ui-zendesk');
?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
			<h3 class="box-title"><?php echo __('Add Subrogance'); ?></h3>
			</div>
			<div class="box-body table-responsive">
		
			<?php echo $this->Form->create('Subrogance', array('role' => 'form', 'type'=>'file')); ?>

				<fieldset>

				    <div class="form-group">
                        <?php echo $this->Form->input('user', array('class' => 'form-control')); ?>
						<?php echo $this->Form->hidden('to', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('foot_signature', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
                    <div class="form-group">
                        <?php echo $this->Form->input('filename', array('before' => __('<b>Timbre</b>'),'class' => 'form-control', 'type'=>'file', 'label' => false, 'accept' => 'image/png', 'after' => __('Recuerde que su archivo debe tenerla extension ".png" y utilizar el nombre con el siguiente formato (Ej: nombreusuario_unidad.png)'))); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->

					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary')); ?>

				</fieldset>

						<?php echo $this->Form->end(); ?>

		</div><!-- /.form -->
			
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
<?php
    echo $this->Html->script('plugins/tag-it/tag-it');
    echo $this->Html->script('plugins/tag-it/tag-it.min');
?>
<script>
    
    $('#SubroganceUser').tagit({
        tagLimit: 1,
        singleField: true,
        required: false,
        autocomplete : {
                minLength: 3,
                source : '<?php echo $this->Html->webroot("users/find_user_fullname?memo=false"); ?>',
                select:function(evt, ui) {
                    $('#SubroganceTo').val(ui.item.userName);  
            }
        }
    });


</script>