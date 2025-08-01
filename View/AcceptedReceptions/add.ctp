
<div class="row">
    <div class="col-xs-12">
		<div class="box box-success">
            <?php echo $this->Form->create('AcceptedReception', array('role' => 'form')); ?>
            <section class="invoice">
                <div class="box-header">
                    <h2 class="page-header"><i class="glyphicon glyphicon-list-alt"></i> <?php echo __('Accepted Reception'); ?></h2>
                </div>
                <div class="box-body table-responsive">
                    
                    <div class="row invoice-info">
                        <div class="col-sm-12 invoice-col">
                            <p class="lead"><?php echo __('Name of the contracted service / goods or products purchased:'); ?></p>
                          <address>
                            <?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                    </div> 
                    
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Supplier Name:'); ?></p>
                          <address>
                            <?php echo $this->Form->input('supplier_name', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Supplier Rut:'); ?></p>
                          <address>
                            <?php echo $this->Form->input('supplier_rut', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Purchase Order:'); ?></p>
                          <address>
                            <?php echo $this->Form->input('purchase_order', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Amount:'); ?></p>
                          <address>
                            <?php echo $this->Form->input('amount', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                    </div> 
                    
                    <h3><?php echo __('With date, ').$this->Form->text('reception_date', array('class' => 'dateform text-center', 'readonly' => true)).__(', it has been accepted by the Ministry of Women and Gender Equality to the satisfaction of the undersigned, as detailed below:'); ?></h3><br>
                    
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Purchase Order Reception 100%:'); ?></p>
                          <address>
                            <?php echo $this->Form->input('purchase_order_received', array('class' => 'form-control', 'label' => false, 'options' => $active)); ?>
                          </address>
                        </div>
                        <div class="col-sm-6 invoice-col">
                            <p class="lead"><?php echo __('Purchase Order Partially Received:'); ?></p>
                          <address>
                            <?php echo $this->Form->input('purchase_order_received_p', array('class' => 'form-control', 'label' => false, 'options' => $active)); ?>
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
                            <?php echo $this->Form->input('office_guide_number', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <p class="lead"><?php echo __('Date'); ?></p>
                          <address>
                            <?php echo $this->Form->text('office_guide_date', array('class' => 'form-control dateform text-center', 'label' => false, 'readonly' => true)); ?>
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
                            <?php echo $this->Form->input('invoice_number', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                          <address>
                            <?php echo $this->Form->text('invoice_date', array('class' => 'form-control dateform text-center', 'label' => false, 'readonly' => true)); ?>
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
                            <?php echo $this->Form->input('purchase_order_number', array('class' => 'form-control', 'label' => false)); ?>
                          </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                          <address>
                            <?php echo $this->Form->text('purchase_order_date', array('class' => 'form-control dateform text-center', 'readonly' => true, 'label' => false)); ?>
                          </address>
                        </div> 
                    </div> 
                    
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-large btn-primary btn btn-success pull-right')); ?>
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
</script>