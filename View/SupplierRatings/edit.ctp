<div class="row">
    <div class="col-xs-12">
		<div class="box box-primary">
            <?php echo $this->Form->create('SupplierRating', array('role' => 'form')); ?>
            <section class="invoice">
                <div class="box-header">
                    <h2 class="page-header"><i class="glyphicon glyphicon-list-alt"></i> <?php echo __('Supplier Rating'); ?></h2>
                    <div class="box-tools pull-right">
	                <div class="btn-group">      
                      <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-chevron-left"></i> Back'), $this->request->referer(), array('class' => 'btn btn-linkedin', 'escape' => false, 'data-toggle'=>'tooltip', 'type' => 'button')); ?>
                    </div>
	            </div>                    
                </div>
                <div class="box-body table-responsive">       
                    <?php echo $this->Form->input('id', array('class' => 'form-control')); ?>
                    <?php echo $this->Form->hidden('memo_tracking_id', array('class' => 'form-control')); ?>

                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Qualification Date'); ?></p>
                          <address>
                            <?php echo $this->Form->text('qualification_date', array('class' => 'form-control dateform', 'label' => false, 'readonly' => true)); ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Office'); ?></p>
                          <address>
                            <?php echo $this->Form->input('office', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Purchase Method'); ?></p>
                          <address>
                            <?php echo $this->Form->input('purchase_method', array('class' => 'form-control', 'label' => false, 'empty' => true)); ?>
                          </address>
                        </div>
                    </div>    
                    
                    <h3><?php echo __('Exempt Resolution that awards or approves the contract:'); ?></h3><br>
                    
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Purchase Order Number'); ?></p>
                          <address>
                            <?php echo $this->Form->input('purchase_order_number', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Tender Number'); ?></p>
                          <address>
                            <?php echo $this->Form->input('tender_number', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                    </div>    

                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Product'); ?></p>
                          <address>
                            <?php echo $this->Form->input('product', array('class' => 'form-control', 'label' => false, 'options' => $active)); ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Service'); ?></p>
                          <address>
                            <?php echo $this->Form->input('service', array('class' => 'form-control', 'label' => false, 'options' => $active)); ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Amount'); ?></p>
                          <address>
                            <?php echo $this->Form->input('amount', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                    </div>  
                    
                    <h3><?php echo __('Provider Data:'); ?></h3><br>                    
                    
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Business Name'); ?></p>
                          <address>
                            <?php echo $this->Form->input('business_name', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('RUT'); ?></p>
                          <address>
                            <?php echo $this->Form->input('rut', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Entry'); ?></p>
                          <address>
                            <?php echo $this->Form->input('entry', array('class' => 'form-control', 'label' => false)); ?>
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
                            <?php echo $this->Form->input('question_1', array('class' => 'form-control', 'label' => false, 'options' => $evaluations, 'empty' => true)); ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col foundation_question_1">
                            <p class="lead"><?php echo __('Foundation'); ?></p>
                          <address>
                            <?php echo $this->Form->input('foundation_question_1', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                    </div> 

                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('How would you rate the quality of the products and / or services delivered?'); ?></p>
                          <address>
                            <?php echo $this->Form->input('question_2', array('class' => 'form-control', 'label' => false, 'options' => $evaluations, 'empty' => true)); ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col foundation_question_2">
                            <p class="lead"><?php echo __('Foundation'); ?></p>
                          <address>
                            <?php echo $this->Form->input('foundation_question_2', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                    </div> 

                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('How would you rate compliance with the Technical Specifications ?. Example: compliance of Products and Services offered, quantity, terms; place of delivery, levels or standards required.'); ?></p>
                          <address>
                            <?php echo $this->Form->input('question_3', array('class' => 'form-control', 'label' => false, 'options' => $evaluations, 'empty' => true)); ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col foundation_question_3">
                            <p class="lead"><?php echo __('Foundation'); ?></p>
                          <address>
                            <?php echo $this->Form->input('foundation_question_3', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                    </div> 

                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('How do you evaluate the overall performance of the provider?'); ?></p>
                          <address>
                            <?php echo $this->Form->input('question_4', array('class' => 'form-control', 'label' => false, 'options' => $evaluations, 'empty' => true)); ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col foundation_question_4">
                            <p class="lead"><?php echo __('Foundation'); ?></p>
                          <address>
                            <?php echo $this->Form->input('foundation_question_4', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                    </div> 

                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Would you recommend to third parties the purchase of these products and / or services from this provider?'); ?></p>
                          <address>
                            <?php echo $this->Form->input('question_5', array('class' => 'form-control', 'label' => false, 'options' => $active)); ?>
                          </address>
                        </div>

                        <div class="col-sm-6 invoice-col foundation_question_5">
                            <p class="lead"><?php echo __('Foundation'); ?></p>
                          <address>
                            <?php echo $this->Form->input('foundation_question_5', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                    </div> 

                    <div class="row no-print">
                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-linkedin ajax">
                                <i class="glyphicon glyphicon-floppy-disk"></i> <?php echo __('Save'); ?>
                            </button>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
		      </div><!-- /.form -->
        </section>
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
<?php
    echo $this->Html->script('plugins/datepicker/bootstrap-datepicker.js');
    echo $this->Html->script('plugins/datepicker/locales/bootstrap-datepicker.es.js');
?>
<script>
    $('body').on('keypress keyup blur focus', '.dateform', function(e){
        $(this).datepicker({ language: 'es', format: 'dd-mm-yyyy', weekStart:'1' });
    });
    
    $(document).ready(function(){
        var answer1 = $("#SupplierRatingQuestion1 option:selected").val();
        var answer2 = $("#SupplierRatingQuestion2 option:selected").val();
        var answer3 = $("#SupplierRatingQuestion3 option:selected").val();
        var answer4 = $("#SupplierRatingQuestion4 option:selected").val();
        var answer5 = $("#SupplierRatingQuestion5 option:selected").val();
        
        if((answer1 == 2) || (answer1 == 3)){ 
            $(".foundation_question_1").show();
            $("#SupplierRatingFoundationQuestion1").prop('required',true);
        }else{
            $(".foundation_question_1").hide();
            $("#SupplierRatingFoundationQuestion1").prop('required',false);
        }
        
        if((answer2 == 2) || (answer2 == 3)){ 
            $(".foundation_question_2").show();
            $("#SupplierRatingFoundationQuestion2").prop('required',true);
        }else{
            $(".foundation_question_2").hide();
            $("#SupplierRatingFoundationQuestion2").prop('required',false);
        }
        
        if((answer3 == 2) || (answer3 == 3)){ 
            $(".foundation_question_3").show();
            $("#SupplierRatingFoundationQuestion3").prop('required',true);
        }else{
            $(".foundation_question_3").hide();
            $("#SupplierRatingFoundationQuestion3").prop('required',false);
        }
        
        if((answer4 == 2) || (answer4 == 3)){ 
            $(".foundation_question_4").show();
            $("#SupplierRatingFoundationQuestion4").prop('required',true);
        }else{
            $(".foundation_question_4").hide();
            $("#SupplierRatingFoundationQuestion4").prop('required',false);
        }
        
        if(answer5 == 0){ 
            $(".foundation_question_5").show();
            $("#SupplierRatingFoundationQuestion5").prop('required',true);
        }else{
            $(".foundation_question_5").hide();
            $("#SupplierRatingFoundationQuestion5").prop('required',false);
        }
    });    
    
    $("#SupplierRatingQuestion1").change(function(){
        var answer = $("#SupplierRatingQuestion1 option:selected").val();
        if((answer == 2) || (answer == 3)){ 
            $(".foundation_question_1").show();
            $("#SupplierRatingFoundationQuestion1").prop('required',true);
        }else{
            $(".foundation_question_1").hide();
            $("#SupplierRatingFoundationQuestion1").prop('required',false);
        }
    });
    
    $("#SupplierRatingQuestion2").change(function(){
        var answer = $("#SupplierRatingQuestion2 option:selected").val();
        if((answer == 2) || (answer == 3)){ 
            $(".foundation_question_2").show();
            $("#SupplierRatingFoundationQuestion2").prop('required',true);
        }else{
            $(".foundation_question_2").hide();
            $("#SupplierRatingFoundationQuestion2").prop('required',false);
        }
    });
    
    $("#SupplierRatingQuestion3").change(function(){
        var answer = $("#SupplierRatingQuestion3 option:selected").val();
        if((answer == 2) || (answer == 3)){ 
            $(".foundation_question_3").show();
            $("#SupplierRatingFoundationQuestion3").prop('required',true);
        }else{
            $(".foundation_question_3").hide();
            $("#SupplierRatingFoundationQuestion3").prop('required',false);
        }
    });
    
    $("#SupplierRatingQuestion4").change(function(){
        var answer = $("#SupplierRatingQuestion4 option:selected").val();
        if((answer == 2) || (answer == 3)){ 
            $(".foundation_question_4").show();
            $("#SupplierRatingFoundationQuestion4").prop('required',true);
        }else{
            $(".foundation_question_4").hide();
            $("#SupplierRatingFoundationQuestion4").prop('required',false);
        }
    });
    
    $("#SupplierRatingQuestion5").change(function(){
        var answer = $("#SupplierRatingQuestion5 option:selected").val();
        if((answer == 0)){ 
            $(".foundation_question_5").show();
            $("#SupplierRatingFoundationQuestion5").prop('required',true);
        }else{
            $(".foundation_question_5").hide();
            $("#SupplierRatingFoundationQuestion5").prop('required',false);
        }
    });
    
</script>
					