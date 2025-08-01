
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Historial'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $historial['Historial']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="Historials" class="table table-bordered table-striped">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($historial['Historial']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Owner'); ?></strong></td>
		<td>
			<?php echo h($historial['Historial']['owner']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Memo One'); ?></strong></td>
		<td>
			<?php echo h($historial['Historial']['memo_one']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Memo Two'); ?></strong></td>
		<td>
			<?php echo h($historial['Historial']['memo_two']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($historial['Historial']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($historial['Historial']['modified']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->

