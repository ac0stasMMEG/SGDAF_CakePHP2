<?php echo $this->Html->css('../js/plugins/datatables/dataTables.bootstrap'); ?>

<section class="content">
    <?php if($this->Session->read('groupDB_id') === '2'): ?>
        <div class="row">
            <div class="col-md-3 col-md-offset-4">
                    <div class="box box-primary">
                        <div class="box-body table-responsive">
                            <?php echo $this->Form->create('Memo', array('role' => 'form')); ?>
                            <fieldset>
                                <div class="form-group">
                                    <?php echo $this->Form->input('changeUser', array('class' => 'form-control', 'label' => __('username'), 'required' => true)); ?>
                                </div><!-- .form-group -->
                                <div align="center">
                                    <button type="submit" class="btn btn-linkedin ajax send_without">
                                        <i class="glyphicon glyphicon-user"></i> <?php echo __('Change'); ?>
                                    </button>
                                </div>        
                            </fieldset>

                            <?php echo $this->Form->end(); ?>
                        </div>
                </div>    
            </div>
        </div><br>
    <?php endif; ?>
    <div class="row">    
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo __('Buzones'); ?></h3>

                    <div class="box-tools">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked parent">
                        <li class="" id="my_memo_addressee"><a href="#tab_1"><i class="fa fa-inbox"></i><?php echo __('Received'); ?><span class="label label-warning pull-right" id="box_1"><?php echo $this->requestAction('memos/count_memo/1/'.$startDate.'/'.$endDate); ?></span></a></li>
                        <li class="" id="my_memo"><a href="#tab_2"><i class="fa fa-inbox"></i><?php echo __('Sent'); ?><span class="label label-warning pull-right" id="box_2"><?php echo $this->requestAction('memos/count_memo/2/'.$startDate.'/'.$endDate); ?></span></a></li>
                        <li class="" id="my_memo_notify"><a href="#tab_3"><i class="fa fa-inbox"></i><?php echo __('Notify'); ?><span class="label label-warning pull-right" id="box_3"><?php echo $this->requestAction('memos/count_memo/3/'.$startDate.'/'.$endDate); ?></span></a></li>
                        <li class="" id="my_memo_draft"><a href="#tab_4"><i class="fa fa-inbox"></i><?php echo __('Drafts'); ?><span class="label label-warning pull-right" id="box_4"><?php echo $this->requestAction('memos/count_memo/4/'.$startDate.'/'.$endDate); ?></span></a></li>
                        <li class="" id="my_memo_complete"><a href="#tab_5"><i class="fa fa-inbox"></i><?php echo __('Gestionados'); ?><span class="label label-warning pull-right" id="box_5"><?php echo $this->requestAction('memos/count_memo/5/'.$startDate.'/'.$endDate); ?></span></a></li>
                  </ul>
                </div>
                <!-- /.box-body -->
            </div><br>
            <div class="box box-widget">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
                        <div class="btn-group">
                            <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-refresh"></i> Refresh'), array('action' => 'index'), array('class' => 'btn btn-linkedin', 'escape' => false)); ?>
                            
                            <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> New Memo'), array('action' => 'add'), array('class' => 'btn btn-linkedin', 'escape' => false)); ?>
                        </div>    
                    </div><br><br>
                    <div class="box-body">
                        <div class="row">
                            <?php echo $this->Form->create('Memo', array('role' => 'form', 'id' => 'MemoIndexFormDate')); ?>
                            <div class="col-xs-3 has-feedback">
                                <?php echo $this->Form->input('startDate', array('class' => 'form-control dateform', 'value' => $startDate, 'required' => true, 'label' => false, 'placeholder' => __('Start Date'))); ?><span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                            </div>
                            <div class="col-xs-3 has-feedback">
                                <?php echo $this->Form->input('endDate', array('class' => 'form-control dateform', 'value' => $endDate, 'required' => true, 'label' => false, 'placeholder' => __('End Date'))); ?><span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                            </div>
                            <div class="col-xs-3 has-feedback">
                                <?php echo $this->Form->input('read', array('class' => 'form-control', 'label' => false, 'required' => false, 'label' => false, 'empty' => __('Leídos / No Leídos'), 'options' => $reads)); ?>
                            </div>
                             <button type="submit" id="dateAjax" class="btn btn-linkedin ajax" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-filter"></i> &nbsp;<?php echo __('Filter per year ');?></button>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                </div>	
                <!--<div class="box-body table-responsive">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs parent">
                            <li class="" id="my_memo_addressee">
                                <a href="#tab_1" data-toggle="tab" aria-expanded="false">
                                    <b><?php /*echo __('Received'); ?> (</b><b id="box_1"><?php echo $this->requestAction('memos/count_memo/1/'.$startDate.'/'.$endDate); ?></b><b>)</b>
                                </a>
                            </li>
                            <li class="" id="my_memo">
                                <a href="#tab_2" data-toggle="tab" aria-expanded="true">
                                    <b><?php echo __('Sent'); ?> (</b><b id="box_2"><?php echo $this->requestAction('memos/count_memo/2/'.$startDate.'/'.$endDate); ?></b><b>)</b>
                                </a>
                            </li>
                            <li class="" id="my_memo_notify">
                                <a href="#tab_3" data-toggle="tab" aria-expanded="false">
                                    <b><?php echo __('Notify'); ?> (</b><b id="box_3"><?php echo $this->requestAction('memos/count_memo/3/'.$startDate.'/'.$endDate); ?></b><b>)</b>
                                </a>
                            </li>
                            <li class="" id="my_memo_draft">
                                <a href="#tab_4" data-toggle="tab" aria-expanded="false">
                                    <b><?php echo __('Drafts'); ?> (</b><b id="box_4"><?php echo $this->requestAction('memos/count_memo/4/'.$startDate.'/'.$endDate); ?></b><b>)</b>
                                </a>
                            </li>
                            <li class="" id="my_memo_complete">
                                <a href="#tab_5" data-toggle="tab" aria-expanded="false">
                                    <b><?php echo __('Gestionados'); ?> (</b><b id="box_5"><?php echo $this->requestAction('memos/count_memo/5/'.$startDate.'/'.$endDate); */?></b><b>)</b>
                                </a>
                            </li>
                        </ul>
                        
                    </div>    
                </div>table-responsive -->
            </div><!-- /.index -->
        </div><!-- /#page-content .col-sm-6 -->
        <div class="col-md-9">
            <div class="box box-widget">
                <div class="box-body table-responsive">
                    <div class="tab-content">
                        <div class="tab-pane " id="tab_1">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class="tab-pane " id="my_memo_addressee_t" name="box_1">
                                        <table class="table table-bordered table-striped mail">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="text-center" hidden><?php echo __('Description'); ?></th>
                                                    <!-- <th class="text-center"><?php //echo __('Actions'); ?></th> -->
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                <?php foreach ($addresseeMemos as $memo): ?>
                                                    <tr>
                                                        <td bgcolor="<?php echo ($memo['MemoTracking']['read']) ? 'transparent' : '#367fa9'; ?>" class="read" id="<?php echo $memo['MemoTracking']['id']?>" style="width:10px">
                                                        </td>
                                                        <td id="<?php echo $memo['Memo']['id']; ?>" class="selected_td">
                                                            <div class="post">
                                                              <div class="user-block">
                                                                <span class="username">
                                                                    <?php if($memo['Memo']['importance']): ?>
                                                                        <a><font color="#dd4b39"><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['Memo']['created']))); ?></font></a>
                                                                    <?php else: ?>
                                                                        <a><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['Memo']['created']))); ?></a>    
                                                                    <?php endif; ?>
                                                                  <a href="" class="pull-right btn-box-tool"><?php echo $this->requestAction('memos/find_owner/'.$memo['Memo']['id']); ?></a>
                                                                </span>
                                                                <span class="description"><?php echo h($memo['Memo']['reference']); ?></span>
                                                              </div>
                                                              <ul class="list-inline">
                                                                <?php if($memo['MemoTracking']['approved'] == '0'): ?>
                                                                  <li><a href="" class="link-black text-sm">
                                                                    <div class="direct-chat" style="display: inline-block">
                                                                        <span data-toggle="tooltip" class="fa fa-mail-reply"></span>
                                                                        <div class="tooltip fade top in" role="tooltip" style="display: none;">
                                                                            <div class="tooltip-inner"><?php echo $memo['MemoTracking']['observation']; ?></div>
                                                                        </div>
                                                                    </div>    
                                                                 <?php echo __('give back');?></a></li>      
                                                                <?php endif;?>
                                                                <?php if($memo['Memo']['importance']): ?>
                                                                      <li><a href="" class="link-black text-sm"><i class="fa fa-exclamation margin-r-5"></i><?php echo __('importance');?></a>
                                                                <?php endif; ?>
                                                                <?php if($memo['MemoTracking']['to'] <> $this->Session->read('Auth.User.username')): ?>
                                                                      <li><a href="" class="link-black text-sm"><i class="fa fa-user margin-r-5"></i><?php echo __('share');?></a>
                                                                <?php endif; ?>
                                                                <?php if(($memo['MemoTracking']['memo_tracking_type_id'] == '5c924533-db78-449d-b52a-0450c26b1ae0') OR ($this->requestAction('memoTrackings/memo_shunt/'.$memo['Memo']['id']))): ?> 
                                                                          <li>
                                                                              <a href="" class="link-black text-sm">
                                                                                <div class="direct-chat" style="display: inline-block">
                                                                                    <span data-toggle="tooltip" class="fa fa-share-alt"></span>
                                                                                    <div class="tooltip fade top in" role="tooltip" style="display: none;">
                                                                                        <div class="tooltip-inner">
                                                                                            <?php 
                                                                                                $users = $this->requestAction('memos/list_shunt/'.$memo['Memo']['id']); 
                                                                                                foreach($users as $user):
                                                                                                    echo $this->requestAction('memos/find_user_username/'.$user).'<br>';
                                                                                                endforeach;
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>    
                                                                                <?php echo __('shunt');?>
                                                                              </a>
                                                                          </li> 
                                                                <?php endif; ?>

                                                                <li class="pull-right">
                                                                  <a href="" class="link-black text-sm"><i class="fa fa-calendar margin-r-5"></i><?php echo h($memo['Memo']['memo_date']); ?></a></li>
                                                              </ul>
                                                            </div>
                                                        </td>
                                                        <td class="text-center" hidden><?php echo strip_tags($memo['Memo']['description']); ?>&nbsp;</td>
                                                        <!-- <td class="text-center">
                                                            <div class="btn-group">


                                                                <?php /*echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i> &nbsp; View'), array('action' => 'view', $memo['Memo']['id']), array('class' => 'btn btn-primary', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button', 'id' => 'view_detail')); ?>

                                                                <button name="<?php echo Router::url('/memos/pdf/', true).$memo['Memo']['id'].'/0.pdf'; ?>" class="btn bg-gray color-palette online" data-toggle="modal" data-target="#myModal2"><?php echo __('<i class="glyphicon glyphicon-resize-full"></i> &nbsp; Online Memo'); ?></button>

                                                                <button type="button" class="btn bg-teal color-palette" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-download-alt"></i> &nbsp;<?php echo __('Export ');?>&nbsp;<span class="fa fa-caret-down"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><?php echo $this->Html->link(__('Export Memo (PDF)'), array('action' => 'pdf', $memo['Memo']['id'], 'ext' => 'pdf'), array('class' => 'btn', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export')); ?></li>
                                                                    <li class="divider"></li>
                                                                    <li><?php echo $this->Html->link(__('Export Attach (ZIP)'), array('action' => 'create_zip', $memo['Memo']['id']), array('class' => 'btn', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export'), __('It is in the process of exporting the memorandum (s) and their attachments. This process may delay. %s (PDF/ZIP)', $memo['Memo']['reference'])); ?></li>
                                                                </ul>

                                                                <?php 

                                                                    if (is_null($memo['MemoTracking']['approved'])) {

                                                                        echo $this->Html->link(__('<i class="fa fa-check"></i> &nbsp; Approve'), array('action' => 'add', $memo['Memo']['id']), array('class' => 'btn btn-success', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'add')); 

                                                                        echo $this->Html->link(__('<i class="fa fa-close"></i> &nbsp; Refuse'), array('controller' => 'memo_trackings', 'action' => 'refuse', $memo['Memo']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'refuse', 'data-toggle' => 'modal',  'data-target' => '#myModal'));
                                                                    }*/
                                                                ?>
                                                            </div>
                                                        </td> -->
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="tab-pane " id="tab_2">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class="tab-pane " id="my_memo_t" name="box_2">
                                        <table class="table table-bordered table-striped mail">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="text-center" hidden><?php echo __('Description'); ?></th>
                                                    <!--<th class="text-center" style="width:450px"><?php //echo __('Actions'); ?></th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($myMemos as $memo): ?>
                                                <tr>
                                                    <td bgcolor="<?php echo ($memo['MemoTracking']['read']) ? 'transparent' : '#367fa9'; ?>" class="read" id="<?php echo $memo['MemoTracking']['id']?>" style="width:10px"></td>
                                                    <td id="<?php echo $memo['Memo']['id']; ?>">
                                                        <div class="post">
                                                          <div class="user-block">

                                                                <span class="username">
                                                                  <?php if($memo['Memo']['importance']): ?>
                                                                        <a><font color="#dd4b39"><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['Memo']['created']))); ?></font></a>
                                                                  <?php else: ?>
                                                                        <a><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['MemoTracking']['created']))); ?></a>
                                                                  <?php endif; ?>
                                                                  <a href="" class="pull-right btn-box-tool"><?php echo $this->requestAction('memos/find_recipient/'.$memo['Memo']['id']); ?></a>
                                                                </span>
                                                            <span class="description"><?php echo h($memo['Memo']['reference']); ?></span>
                                                          </div>
                                                          <ul class="list-inline">
                                                            <?php if($memo['MemoTracking']['approved'] == '0'): ?>
                                                              <li><a href="" class="link-black text-sm">
                                                                <div class="direct-chat" style="display: inline-block">
                                                                    <span data-toggle="tooltip" class="fa fa-mail-reply"></span>
                                                                    <div class="tooltip fade top in" role="tooltip" style="display: none;">
                                                                        <div class="tooltip-inner"><?php echo $memo['MemoTracking']['observation']; ?></div>
                                                                    </div>
                                                                </div>
                                                                <?php echo __('give back');?>
                                                             </a></li>      
                                                            <?php endif;?>
                                                            <?php if($memo['Memo']['importance']): ?>
                                                                  <li><a href="" class="link-black text-sm"><i class="fa fa-exclamation margin-r-5"></i><?php echo __('importance');?></a>
                                                            <?php endif; ?> 
                                                            <?php if($memo['MemoTracking']['to'] <> $this->Session->read('Auth.User.username')): ?>
                                                                  <li><a href="" class="link-black text-sm"><i class="fa fa-user margin-r-5"></i><?php echo __('share');?></a>
                                                            <?php endif; ?>          
                                                            <li class="pull-right">
                                                              <a href="" class="link-black text-sm"><i class="fa fa-calendar margin-r-5"></i><?php echo h($memo['Memo']['memo_date']); ?></a></li>
                                                          </ul>
                                                        </div>
                                                    </td>
                                                    <td class="text-center" hidden><?php echo strip_tags($memo['Memo']['description']); ?>&nbsp;</td>
                                                    <!--<td class="text-center">
                                                        <div class="btn-group">

                                                            <?php /*echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i> &nbsp; View'), array('action' => 'view', $memo['Memo']['id']), array('class' => 'btn btn-primary', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button')); ?>

                                                            <button name="<?php echo Router::url('/memos/pdf/', true).$memo['Memo']['id'].'/0.pdf'; ?>" class="btn bg-gray color-palette online" data-toggle="modal" data-target="#myModal2"><?php echo __('<i class="glyphicon glyphicon-resize-full"></i> &nbsp; Online Memo'); ?></button>

                                                            <button type="button" class="btn bg-teal color-palette" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-download-alt"></i> &nbsp;<?php echo __('Export ');?>&nbsp;<span class="fa fa-caret-down"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><?php echo $this->Html->link(__('Export Memo (PDF)'), array('action' => 'pdf', $memo['Memo']['id'], 'ext' => 'pdf'), array('class' => 'btn', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export')); ?></li>
                                                                <li class="divider"></li>
                                                                <li><?php echo $this->Html->link(__('Export Attach (ZIP)'), array('action' => 'create_zip', $memo['Memo']['id']), array('class' => 'btn', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export'), __('It is in the process of exporting the memorandum (s) and their attachments. This process may delay. %s (PDF/ZIP)', $memo['Memo']['reference'])); ?></li>
                                                            </ul>                                                 

                                                            <?php echo ($memo['MemoTracking']['approved'] == '0') ? $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i> &nbsp; Edit'), array('action' => 'edit', $memo['Memo']['id']), array('class' => 'btn btn-warning', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit', 'type' => 'button')) : NULL; 

                                                            echo $this->Html->link(__('<i class="glyphicon glyphicon-send"></i> &nbsp; Enviar'), array('action' => 'edit', $memo['Memo']['id']), array('class' => 'btn bg-purple', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'edit', 'type' => 'button')); */
                                                            ?>
                                                        </div>
                                                    </td>-->
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>    
                            </div>    
                        </div>
                        <div class="tab-pane " id="tab_3">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class="tab-pane " id="my_memo_notify_t"  name="box_3">
                                        <table  class="table table-bordered table-striped mail">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="text-center" hidden><?php echo __('Description'); ?></th>
                                                    <!-- <th class="text-center" style="width:450px"><?php //echo __('Actions'); ?></th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($notifyMemos as $memo): ?>
                                                <tr>
                                                    <td bgcolor="<?php echo ($memo['MemoTracking']['read']) ? 'transparent' : '#367fa9'; ?>" class="read" id="<?php echo $memo['MemoTracking']['id']?>" style="width:10px"></td>
                                                    <td id="<?php echo $memo['Memo']['id']; ?>">
                                                        <div class="post">
                                                          <div class="user-block">

                                                                <span class="username">
                                                                  <?php if($memo['Memo']['importance']): ?>
                                                                        <a><font color="#dd4b39"><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['Memo']['created']))); ?></font></a>
                                                                  <?php else: ?>
                                                                        <a><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['Memo']['created']))); ?></a>    
                                                                  <?php endif; ?>
                                                                  <a href="" class="pull-right btn-box-tool"><?php echo $this->requestAction('memos/find_owner/'.$memo['Memo']['id']); ?></a>
                                                                </span>
                                                            <span class="description"><?php echo h($memo['Memo']['reference']); ?></span>
                                                          </div>
                                                          <ul class="list-inline">
                                                            <?php if($memo['MemoTracking']['approved'] == '0'): ?>
                                                              <li><a href="" class="link-black text-sm">
                                                                <div class="direct-chat" style="display: inline-block">
                                                                    <span data-toggle="tooltip" class="fa fa-mail-reply"></span>
                                                                    <div class="tooltip fade top in" role="tooltip" style="display: none;">
                                                                        <div class="tooltip-inner"><?php echo $memo['MemoTracking']['observation']; ?></div>
                                                                    </div>
                                                                </div>    
                                                                <?php echo __('give back');?>  
                                                             </a></li>      
                                                            <?php endif;?>
                                                            <?php if($memo['Memo']['importance']): ?>
                                                                  <li><a href="" class="link-black text-sm"><i class="fa fa-exclamation margin-r-5"></i><?php echo __('importance');?></a>
                                                            <?php endif; ?>  

                                                            <li class="pull-right">
                                                              <a href="" class="link-black text-sm"><i class="fa fa-calendar margin-r-5"></i><?php echo h($memo['Memo']['memo_date']); ?></a></li>
                                                          </ul>
                                                        </div>
                                                    </td>
                                                    <td class="text-center" hidden><?php echo strip_tags($memo['Memo']['description']); ?>&nbsp;</td>
                                                    <!-- <td class="text-center">
                                                        <div class="btn-group">

                                                            <?php /*echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i> &nbsp; View'), array('action' => 'view', $memo['Memo']['id']), array('class' => 'btn btn-primary', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button')); ?>

                                                            <button name="<?php echo Router::url('/memos/pdf/', true).$memo['Memo']['id'].'/0.pdf'; ?>" class="btn bg-gray color-palette online" data-toggle="modal" data-target="#myModal2"><?php echo __('<i class="glyphicon glyphicon-resize-full"></i> &nbsp; Online Memo'); ?></button>

                                                            <button type="button" class="btn bg-teal color-palette" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-download-alt"></i> &nbsp;<?php echo __('Export ');?>&nbsp;<span class="fa fa-caret-down"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><?php echo $this->Html->link(__('Export Memo (PDF)'), array('action' => 'pdf', $memo['Memo']['id'], 'ext' => 'pdf'), array('class' => 'btn', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export')); ?></li>
                                                                <li class="divider"></li>
                                                                <li><?php echo $this->Html->link(__('Export Attach (ZIP)'), array('action' => 'create_zip', $memo['Memo']['id']), array('class' => 'btn', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export'), __('It is in the process of exporting the memorandum (s) and their attachments. This process may delay. %s (PDF/ZIP)', $memo['Memo']['reference'])); */?></li>
                                                            </ul>

                                                        </div>
                                                    </td> -->
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>    
                        </div>
                        <div class="tab-pane " id="tab_4">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class="tab-pane " id="my_memo_draft_t"  name="box_4">
                                        <table  class="table table-bordered table-striped mail">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="text-center" hidden><?php echo __('Description'); ?></th>
                                                    <!-- <th class="text-center" style="width:450px"><?php //echo __('Actions'); ?></th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($draftMemos as $memo): ?>
                                                <tr>
                                                    <td bgcolor="<?php echo ($memo['MemoTracking']['read']) ? 'transparent' : '#367fa9'; ?>" class="read" id="<?php echo $memo['MemoTracking']['id']?>" style="width:10px"></td>
                                                    <td id="<?php echo $memo['Memo']['id']; ?>">
                                                        <div class="post">
                                                          <div class="user-block">

                                                                <span class="username">
                                                                  <?php if($memo['Memo']['importance']): ?>
                                                                        <a><font color="#dd4b39"><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['Memo']['created']))); ?></font></a>
                                                                  <?php else: ?>
                                                                        <a><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['Memo']['created']))); ?></a>    
                                                                  <?php endif; ?>
                                                                  <a href="" class="pull-right btn-box-tool"><?php echo $this->requestAction('memos/find_recipient/'.$memo['Memo']['id']); ?></a>
                                                                </span>
                                                            <span class="description"><?php echo h($memo['Memo']['reference']); ?></span>
                                                          </div>
                                                          <ul class="list-inline">
                                                            <?php if($memo['MemoTracking']['approved'] == '0'): ?>
                                                              <li><a href="" class="link-black text-sm">
                                                                <div class="direct-chat" style="display: inline-block">
                                                                    <span data-toggle="tooltip" class="fa fa-mail-reply"></span>
                                                                    <div class="tooltip fade top in" role="tooltip" style="display: none;">
                                                                        <div class="tooltip-inner"><?php echo $memo['MemoTracking']['observation']; ?></div>
                                                                    </div>
                                                                </div>    
                                                                <?php echo __('give back');?>
                                                             </a></li>      
                                                            <?php endif;?>
                                                            <?php if($memo['Memo']['importance']): ?>
                                                                  <li><a href="" class="link-black text-sm"><i class="fa fa-exclamation margin-r-5"></i><?php echo __('importance');?></a>
                                                            <?php endif; ?>  

                                                            <?php if($memo['MemoTracking']['to'] <> $this->Session->read('Auth.User.username')): ?>
                                                                  <li><a href="" class="link-black text-sm"><i class="fa fa-user margin-r-5"></i><?php echo __('share');?></a>
                                                            <?php endif; ?>          

                                                            <li class="pull-right">
                                                              <a href="" class="link-black text-sm"><i class="fa fa-calendar margin-r-5"></i><?php echo h($memo['Memo']['memo_date']); ?></a></li>
                                                          </ul>
                                                        </div>
                                                    </td>
                                                    <td class="text-center" hidden><?php echo strip_tags($memo['Memo']['description']); ?>&nbsp;</td>
                                                    <!-- <td class="text-center">
                                                        <div class="btn-group">

                                                            <?php /*echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i> &nbsp; View'), array('action' => 'view', $memo['Memo']['id']), array('class' => 'btn btn-primary', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button')); ?>

                                                            <button name="<?php echo Router::url('/memos/pdf/', true).$memo['Memo']['id'].'/0.pdf'; ?>" class="btn bg-gray color-palette online" data-toggle="modal" data-target="#myModal2"><?php echo __('<i class="glyphicon glyphicon-resize-full"></i> &nbsp; Online Memo'); ?></button>

                                                            <button type="button" class="btn bg-teal color-palette" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-download-alt"></i> &nbsp;<?php echo __('Export ');?>&nbsp;<span class="fa fa-caret-down"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><?php echo $this->Html->link(__('Export Memo (PDF)'), array('action' => 'pdf', $memo['Memo']['id'], 'ext' => 'pdf'), array('class' => 'btn', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export')); ?></li>
                                                                <li class="divider"></li>
                                                                <li><?php echo $this->Html->link(__('Export Attach (ZIP)'), array('action' => 'create_zip', $memo['Memo']['id']), array('class' => 'btn', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export'), __('It is in the process of exporting the memorandum (s) and their attachments. This process may delay. %s (PDF/ZIP)', $memo['Memo']['reference'])); */?></li>
                                                            </ul>

                                                        </div>
                                                    </td> -->
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="tab-pane " id="tab_5">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class="tab-pane " id="my_memo_complete_t" name="box_5">
                                        <table class="table table-bordered table-striped mail">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="text-center" hidden><?php echo __('Description'); ?></th>
                                                    <!-- <th class="text-center"><?php //echo __('Actions'); ?></th> -->
                                                </tr>
                                            </thead>
                                            <tbody>   
                                                <?php foreach ($completeMemos as $memo): ?>
                                                    <tr>
                                                        <td bgcolor="<?php echo ($memo['MemoTracking']['read']) ? 'transparent' : '#367fa9'; ?>" class="read" id="<?php echo $memo['MemoTracking']['id']?>" style="width:10px">
                                                        </td>
                                                        <td id="<?php echo $memo['Memo']['id']; ?>" class="selected_td">
                                                            <div class="post">
                                                              <div class="user-block">
                                                                <span class="username">
                                                                    <?php if($memo['Memo']['importance']): ?>
                                                                        <a><font color="#dd4b39"><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['Memo']['created']))); ?></font></a>
                                                                    <?php else: ?>
                                                                        <a><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['Memo']['created']))); ?></a>    
                                                                    <?php endif; ?>
                                                                  <a href="" class="pull-right btn-box-tool"><?php echo $this->requestAction('memos/find_owner/'.$memo['Memo']['id']); ?></a>
                                                                </span>
                                                                <span class="description"><?php echo h($memo['Memo']['reference']); ?></span>
                                                              </div>
                                                              <ul class="list-inline">
                                                                <?php if($memo['MemoTracking']['approved'] == '0'): ?>
                                                                  <li><a href="" class="link-black text-sm">
                                                                    <div class="direct-chat" style="display: inline-block">
                                                                        <span data-toggle="tooltip" class="fa fa-mail-reply"></span>
                                                                        <div class="tooltip fade top in" role="tooltip" style="display: none;">
                                                                            <div class="tooltip-inner"><?php echo $memo['MemoTracking']['observation']; ?></div>
                                                                        </div>
                                                                    </div>    
                                                                 <?php echo __('give back');?></a></li>      
                                                                <?php endif;?>
                                                                <?php if($memo['Memo']['importance']): ?>
                                                                      <li><a href="" class="link-black text-sm"><i class="fa fa-exclamation margin-r-5"></i><?php echo __('importance');?></a>
                                                                <?php endif; ?>
                                                                <?php if($memo['MemoTracking']['to'] <> $this->Session->read('Auth.User.username')): ?>
                                                                      <li><a href="" class="link-black text-sm"><i class="fa fa-user margin-r-5"></i><?php echo __('share');?></a>
                                                                <?php endif; ?>
                                                                <?php if(($memo['MemoTracking']['memo_tracking_type_id'] == '5c924533-db78-449d-b52a-0450c26b1ae0') OR ($this->requestAction('memoTrackings/memo_shunt/'.$memo['Memo']['id']))): ?> 
                                                                          <li>
                                                                              <a href="" class="link-black text-sm">
                                                                                <div class="direct-chat" style="display: inline-block">
                                                                                    <span data-toggle="tooltip" class="fa fa-share-alt"></span>
                                                                                    <div class="tooltip fade top in" role="tooltip" style="display: none;">
                                                                                        <div class="tooltip-inner">
                                                                                            <?php 
                                                                                                $users = $this->requestAction('memos/list_shunt/'.$memo['Memo']['id']); 
                                                                                                foreach($users as $user):
                                                                                                    echo $this->requestAction('memos/find_user_username/'.$user).'<br>';
                                                                                                endforeach;
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>    
                                                                                <?php echo __('shunt');?>
                                                                              </a>
                                                                          </li> 
                                                                <?php endif; ?>

                                                                <li class="pull-right">
                                                                  <a href="" class="link-black text-sm"><i class="fa fa-calendar margin-r-5"></i><?php echo h($memo['Memo']['memo_date']); ?></a></li>
                                                              </ul>
                                                            </div>
                                                        </td>
                                                        <td class="text-center" hidden><?php echo strip_tags($memo['Memo']['description']); ?>&nbsp;</td>
                                                        <!-- <td class="text-center">
                                                            <div class="btn-group">


                                                                <?php /*echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i> &nbsp; View'), array('action' => 'view', $memo['Memo']['id']), array('class' => 'btn btn-primary', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button', 'id' => 'view_detail')); ?>

                                                                <button name="<?php echo Router::url('/memos/pdf/', true).$memo['Memo']['id'].'/0.pdf'; ?>" class="btn bg-gray color-palette online" data-toggle="modal" data-target="#myModal2"><?php echo __('<i class="glyphicon glyphicon-resize-full"></i> &nbsp; Online Memo'); ?></button>

                                                                <button type="button" class="btn bg-teal color-palette" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-download-alt"></i> &nbsp;<?php echo __('Export ');?>&nbsp;<span class="fa fa-caret-down"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><?php echo $this->Html->link(__('Export Memo (PDF)'), array('action' => 'pdf', $memo['Memo']['id'], 'ext' => 'pdf'), array('class' => 'btn', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export')); ?></li>
                                                                    <li class="divider"></li>
                                                                    <li><?php echo $this->Html->link(__('Export Attach (ZIP)'), array('action' => 'create_zip', $memo['Memo']['id']), array('class' => 'btn', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export'), __('It is in the process of exporting the memorandum (s) and their attachments. This process may delay. %s (PDF/ZIP)', $memo['Memo']['reference'])); ?></li>
                                                                </ul>

                                                                <?php 

                                                                    if (is_null($memo['MemoTracking']['approved'])) {

                                                                        echo $this->Html->link(__('<i class="fa fa-check"></i> &nbsp; Approve'), array('action' => 'add', $memo['Memo']['id']), array('class' => 'btn btn-success', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'add')); 

                                                                        echo $this->Html->link(__('<i class="fa fa-close"></i> &nbsp; Refuse'), array('controller' => 'memo_trackings', 'action' => 'refuse', $memo['Memo']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'refuse', 'data-toggle' => 'modal',  'data-target' => '#myModal'));
                                                                    }*/
                                                                ?>
                                                            </div>
                                                        </td> -->
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>    
                <div class="box-body table-responsive" id="memoDetail">
                    <div class="col-md-12 text-center">
                        <?php if(empty($addresseeMemos)): ?>
                            <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
                                <i class="fa fa-mouse-pointer"></i>&nbsp; <?php echo __('Please select a memo'); ?>
                            </button>
                        <?php else: ?>  
                            <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
                                <i class="fa fa-spin fa-refresh"></i>&nbsp; <?php echo __('loading content'); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>    
            </div>
        </div>    
    </div>
