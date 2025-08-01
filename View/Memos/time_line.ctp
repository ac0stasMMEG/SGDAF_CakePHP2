<?php //echo $this->requestAction('memos/find_user_username/acortes');?>
<div class="row">
    <div class="box-tools pull-right">        
        <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-chevron-left"></i> Back'), $this->request->referer(), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'type' => 'button')); ?> &nbsp; &nbsp;
    </div>
    <div class="col-md-12">
        <ul class="timeline">
        <?php foreach($allMemos as $memo): ?>
            <?php if($memo['Memo']):?>
                <!-- The time line -->
                <li class="time-label">
                      <span class="bg-green">
                        <?php echo __('Created').' : '.$memo['MemoTracking'][0]['created']; ?>
                      </span>
                </li>
                <!-- /.timeline-label -->
            
                <?php
                    $datetime1 = new DateTime("now");
                    $datetime2 = new DateTime($memo['MemoTracking'][0]['created']);
                    $interval = $datetime1->diff($datetime2);
                ?>  
                
                <?php 
                    if($memo['Memo']['state_id']): 
                        foreach($memo['MemoTracking'] as $tracking):
                            if(($tracking['memo_tracking_type_id'] == "5b8588b3-667c-4f97-a1ec-1f68c26b1ae0") AND ($tracking['viewed'] == 0)):
                                $addressee = $this->requestAction('memos/find_user_username/'.$tracking['to']);
                            endif;
                        endforeach;
                ?>
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-clipboard bg-purple"></i>

                      <div class="timeline-item">

                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo $interval->format('%R%a días , %h horas y %i minutos'); ?></span>

                        <h3 class="timeline-header no-border"><a><?php echo __('Memo Gestionado'); ?> por <?php echo $addressee ?>:</a> <?php echo $memo['Memo']['state_observation']; ?></h3>
                        
                      </div>
                    </li>
                    <!-- END timeline item -->
                <?php endif; ?>
            
                <?php if(($memo['MemoTracking'][0]['approved'] == 0) AND ($memo['MemoTracking'][0]['observation'])): ?>
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-mail-reply bg-red"></i>

                      <div class="timeline-item">

                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo $interval->format('%R%a días , %h horas y %i minutos'); ?></span>

                        <h3 class="timeline-header no-border"><a><?php echo __('Memo Devuelto'); ?> a <?php echo $this->requestAction('memos/find_owner/'.$memo['Memo']['id']); ?>:</a> <?php echo $memo['MemoTracking'][0]['observation']; ?></h3>
                        
                      </div>
                    </li>
                    <!-- END timeline item -->
                <?php endif; ?>
            
            
                <!-- timeline item -->
                <li>
                  <i class="fa fa-file-o bg-blue"></i>
                    
                  <div class="timeline-item">
                      
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $interval->format('%R%a días , %h horas y %i minutos'); ?></span>

                    <h3 class="timeline-header"><a><?php echo $memo['MemoType']['name']; ?></a></h3>

                    <div class="timeline-body">
                        <dl class="dl-horizontal">
                            <dt><?php echo __('Número Memo:'); ?></dt>
                            <dd><?php echo 'D'.$memo['Memo']['memo_number'].'-'.$memo['Memo']['year']; ?></dd>
                            
                            <dt><?php echo __('Número Externo:'); ?></dt>
                            <dd><?php echo $memo['Memo']['external_office']; ?></dd>
                            
                            <dt><?php echo __('Número Interno:'); ?></dt>
                            <dd><?php echo $memo['Memo']['internal_office']; ?></dd>
                            
                            <dt><?php echo __('Referencia:'); ?></dt>
                            <dd><?php echo $memo['Memo']['reference']; ?></dd>
                            
                            <dt><?php echo __('Description: '); ?></dt>
                            <dd><?php echo $memo['Memo']['description']; ?></dd>
                        </dl>    
                    </div>
                    <div class="timeline-footer">
                        <div class="btn-group">
                            <?php if(is_null($short)): ?>
                                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i> &nbsp; See detail'), array('action' => 'view', $memo['Memo']['id']), array('class' => 'btn btn-linkedin btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button')); ?>

                                <button type="button" class="btn btn-linkedin btn-xs" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-download-alt"></i> &nbsp;<?php echo __('Export ');?>&nbsp;<span class="fa fa-caret-down"></span></button>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link(__('Export Memo (PDF)'), array('action' => 'pdf', $memo['Memo']['id'], 'ext' => 'pdf'), array('class' => '', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export')); ?></li>
                                    <li class="divider"></li>
                                    <li><?php echo $this->Html->link(__('Export Attach (ZIP)'), array('action' => 'create_zip', $memo['Memo']['id']), array('class' => '', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'export'), __('It is in the process of exporting the memorandum (s) and their attachments. This process may delay. %s (PDF/ZIP)', $memo['Memo']['reference'])); ?></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                      </div>    
                  </div>
                </li>
                <!-- END timeline item -->
            <?php endif; ?>
            <?php if(($memo['Attachment']) AND is_null($short)):?>
                <!-- timeline item -->
                <li>
                  <i class="fa fa-paperclip bg-aqua"></i>

                  <div class="timeline-item">

                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $interval->format('%R%a días , %h horas y %i minutos'); ?></span>

                    <h3 class="timeline-header"><a><?php echo __('Attachments'); ?></a></h3>

                    <div class="timeline-body">
                        <div class="btn-group">                      
                            <?php foreach($memo['Attachment'] as $num => $attachment):?>
                                <a target="_blank" href="<?php echo $this->Html->url('/files/'.$attachment['id'].'/'.$attachment['name']); ?>"><button type="button" class="btn btn-gray"><i class="fa fa-cloud-download"></i> <?php echo $attachment['name']; ?></button></a>
                            <?php endforeach; ?>
                        </div>    
                    </div>
                    <div class="timeline-footer">
                      <?php //echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i> &nbsp; See detail'), array('action' => 'view', $memo['Memo']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button')); ?>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
            <?php endif; ?>
            <?php if($memo['MemoTracking']):?>
                <!-- timeline item -->
                <li>
                  <i class="fa fa-user bg-maroon"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $interval->format('%R%a días , %h horas y %i minutos'); ?></span>

                    <h3 class="timeline-header"><a><?php echo __('Users'); ?></a></h3>

                    <div class="timeline-body">
                         <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="<?php echo "#tab_o_".$memo['Memo']['id']; ?>" data-toggle="tab" aria-expanded="true"><?php echo __('Send By'); ?></a></li>
                              <li class=""><a href="<?php echo "#tab_a_".$memo['Memo']['id']; ?>" data-toggle="tab" aria-expanded="true"><?php echo __('Addressee'); ?></a></li>
                              <li class=""><a href="<?php echo "#tab_n_".$memo['Memo']['id']; ?>" data-toggle="tab" aria-expanded="false"><?php echo __('Notify'); ?></a></li>
                             </ul>
                             <div class="tab-content">
                                 <div class="tab-pane active" id="<?php echo "tab_o_".$memo['Memo']['id']; ?>">
                                     <h4><i class="fa fa-user"></i> <?php echo $this->requestAction('memos/find_owner/'.$memo['Memo']['id']); ?></h4>
                                 </div>
                                 <div class="tab-pane" id="<?php echo "tab_a_".$memo['Memo']['id']; ?>">
                                    <?php foreach($memo['MemoTracking'] as $tracking):?>
                                        <?php if(($tracking['memo_tracking_type_id'] == "5b8588b3-667c-4f97-a1ec-1f68c26b1ae0") AND ($tracking['viewed'] == 0)): // Aprobación ?>
                                            <div style="display: inline-block">
                                                <h4><i class="fa fa-user"></i> <?php echo $this->requestAction('memos/find_user_username/'.$tracking['to']); ?> (<?php echo ($tracking['read']) ? __('Read') : __('Unread'); ?>)</h4>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                 </div>
                                 <div class="tab-pane" id="<?php echo "tab_n_".$memo['Memo']['id']; ?>">
                                    <?php foreach($memo['MemoTracking'] as $tracking):?>
                                        <?php if(($tracking['memo_tracking_type_id'] == "5b8588ba-ef8c-49e1-8592-1f68c26b1ae0") AND ($tracking['viewed'] == 0)): // Notificación ?>
                                            <h4><i class="fa fa-user"></i> <?php echo $this->requestAction('memos/find_user_username/'.$tracking['to']); ?></h4>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                 </div>
                             </div>     
                        </div>     
                    </div>
                    <div class="timeline-footer">
                      <?php //echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i> &nbsp; See detail'), array('action' => 'view', $memo['Memo']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button')); ?>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
            <?php endif; ?>
            <?php if(($memo['Matter']['forms'] === '1') AND is_null($short)): // Tipo Autorización generación de pago ?>
                <!-- timeline item -->
                <li>
                  <i class="fa fa-file-text-o bg-purple"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $interval->format('%R%a días , %h horas y %i minutos'); ?></span>

                    <h3 class="timeline-header"><a><?php echo __('Forms'); ?></a></h3>

                    <div class="timeline-body">
                        <?php $forms = $this->requestAction('memos/find_form/'.$memo['Memo']['id']); ?>
                        <?php if (!empty($forms['AcceptedReception'][0]['id'])) : ?>
                            <a name="<?php echo Router::url('/accepted_receptions/pdf/', true).$forms['AcceptedReception'][0]['id'].'.pdf'; ?>" class="btn btn-app online" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-file-text"></i> <?php echo __('Accepted Reception'); ?>
                            </a>
                        <?php else: ?>
                            <a class="btn btn-app online">
                                <i class="fa fa-file-text"></i> <?php echo __('Accepted Reception').' '.__('No Information'); ?>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($forms['SupplierRating'][0]['id'])) : ?>
                            <a name="<?php echo Router::url('/supplier_ratings/pdf/', true).$forms['SupplierRating'][0]['id'].'.pdf'; ?>" class="btn btn-app online" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-file-text"></i> <?php echo __('Supplier Rating').'<br><b>'.__('No Information').'</b>'; ?>
                            </a>
                        <?php else: ?>
                            <a class="btn btn-app online">
                                <i class="fa fa-file-text"></i> <?php echo __('Accepted Reception').'<br><b>'.__('No Information').'</b>'; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="timeline-footer">
                      <?php //echo $this->Html->link(__('<i class="glyphicon glyphicon-resize-full"></i> &nbsp; Online Form'), array('action' => 'view', $memo['Memo']['id']), array('class' => 'btn btn-primary btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button')); ?>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
            <?php endif; ?>
            <?php if(is_null($short)):?>
            <!-- timeline item -->
                <li>
                  <i class="fa fa-share-alt bg-yellow"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $interval->format('%R%a días , %h horas y %i minutos'); ?></span>

                    <h3 class="timeline-header"><a><?php echo __('Shunts'); ?></a></h3>

                    <div class="timeline-body">
                         <div class="nav-tabs-custom">
                             <div class="tab-content">
                                 <?php $heFound = false; ?>
                                 <?php foreach($memo['MemoTracking'] as $memoTracking): ?>
                                    <?php if($memoTracking['memo_tracking_type_id'] == '5c924533-db78-449d-b52a-0450c26b1ae0'): ?>
                                        <h4><i class="fa fa-user"></i> <?php echo $this->requestAction('memos/find_user_username/'.$memoTracking['to']); ?> (<?php echo ($memoTracking['created'] != $memoTracking['modified']) ? __('Modified').' '.$memoTracking['modified'] : __('No Modified'); ?>)</h4>
                                    <?php $heFound = true; ?>
                                    <?php endif; ?>
                                 <?php endforeach; ?>
                                 <?php echo !($heFound) ? __('No Information') : NULL; ?>
                             </div>     
                        </div>     
                    </div>
                    <div class="timeline-footer">
                      <?php //echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i> &nbsp; See detail'), array('action' => 'view', $memo['Memo']['id']), array('class' => 'btn btn-warning btn-xs', 'escape' => false, 'data-toggle'=>'tooltip', 'title' => 'view', 'type' => 'button')); ?>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
            <?php endif; ?>
        <?php endforeach;?>
        <li>
          <i class="fa fa-clock-o bg-gray"></i>
        </li>
      </ul>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="modal modal-warning" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <iframe id="popUp" src="" width="100%" height="700px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $('.online').click(function(){
        var url = $(this).attr('name');
    
        $("#popUp").attr('src', url);  
    });
</script>