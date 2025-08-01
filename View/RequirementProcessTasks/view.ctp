
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Requirement Process Task'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $requirementProcessTask['RequirementProcessTask']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="RequirementProcessTasks" class="table table-bordered table-striped">
					<tbody>
						<tr>		<!-- <td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($requirementProcessTask['RequirementProcessTask']['id']); ?>
			&nbsp;
		</td> -->
</tr><tr>		<td><strong><?php echo __('Requirement Process'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($requirementProcessTask['RequirementProcess']['name'], array('controller' => 'requirement_processes', 'action' => 'view', $requirementProcessTask['RequirementProcess']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<!-- <td><strong><?php echo __('Requirement Process Area Id'); ?></strong></td>
		<td>
			<?php echo h($requirementProcessTask['RequirementProcessTask']['requirement_process_area_id']); ?>
			&nbsp;
		</td> -->
</tr><tr>		<td><strong><?php echo __('Order Task'); ?></strong></td>
		<td>
			<?php echo h($requirementProcessTask['RequirementProcessTask']['order_task']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Name'); ?></strong></td>
		<td>
			<?php echo h($requirementProcessTask['RequirementProcessTask']['name']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Description'); ?></strong></td>
		<td>
			<?php echo h($requirementProcessTask['RequirementProcessTask']['description']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Deadline'); ?></strong></td>
		<td>
			<?php echo h($requirementProcessTask['RequirementProcessTask']['task_deadline']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($requirementProcessTask['RequirementProcessTask']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($requirementProcessTask['RequirementProcessTask']['modified']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->

