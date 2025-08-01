
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Requirement Tracking'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $requirementTracking['RequirementTracking']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="RequirementTrackings" class="table table-bordered table-striped">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($requirementTracking['RequirementTracking']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Requirement'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($requirementTracking['Requirement']['name'], array('controller' => 'requirements', 'action' => 'view', $requirementTracking['Requirement']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Requirement Tracking Type'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($requirementTracking['RequirementTrackingType']['name'], array('controller' => 'requirement_tracking_types', 'action' => 'view', $requirementTracking['RequirementTrackingType']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Milestone'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($requirementTracking['Milestone']['name'], array('controller' => 'milestones', 'action' => 'view', $requirementTracking['Milestone']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('To'); ?></strong></td>
		<td>
			<?php echo h($requirementTracking['RequirementTracking']['to']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Creared'); ?></strong></td>
		<td>
			<?php echo h($requirementTracking['RequirementTracking']['creared']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($requirementTracking['RequirementTracking']['modified']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->

