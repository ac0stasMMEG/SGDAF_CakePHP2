
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Milestone'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $milestone['Milestone']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="Milestones" class="table table-bordered table-striped">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($milestone['Milestone']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Name'); ?></strong></td>
		<td>
			<?php echo h($milestone['Milestone']['name']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Percentage'); ?></strong></td>
		<td>
			<?php echo h($milestone['Milestone']['percentage']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($milestone['Milestone']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($milestone['Milestone']['modified']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

					
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?php echo __('Related Requirement Trackings'); ?></h3>
					<div class="box-tools pull-right">
						<?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> '.__('New Requirement Tracking'), array('controller' => 'requirement_trackings', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>					</div><!-- /.actions -->
				</div>
				<?php if (!empty($milestone['RequirementTracking'])): ?>
					
					<div class="box-body table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
											<th class="text-center"><?php echo __('Id'); ?></th>
		<th class="text-center"><?php echo __('Requirement Id'); ?></th>
		<th class="text-center"><?php echo __('Requirement Tracking Type Id'); ?></th>
		<th class="text-center"><?php echo __('Milestone Id'); ?></th>
		<th class="text-center"><?php echo __('To'); ?></th>
		<th class="text-center"><?php echo __('Creared'); ?></th>
		<th class="text-center"><?php echo __('Modified'); ?></th>
									<th class="text-center"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
									<?php
										$i = 0;
										foreach ($milestone['RequirementTracking'] as $requirementTracking): ?>
		<tr>
			<td class="text-center"><?php echo $requirementTracking['id']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['requirement_id']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['requirement_tracking_type_id']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['milestone_id']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['to']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['creared']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['modified']; ?></td>
			<td class="text-center">
				<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('controller' => 'requirement_trackings', 'action' => 'view', $requirementTracking['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
				<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('controller' => 'requirement_trackings', 'action' => 'edit', $requirementTracking['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
				<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('controller' => 'requirement_trackings', 'action' => 'delete', $requirementTracking['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $requirementTracking['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
							</tbody>
						</table><!-- /.table table-striped table-bordered -->
					</div><!-- /.table-responsive -->
					
				<?php endif; ?>

				
				
			</div><!-- /.related -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->

