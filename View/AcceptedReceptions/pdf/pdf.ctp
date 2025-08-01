<?php 
    $receptionDate = ($acceptedReception['AcceptedReception']['reception_date']) ? date("d-m-Y", strtotime($acceptedReception['AcceptedReception']['reception_date'])) : NULL;
    $officeGuideDate = ($acceptedReception['AcceptedReception']['office_guide_date']) ? date("d-m-Y", strtotime($acceptedReception['AcceptedReception']['office_guide_date'])) : NULL;
    $invoiceDate = ($acceptedReception['AcceptedReception']['invoice_date']) ? date("d-m-Y", strtotime($acceptedReception['AcceptedReception']['invoice_date'])) : NULL;
    $purchaseOrderDate = ($acceptedReception['AcceptedReception']['purchase_order_date']) ? date("d-m-Y", strtotime($acceptedReception['AcceptedReception']['purchase_order_date'])) : NULL;                                 


    $acceptedReception['AcceptedReception']['reception_date'] = $receptionDate;
    $acceptedReception['AcceptedReception']['office_guide_date'] = $officeGuideDate;
    $acceptedReception['AcceptedReception']['invoice_date'] = $invoiceDate;
    $acceptedReception['AcceptedReception']['purchase_order_date'] = $purchaseOrderDate;
?>

<div><?php echo $this->Html->image('logo_memo.jpg'); ?></div>          
<div style="text-align: center"><h1><?php echo strtoupper(__('Accepted Reception')); ?></h1></div><br>

<table style="width:100%">
    <tr>
        <td colspan="8"><strong><?php echo __('Name of the contracted service / goods or products purchased:'); ?></strong></td>
    </tr>
    <tr>
        <td colspan="8"><div class="title"><h1><?php echo $acceptedReception['AcceptedReception']['name']; ?><br></h1></div></td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td><strong><?php echo __('Supplier Name:'); ?></strong></td>
        <td><?php echo $acceptedReception['AcceptedReception']['supplier_name']; ?></td>
        <td><strong><?php echo __('Supplier Rut:'); ?></strong></td>
        <td><?php echo $acceptedReception['AcceptedReception']['supplier_rut']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo __('Purchase Order:'); ?></strong></td>
        <td><?php echo $acceptedReception['AcceptedReception']['purchase_order']; ?></td>
        <td><strong><?php echo __('Amount:'); ?></strong></td>
        <td><?php echo $acceptedReception['AcceptedReception']['amount']; ?></td>
    </tr>
</table><br><br>

<?php echo __('With date, ').$acceptedReception['AcceptedReception']['reception_date'].__(', it has been accepted by the Ministry of Women and Gender Equality to the satisfaction of the undersigned, as detailed below:'); ?><br><br>

<table style="width:100%" border="1px">
    <tr>
        <th><?php echo __('Concept'); ?></th>
        <th><?php echo __('Yes'); ?>/<?php echo __('No'); ?></th>
    </tr>
    <tr>
        <td><?php echo __('Purchase Order Reception 100%:'); ?></td>
        <td align="center"><?php echo $active[$acceptedReception['AcceptedReception']['purchase_order_received']]; ?></td>
    </tr>
    <tr>
        <td><?php echo __('Purchase Order Partially Received:'); ?></td>
        <td align="center"><?php echo $active[$acceptedReception['AcceptedReception']['purchase_order_received_p']]; ?></td>
    </tr>
</table><br><br>                  
                            
<?php echo __('Detail of attached documents:'); ?><br><br>
                    
<table style="width:100%" border="1px">
    <tr>
        <th><?php echo __('Concept'); ?></th>
        <th><?php echo __('Number'); ?></th>
        <th><?php echo __('Date'); ?></th>
    </tr>
    <tr>
        <td><?php echo __('Office Guide'); ?></td>
        <td align="center"><?php echo $acceptedReception['AcceptedReception']['office_guide_number']; ?></td>
        <td align="center"><?php echo $acceptedReception['AcceptedReception']['office_guide_date']; ?></td>
    </tr>
    <tr>
        <td><?php echo __('Invoice'); ?></td>
        <td align="center"><?php echo $acceptedReception['AcceptedReception']['invoice_number']; ?></td>
        <td align="center"><?php echo $acceptedReception['AcceptedReception']['invoice_date']; ?></td>
    </tr>
    <tr>
        <td><?php echo __('Purchase Order'); ?></td>
        <td align="center"><?php echo $acceptedReception['AcceptedReception']['purchase_order_number']; ?></td>
        <td align="center"><?php echo $acceptedReception['AcceptedReception']['purchase_order_date']; ?></td>
    </tr>
</table>
<div style="text-align: center">
    <?php 
        $approveUserId = $acceptedReception['AcceptedReception']['id']; 
        $approveUser = $acceptedReception['MemoTracking']['to']; 
    ?><br><br>
    <strong>
        <?php echo strtoupper($this->requestAction('memos/find_user_username/'.$approveUser)); ?><br>
        MINISTERIO DE LA MUJER Y LA EQUIDAD DE GÉNERO
    </strong><br>
    <?php echo __('This document contains basic digital signature and you can verify its authenticity with the ').'<br><b> ID: '.$approveUserId.'</b>'; ?>
</div>        
<footer>
    <?php echo $this->Html->image('footer_memo2.jpg'); ?>
</footer>