</section>    
<!-- /#page-container .row-fluid -->
<div class="modal fade" id="myModalNormal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalShunt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalState" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

<div class="modal modal-primary" id="myModalFrame" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">&nbsp;</h4>
            </div>
            <div class="modal-body">
                <iframe id="popUp" src="" width="100%" height="700px" frameborder="0"></iframe>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __('Close'); ?></button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>

<?php
	echo $this->Html->script('plugins/datatables/jquery.dataTables');
	echo $this->Html->script('plugins/datatables/dataTables.bootstrap'); 
    echo $this->Html->script('plugins/datepicker/bootstrap-datepicker.js');
    echo $this->Html->script('plugins/datepicker/locales/bootstrap-datepicker.es.js');
?>

<script type="text/javascript">
    
    $( "#dateAjax" ).click(function() {
        $('#loader').modal({
            show: 'true'
        }); 
        $( "#MemoIndexFormDate" ).submit();
    });
    
    // Fecha
    
    $('body').on('keypress keyup blur focus', '.dateform', function(e){
        $(this).datepicker({ language: 'es', format: 'yyyy-mm-dd', weekStart:'1' });
    });
    
    if(localStorage.getItem('memo_id') !== null){
        $("#memoDetail").load("<?php echo $this->Html->url(array('action' => 'view_detail'), true) ?>", { memo_detail_id: localStorage.getItem('memo_id')});
    }else{
        var addressee_memo_id = "<?php echo !empty($addresseeMemos[0]['Memo']['id']) ? $addresseeMemos[0]['Memo']['id'] : NULL; ?>";
        $("#memoDetail").load("<?php echo $this->Html->url(array('action' => 'view_detail'), true) ?>", { memo_detail_id: addressee_memo_id});
    }
    
    $(".table tr td:nth-child(2)").on("click", function() {
        
        localStorage.memo_id = $(this).attr('id');
        
        $("#memoDetail").load("<?php echo $this->Html->url(array('action' => 'view_detail'), true) ?>", { memo_detail_id: $(this).attr('id') });
    });
    
    $(".table tr td:nth-child(2)").on("dblclick", function() {
        window.open("<?php echo Router::url('/memos/view/', true); ?>" + $(this).attr('id'),"_blank");
    });
    
    $('.online').click(function(){
        var url = $(this).attr('name');
      
        $("#popUp").attr('src', url);  
    });
    
    $( ".direct-chat").hover(function() {
      $(this).find('.tooltip').toggle();
    });
    
    $('.parent li').click(function()
    {   
        id = $(this).attr('id');
        localStorage.parent = id;
        
        if(id == 'my_memo'){
            $("#tab_2").addClass("active"); 
            $("#my_memo_t").addClass("active");            
        }else if(id == 'my_memo_addressee'){
            $("#tab_1").addClass("active"); 
            $("#my_memo_addressee_t").addClass("active");      
        }else if(id == 'my_memo_draft'){
            $("#tab_4").addClass("active"); 
            $("#my_memo_draft_t").addClass("active");           
        }else if(id == 'my_memo_complete'){
            $("#tab_5").addClass("active"); 
            $("#my_memo_complete_t").addClass("active");      
        }else{
            $("#tab_3").addClass("active"); 
            $("#my_memo_notify_t").addClass("active");      
        }
        
    });

    
    if(localStorage.getItem('parent') !== null){
        
        var parent = localStorage.getItem('parent');
        
        $("#"+parent).addClass("active");        
            
        if(parent == 'my_memo'){
            $("#tab_2").addClass("active"); 
            $("#my_memo_t").addClass("active");            
        }else if(parent == 'my_memo_addressee'){
            $("#tab_1").addClass("active"); 
            $("#my_memo_addressee_t").addClass("active");      
        }else if(parent == 'my_memo_complete'){
            $("#tab_5").addClass("active"); 
            $("#my_memo_complete_t").addClass("active");  
        }else if(parent == 'my_memo_draft'){
            $("#tab_4").addClass("active"); 
            $("#my_memo_draft_t").addClass("active");      
        }else{
            $("#tab_3").addClass("active"); 
            $("#my_memo_notify_t").addClass("active");      
        }
        
    }else{
        $("#my_memo_addressee").addClass("active"); 
        $("#tab_1").addClass("active"); 
        $("#my_memo_addressee_t").addClass("active"); 
    }
    
    $(".read").click(function() {
        var id = $(this).attr('id');
        var color = $(this).css("background-color");
 
        $.ajax({
            type: 'POST',
            dataType: 'jsonp',  
            url: '<?php echo $this->Html->webroot("memos/memo_read/"); ?>'+id,
        });
        
        $(this).css('background-color', ((color == 'rgba(0, 0, 0, 0)') || (color == 'transparent'))? '#367fa9' : 'transparent');
        var box = $(this).closest('.tab-pane').attr('name');
        var valBox = parseInt($('#'+box).html());
        (color == 'rgba(0, 0, 0, 0)') ? (valBox += 1) : (valBox -= 1);
        
        $('#'+box).text(valBox);

    });
    
    
    var menu = new BootstrapMenu('.table', {
      actions: [{
            name: "<?php echo __('The memo has been rejected.'); ?>",
            iconClass: 'fa-mail-reply',
        }, {
            name: "<?php echo __('The memo has been shunt'); ?>",
            iconClass: 'fa-share-alt',
        }, {
            name: "<?php echo __('Memo sent with high importance'); ?>",
            iconClass: 'fa-exclamation',
        }, {
            name: "<?php echo __('It has been shared'); ?>",
            iconClass: 'fa-user',
        }, {
            name: "<?php echo __('The memo has not been read'); ?>",
            iconClass: 'fa-square',
        }, {
            name: "<?php echo __('The memo has been read'); ?>",
            iconClass: 'fa-square-o',
        }]
    });
    
    $(document).ready(function() {        
        $(".mail").dataTable({
            "ordering": false,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Memos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Memos",
                "infoFiltered": "(Filtrado de _MAX_ total memos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Memos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });
        
    }); 
    
    $('.mail td').click(function(e) {
        $('.mail td').removeClass('highlighted');
        $(this).addClass('highlighted');
    });
    
</script>