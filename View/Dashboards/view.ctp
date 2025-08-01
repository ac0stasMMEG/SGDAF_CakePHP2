<?php echo $this->Html->addCrumb(__('List dashboards'), 'index'); ?>
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Dashboard'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $dashboard['Dashboard']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="Dashboards" class="table table-bordered table-striped">
					<tbody>
						<tr>		<td><strong><?php echo __('Id'); ?></strong></td>
		<td>
			<?php echo h($dashboard['Dashboard']['id']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Group'); ?></strong></td>
		<td>
			<?php echo $this->Html->link($dashboard['Group']['name'], array('controller' => 'groups', 'action' => 'view', $dashboard['Group']['id']), array('class' => '')); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Name'); ?></strong></td>
		<td>
			<?php echo h($dashboard['Dashboard']['name']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Position'); ?></strong></td>
		<td>
			<?php echo h($dashboard['Dashboard']['position']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Icon'); ?></strong></td>
		<td>
			<?php echo h($dashboard['Dashboard']['icon']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Created'); ?></strong></td>
		<td>
			<?php echo h($dashboard['Dashboard']['created']); ?>
			&nbsp;
		</td>
</tr><tr>		<td><strong><?php echo __('Modified'); ?></strong></td>
		<td>
			<?php echo h($dashboard['Dashboard']['modified']); ?>
			&nbsp;
		</td>
</tr>					</tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->

