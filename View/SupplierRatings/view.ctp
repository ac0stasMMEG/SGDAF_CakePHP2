<div class="row">
    <div class="col-xs-12">
		<div class="box box-primary">
            <section class="invoice">
                <div class="box-header">
                    <h2 class="page-header"><i class="glyphicon glyphicon-list-alt"></i> <?php echo __('Supplier Rating'); ?></h2>
                    <div class="box-tools pull-right">
	                <div class="btn-group">      
                      <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-chevron-left"></i> &nbsp; Back'), $this->request->referer(), array('class' => 'btn btn-success', 'escape' => false, 'data-toggle'=>'tooltip', 'type' => 'button')); ?>
                    </div>
	            </div>
                </div>
                <div class="box-body table-responsive">       
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Qualification Date'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['qualification_date']; ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Office'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['office']; ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Purchase Method'); ?></p>
                          <address>
                            <?php echo (!empty($purchaseMethods[$supplierRating['SupplierRating']['purchase_method']])) ? $purchaseMethods[$supplierRating['SupplierRating']['purchase_method']] : __('No Information'); ?>  
                          </address>
                        </div>
                    </div>    
                    
                    <h3><?php echo __('Exempt Resolution that awards or approves the contract:'); ?></h3><br>
                    
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Purchase Order Number'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['purchase_order_number']; ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Tender Number'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['tender_number']; ?>
                          </address>
                        </div>
                    </div>    

                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Product'); ?></p>
                          <address>
                            <?php echo $active[$supplierRating['SupplierRating']['product']]; ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Service'); ?></p>
                          <address>
                            <?php echo $active[$supplierRating['SupplierRating']['service']]; ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Amount'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['amount']; ?>
                          </address>
                        </div>
                    </div>  
                    
                    <h3><?php echo __('Provider Data:'); ?></h3><br>                    
                    
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Business Name'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['business_name']; ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('RUT'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['rut']; ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Entry'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['entry']; ?>
                          </address>
                        </div>
                    </div>  
                    <div class="row invoice-info">
                        <div class="col-xs-8 col-xs-offset-2 invoice-col">
                            <h3>
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-center" colspan="3"><?php echo __('Evaluation Criteria'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php echo __('Very good: Fully complies with the request'); ?><br>
                                                <?php echo __('Good: Complies with the request'); ?>
                                            </td>
                                            <td style="width:5%"></td>
                                            <td>
                                                <?php echo __('Regular: Partially complies with the request'); ?><br>
                                                <?php echo __('Bad: Does not comply with the request'); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center" colspan="3"><?php echo __('Note: if you evaluate with a bad or regular grade, you must base your score.'); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </h3>
                        </div>    
                    </div><br>
                    
                    <h3><?php echo __('Evaluation Questionnaire'); ?></h3><br>
                    
                    <div class="row invoice-info">                        
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('How would you rate the opportunity to deliver the products and / or services? Are deadlines met?'); ?></p>
                          <address>
                            <?php echo (!empty($evaluations[$supplierRating['SupplierRating']['question_1']])) ? $evaluations[$supplierRating['SupplierRating']['question_1']] : __('No Information'); ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Foundation'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['foundation_question_1']; ?>
                          </address>
                        </div>
                    </div> 

                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('How would you rate the quality of the products and / or services delivered?'); ?></p>
                          <address>
                            <?php echo (!empty($evaluations[$supplierRating['SupplierRating']['question_2']])) ? $evaluations[$supplierRating['SupplierRating']['question_2']] : __('No Information'); ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Foundation'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['foundation_question_2']; ?>
                          </address>
                        </div>
                    </div> 

                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('How would you rate compliance with the Technical Specifications ?. Example: compliance of Products and Services offered, quantity, terms; place of delivery, levels or standards required.'); ?></p>
                          <address>
                            <?php echo (!empty($evaluations[$supplierRating['SupplierRating']['question_3']])) ? $evaluations[$supplierRating['SupplierRating']['question_3']] : __('No Information'); ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Foundation'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['foundation_question_3']; ?>
                          </address>
                        </div>
                    </div> 

                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('How do you evaluate the overall performance of the provider?'); ?></p>
                          <address>
                            <?php echo (!empty($evaluations[$supplierRating['SupplierRating']['question_4']])) ? $evaluations[$supplierRating['SupplierRating']['question_4']] : __('No Information'); ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Foundation'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['foundation_question_4']; ?>
                          </address>
                        </div>
                    </div> 

                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Would you recommend to third parties the purchase of these products and / or services from this provider?'); ?></p>
                          <address>
                            <?php echo $active[$supplierRating['SupplierRating']['question_5']]; ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Foundation'); ?></p>
                          <address>
                            <?php echo $supplierRating['SupplierRating']['foundation_question_5']; ?>
                          </address>
                        </div>
                    </div> 
                    
                    <div class="text-center">
                        <div class="col-xs-6 col-xs-offset-3">
                            <?php 
                                $approveUser = $supplierRating['MemoTracking']['to'];
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