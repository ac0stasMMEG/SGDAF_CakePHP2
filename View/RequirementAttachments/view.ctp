
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Requirement Attachment'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $requirementAttachment['RequirementAttachment']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="RequirementAttachments" class="table table-bordered table-striped">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachment['RequirementAttachment']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Requiremet Attachment Type'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($requirementAttachment['RequiremetAttachmentType']['name'], array('controller' => 'requiremet_attachment_types', 'action' => 'view', $requirementAttachment['RequiremetAttachmentType']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Name'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachment['RequirementAttachment']['name']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Description'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachment['RequirementAttachment']['description']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Type'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachment['RequirementAttachment']['type']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Data'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachment['RequirementAttachment']['data']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Size'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachment['RequirementAttachment']['size']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Disable'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachment['RequirementAttachment']['disable']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachment['RequirementAttachment']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachment['RequirementAttachment']['modified']); ?>
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
				<?php if (!empty($requirementAttachment['RequirementTracking'])): ?>
					
					<div class="box-body table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
											<th class="text-center"><?php echo __('Id'); ?></th>
		<th class="text-center"><?php echo __('Requirement Id'); ?></th>
		<th class="text-center"><?php echo __('Requirement Tracking Type Id'); ?></th>
		<th class="text-center"><?php echo __('Milestone Id'); ?></th>
		<th class="text-center"><?php echo __('Requirement Attachment Id'); ?></th>
		<th class="text-center"><?php echo __('To'); ?></th>
		<th class="text-center"><?php echo __('Memo Number'); ?></th>
		<th class="text-center"><?php echo __('Description'); ?></th>
		<th class="text-center"><?php echo __('Created'); ?></th>
		<th class="text-center"><?php echo __('Modified'); ?></th>
									<th class="text-center"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
									<?php
										$i = 0;
										foreach ($requirementAttachment['RequirementTracking'] as $requirementTracking): ?>
		<tr>
			<td class="text-center"><?php echo $requirementTracking['id']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['requirement_id']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['requirement_tracking_type_id']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['milestone_id']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['requirement_attachment_id']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['to']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['memo_number']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['description']; ?></td>
			<td class="text-center"><?php echo $requirementTracking['created']; ?></td>
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

