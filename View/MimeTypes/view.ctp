<?php echo $this->Html->addCrumb(__('Index mime types'), 'index'); ?>
<div class="row">
    <div class="col-xs-12">
		
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title"><?php  echo __('Mime Type'); ?></h3>
				<div class="box-tools pull-right">
	                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> Edit'), array('action' => 'edit', $mimeType['MimeType']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
	            </div>
			</div>
			
			<div class="box-body table-responsive">
                <table id="MimeTypes" class="table table-bordered table-striped">
					<tbody>
                        <tr>		
                            <td><strong><?php echo __('Name'); ?></strong></td>
                            <td>
                                <?php echo h($mimeType['MimeType']['name']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>		
                            <td><strong><?php echo __('Description'); ?></strong></td>
                            <td>
                                <?php echo h($mimeType['MimeType']['description']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>		
                            <td><strong><?php echo __('Active'); ?></strong></td>
                            <td>
                                <?php echo h($mimeType['MimeType']['active']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>		
                            <td><strong><?php echo __('Created'); ?></strong></td>
                            <td>
                                <?php echo h($mimeType['MimeType']['created']); ?>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>		
                            <td><strong><?php echo __('Modified'); ?></strong></td>
                            <td>
                                <?php echo h($mimeType['MimeType']['modified']); ?>
                                &nbsp;
                            </td>
                        </tr>					
                    </tbody>
				</table><!-- /.table table-striped table-bordered -->
			</div><!-- /.table-responsive -->
			
		</div><!-- /.view -->

			
	</div><!-- /#page-content .span9 -->

</div><!-- /#page-container .row-fluid -->

