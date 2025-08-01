
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Memo Alert'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $memoAlert['MemoAlert']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="MemoAlerts" class="table table-bordered table-striped">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($memoAlert['MemoAlert']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Alert Type'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($memoAlert['AlertType']['name'], array('controller' => 'alert_types', 'action' => 'view', $memoAlert['AlertType']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Memo'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($memoAlert['Memo']['id'], array('controller' => 'memos', 'action' => 'view', $memoAlert['Memo']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('User'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($memoAlert['User']['id'], array('controller' => 'users', 'action' => 'view', $memoAlert['User']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Viewed'); ?></strong></td>
		<td>
			<?php echo h($memoAlert['MemoAlert']['viewed']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($memoAlert['MemoAlert']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($memoAlert['MemoAlert']['modified']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->

