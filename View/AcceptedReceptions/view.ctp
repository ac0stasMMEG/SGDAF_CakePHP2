<div class="row">
    <div class="col-xs-12">
		<div class="box box-success">
            <section class="invoice">
                <div class="box-header">
                    <h2 class="page-header"><i class="glyphicon glyphicon-list-alt"></i> <?php echo __('Accepted Reception'); ?></h2>
                    <div class="box-tools pull-right">
	                <div class="btn-group">      
                      <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-chevron-left"></i> &nbsp; Back'), $this->request->referer(), array('class' => 'btn btn-success', 'escape' => false, 'data-toggle'=>'tooltip', 'type' => 'button')); ?>
                    </div>
	            </div>
                </div>
                <div class="box-body table-responsive">                    
                    <div class="row invoice-info">
                        <div class="col-sm-12 invoice-col">
                            <p class="lead"><?php echo __('Name of the contracted service / goods or products purchased:'); ?></p>
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['name']; ?>
                          </address>
                        </div>
                    </div> 
                    
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Supplier Name:'); ?></p>
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['supplier_name']; ?>
                          </address>
                        </div>
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Supplier Rut:'); ?></p>
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['supplier_rut']; ?>
                          </address>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Purchase Order:'); ?></p>
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['purchase_order']; ?>
                          </address>
                        </div>
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Amount:'); ?></p>
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['amount']; ?>
                          </address>
                        </div>
                    </div> 
                    
                    <h3><?php echo __('With date, ').$acceptedReception['AcceptedReception']['reception_date'].__(', it has been accepted by the Ministry of Women and Gender Equality to the satisfaction of the undersigned, as detailed below:'); ?></h3><br>
                    
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Purchase Order Reception 100%:'); ?></p>
                          <address>
                            <?php echo $active[$acceptedReception['AcceptedReception']['purchase_order_received']]; ?>
                          </address>
                        </div>
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Purchase Order Partially Received:'); ?></p>
                          <address>
                            <?php echo $active[$acceptedReception['AcceptedReception']['purchase_order_received_p']]; ?>
                          </address>
                        </div>
                    </div> 
                    
                    <h3><?php echo __('Detail of attached documents:'); ?></h3><br>
                    
                    
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Concept'); ?></p>
                          <address>
                            <h3><?php echo __('Office Guide'); ?></h3>
                          </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Number'); ?></p>
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['office_guide_number']; ?>
                          </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Date'); ?></p>
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['office_guide_date']; ?>
                          </address>
                        </div>
                     </div> 
                    
                     <div class="row invoice-info">     
                        <div class="col-sm-4 invoice-col">
                          <address>
                            <h3><?php echo __('Invoice'); ?></h3>
                          </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['invoice_number']; ?>
                          </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['invoice_date']; ?>
                          </address>
                        </div>
                     </div>    
                    
                     <div class="row invoice-info">   
                        <div class="col-sm-4 invoice-col">
                          <address>
                            <h3><?php echo __('Purchase Order'); ?></h3>
                          </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['purchase_order_number']; ?>
                          </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                          <address>
                            <?php echo $acceptedReception['AcceptedReception']['purchase_order_date']; ?>
                          </address>
                        </div> 
                    </div> 
                    
                    <div class="text-center">
                        <div class="col-xs-6 col-xs-offset-3">
                            <?php 
                                $approveUser = $acceptedReception['MemoTracking']['to'];
                                $groupId= $this->requestAction('users/find_group/'.$approveUser); 

                                if($groupId == 2): // Jefatura
                                    echo $this->Html->image('../sign/'.$approveUser.'.png'); 
                                endif;
                            ?><br>
                            <address>
                                <h3>
                                    <?php echo strtoupper($this->requestAction('memos/find_user_username/'.$approveUser)); ?><br>
                                    <?php echo strtoupper($this->requestAction('memos/find_title_username/'.$approveUser)); ?><br>
                                    MINISTERIO DE LA MUJER Y LA EQUIDAD DE GÉNERO
                                </h3>    
                            </address>    
                        </div>
                    </div>
                    
                    <div class="row no-print">
                        <div class="col-xs-12">

                        </div>
                    </div>                    
            </div><!-- /.form -->
		</section>	
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->