<?php echo $this->Html->addCrumb(__('Index users'), 'index'); ?>

<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
			<h3 class="box-title"><?php echo __('Edit User'); ?></h3>
			</div>
			<div class="box-body table-responsive">
		
			<?php echo $this->Form->create('User', array('role' => 'form')); ?>

				<fieldset>

					<div class="form-group">
						<?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('username', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
                    <div class="form-group">
						<?php echo $this->Form->hidden('password', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('group_id', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
                    <div class="form-group">
						<?php echo $this->Form->input('email', array('class' => 'form-control', 'options' => $active, 'default' => 1, 'required' => true, 'label' => __('Do you want to receive alerts?'))); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('merge', array('class' => 'form-control', 'options' => $active, 'required' => true, 'label' => __('Unir memorándum'))); ?>
					</div><!-- .form-group -->
                    <div class="form-group">
						<?php echo $this->Form->input('attach', array('class' => 'form-control', 'options' => $active, 'required' => true, 'label' => __('Ver todos los adjuntos'))); ?>
					</div><!-- .form-group -->

					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary')); ?>

				</fieldset>

						<?php echo $this->Form->end(); ?>

		</div><!-- /.form -->
			
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->