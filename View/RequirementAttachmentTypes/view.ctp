
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Requirement Attachment Type'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $requirementAttachmentType['RequirementAttachmentType']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="RequirementAttachmentTypes" class="table table-bordered table-striped">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachmentType['RequirementAttachmentType']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Name'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachmentType['RequirementAttachmentType']['name']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachmentType['RequirementAttachmentType']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($requirementAttachmentType['RequirementAttachmentType']['modified']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

					
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?php echo __('Related Requirement Attachments'); ?></h3>
					<div class="box-tools pull-right">
						<?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> '.__('New Requirement Attachment'), array('controller' => 'requirement_attachments', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>					</div><!-- /.actions -->
				</div>
				<?php if (!empty($requirementAttachmentType['RequirementAttachment'])): ?>
					
					<div class="box-body table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
											<th class="text-center"><?php echo __('Id'); ?></th>
		<th class="text-center"><?php echo __('Requirement Attachment Type Id'); ?></th>
		<th class="text-center"><?php echo __('Name'); ?></th>
		<th class="text-center"><?php echo __('Description'); ?></th>
		<th class="text-center"><?php echo __('Type'); ?></th>
		<th class="text-center"><?php echo __('Data'); ?></th>
		<th class="text-center"><?php echo __('Size'); ?></th>
		<th class="text-center"><?php echo __('Disable'); ?></th>
		<th class="text-center"><?php echo __('Created'); ?></th>
		<th class="text-center"><?php echo __('Modified'); ?></th>
									<th class="text-center"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
									<?php
										$i = 0;
										foreach ($requirementAttachmentType['RequirementAttachment'] as $requirementAttachment): ?>
		<tr>
			<td class="text-center"><?php echo $requirementAttachment['id']; ?></td>
			<td class="text-center"><?php echo $requirementAttachment['requirement_attachment_type_id']; ?></td>
			<td class="text-center"><?php echo $requirementAttachment['name']; ?></td>
			<td class="text-center"><?php echo $requirementAttachment['description']; ?></td>
			<td class="text-center"><?php echo $requirementAttachment['type']; ?></td>
			<td class="text-center"><?php echo $requirementAttachment['data']; ?></td>
			<td class="text-center"><?php echo $requirementAttachment['size']; ?></td>
			<td class="text-center"><?php echo $requirementAttachment['disable']; ?></td>
			<td class="text-center"><?php echo $requirementAttachment['created']; ?></td>
			<td class="text-center"><?php echo $requirementAttachment['modified']; ?></td>
			<td class="text-center">
				<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('controller' => 'requirement_attachments', 'action' => 'view', $requirementAttachment['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
				<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('controller' => 'requirement_attachments', 'action' => 'edit', $requirementAttachment['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
				<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('controller' => 'requirement_attachments', 'action' => 'delete', $requirementAttachment['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $requirementAttachment['id'])); ?>
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

