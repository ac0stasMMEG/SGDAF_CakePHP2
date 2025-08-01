
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Memo Tracking Type'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $memoTrackingType['MemoTrackingType']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="MemoTrackingTypes" class="table table-bordered table-striped">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($memoTrackingType['MemoTrackingType']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Name'); ?></strong></td>
		<td>
			<?php echo h($memoTrackingType['MemoTrackingType']['name']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($memoTrackingType['MemoTrackingType']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($memoTrackingType['MemoTrackingType']['modified']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

					
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?php echo __('Related Memo Trankings'); ?></h3>
					<div class="box-tools pull-right">
						<?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> '.__('New Memo Tranking'), array('controller' => 'memo_trankings', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>					</div><!-- /.actions -->
				</div>
				<?php if (!empty($memoTrackingType['MemoTranking'])): ?>
					
					<div class="box-body table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
											<th class="text-center"><?php echo __('Memo Id'); ?></th>
		<th class="text-center"><?php echo __('User From Id'); ?></th>
		<th class="text-center"><?php echo __('Memo Tracking Type Id'); ?></th>
		<th class="text-center"><?php echo __('User To Id'); ?></th>
		<th class="text-center"><?php echo __('Approved'); ?></th>
		<th class="text-center"><?php echo __('Description'); ?></th>
		<th class="text-center"><?php echo __('Created'); ?></th>
		<th class="text-center"><?php echo __('Modified'); ?></th>
									<th class="text-center"><?php echo __('Actions'); ?></th>
								</tr>
							</thead>
							<tbody>
									<?php
										$i = 0;
										foreach ($memoTrackingType['MemoTranking'] as $memoTranking): ?>
		<tr>
			<td class="text-center"><?php echo $memoTranking['memo_id']; ?></td>
			<td class="text-center"><?php echo $memoTranking['user_from_id']; ?></td>
			<td class="text-center"><?php echo $memoTranking['memo_tracking_type_id']; ?></td>
			<td class="text-center"><?php echo $memoTranking['user_to_id']; ?></td>
			<td class="text-center"><?php echo $memoTranking['approved']; ?></td>
			<td class="text-center"><?php echo $memoTranking['description']; ?></td>
			<td class="text-center"><?php echo $memoTranking['created']; ?></td>
			<td class="text-center"><?php echo $memoTranking['modified']; ?></td>
			<td class="text-center">
				<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('controller' => 'memo_trankings', 'action' => 'view', $memoTranking['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view')); ?>
				<?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('controller' => 'memo_trankings', 'action' => 'edit', $memoTranking['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit')); ?>
				<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('controller' => 'memo_trankings', 'action' => 'delete', $memoTranking['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'delete'), __('Are you sure you want to delete # %s?', $memoTranking['id'])); ?>
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

