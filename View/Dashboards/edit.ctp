<?php echo $this->Html->addCrumb(__('List dashboards'), 'index'); ?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
		<div class="box box-primary">
			<div class="box-header">
			<h3 class="box-title"><?php echo __('Edit Dashboard'); ?></h3>
			</div>
			<div class="box-body table-responsive">
		
			<?php echo $this->Form->create('Dashboard', array('role' => 'form')); ?>

				<fieldset>

					<div class="form-group">
						<?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('group_id', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('name', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
                    <div class="form-group">
						<?php echo $this->Form->input('link', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('position', array('class' => 'form-control')); ?>
					</div><!-- .form-group -->
					<div class="form-group">
						<?php echo $this->Form->input('icon', array('class' => 'form-control', 'data-toggle' => 'modal', 'data-target' => '#myModal', 'readonly' => 'readonly')); ?>
					</div><!-- .form-group -->
                    <div class="form-group">
						<?php echo $this->Form->input('color', array('class' => 'form-control', 'options' => $colors)); ?>
					</div><!-- .form-group -->

					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary')); ?>
                    <?php echo $this->element('icons'); ?>
				</fieldset>

						<?php echo $this->Form->end(); ?>

		</div><!-- /.form -->
			
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
<script>
    $(document).ready(function () { 
        $('.col-md-3').click(function() {
          
            var fa = $(this).find('i:first').attr('class');
            
            $('#DashboardIcon').val(fa);    
            
            $('#myModal').modal('toggle');
        });
    });
</script>