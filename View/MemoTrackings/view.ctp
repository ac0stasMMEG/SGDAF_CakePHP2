
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Memo Tracking'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $memoTracking['MemoTracking']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="MemoTrackings" class="table table-bordered table-striped">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($memoTracking['MemoTracking']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Memo'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($memoTracking['Memo']['id'], array('controller' => 'memos', 'action' => 'view', $memoTracking['Memo']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Memo Tracking Type'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($memoTracking['MemoTrackingType']['name'], array('controller' => 'memo_tracking_types', 'action' => 'view', $memoTracking['MemoTrackingType']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('From'); ?></strong></td>
		<td>
			<?php echo h($memoTracking['MemoTracking']['from']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('To'); ?></strong></td>
		<td>
			<?php echo h($memoTracking['MemoTracking']['to']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Approved'); ?></strong></td>
		<td>
			<?php echo h($memoTracking['MemoTracking']['approved']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Description'); ?></strong></td>
		<td>
			<?php echo h($memoTracking['MemoTracking']['description']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($memoTracking['MemoTracking']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($memoTracking['MemoTracking']['modified']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->

