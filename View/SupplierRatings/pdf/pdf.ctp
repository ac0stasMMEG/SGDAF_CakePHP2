<?php 
    $qualificationDate = date("d-m-Y", strtotime($supplierRating['SupplierRating']['qualification_date']));                                                         
    $supplierRating['SupplierRating']['qualification_date'] = $qualificationDate;
?>

<div><?php echo $this->Html->image('logo_memo.jpg'); ?></div>          
<div style="text-align: center"><u><h3><strong><?php echo strtoupper(__('Supplier Rating')); ?>.</strong></h3></u></div>
<br>
<table style="width:100%">
    <tr>
        <td><strong><?php echo __('Qualification Date'); ?>: </strong></td>
        <td><?php echo $supplierRating['SupplierRating']['qualification_date']; ?></td>
        <td><strong><?php echo __('Office'); ?>: </strong></td>
        <td><?php echo $supplierRating['SupplierRating']['office']; ?></td>
    </tr>
    <tr>
        <td><strong><?php echo __('Purchase Method'); ?>: </strong></td>
        <td><?php echo (!empty($purchaseMethods[$supplierRating['SupplierRating']['purchase_method']])) ? $purchaseMethods[$supplierRating['SupplierRating']['purchase_method']] : __('No Information'); ?></td>
    </tr>
</table>
<table style="width:100%">
    <tr>
        <td colspan="2"><?php echo __('Exempt Resolution that awards or approves the contract:'); ?></td>
    </tr>
</table>
<table style="width:100%">    
    <tr>
        <td><strong><?php echo __('Purchase Order Number'); ?>: </strong></td>
        <td><?php echo $supplierRating['SupplierRating']['purchase_order_number']; ?></td>
        <td><strong><?php echo __('Tender Number'); ?>: </strong></td>
        <td><?php echo $supplierRating['SupplierRating']['tender_number']; ?></td>
    </tr>
</table>
<table style="width:100%"> 
    <tr>
        <td><strong><?php echo __('Product'); ?>: </strong></td>
        <td><?php echo $active[$supplierRating['SupplierRating']['product']]; ?></td>
        <td><strong><?php echo __('Service'); ?>: </strong></td>
        <td><?php echo $active[$supplierRating['SupplierRating']['service']]; ?></td>
        <td><strong><?php echo __('Amount'); ?>: </strong></td>
        <td><?php echo $supplierRating['SupplierRating']['amount']; ?></td>
    </tr>
</table>    
<div style="text-align: center"><strong><u><?php echo __('Provider Data:'); ?></u></strong></div>
<table style="width:100%">        
    <tr>
        <td><strong><?php echo __('Business Name'); ?>: </strong></td>
        <td><?php echo $supplierRating['SupplierRating']['business_name']; ?></td>
        <td><strong><?php echo __('RUT'); ?>: </strong></td>
        <td><?php echo $supplierRating['SupplierRating']['rut']; ?></td>
        <td><strong><?php echo __('Entry'); ?>: </strong></td>
        <td><?php echo $supplierRating['SupplierRating']['entry']; ?></td>
    </tr>
</table>                        
<table style="width:100%" border="1px">
    <tr>
        <th colspan="3"><?php echo __('Evaluation Criteria'); ?></th>
    </tr>
</table>
<table style="width:100%" border="1px">
    <tr>
        <td>
            <?php echo __('Very good: Fully complies with the request'); ?><br>
            <?php echo __('Good: Complies with the request'); ?>
        </td>
        <td>
            <?php echo __('Regular: Partially complies with the request'); ?><br>
            <?php echo __('Bad: Does not comply with the request'); ?>
        </td>
    </tr>
</table>
<table style="width:100%" border="1px">    
    <tr>
        <th colspan="3"><?php echo __('Note: if you evaluate with a bad or regular grade, you must base your score.'); ?></th>
    </tr>
</table>
<div style="text-align: center"><strong><u><?php echo __('Evaluation Questionnaire'); ?>.</u></strong></div>
<table>
    <tr>
        <td>
            <strong><?php echo __('How would you rate the opportunity to deliver the products and / or services? Are deadlines met?'); ?></strong>

            R: <?php echo (!empty($evaluations[$supplierRating['SupplierRating']['question_1']])) ? $evaluations[$supplierRating['SupplierRating']['question_1']] : __('No Information'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo __('Foundation'); ?>:</strong>

            <?php echo $supplierRating['SupplierRating']['foundation_question_1']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo __('How would you rate the quality of the products and / or services delivered?'); ?></strong>

            R: <?php echo (!empty($evaluations[$supplierRating['SupplierRating']['question_2']])) ? $evaluations[$supplierRating['SupplierRating']['question_2']] : __('No Information'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo __('Foundation'); ?>:</strong>

            <?php echo $supplierRating['SupplierRating']['foundation_question_2']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo __('How would you rate compliance with the Technical Specifications ?. Example: compliance of Products and Services offered, quantity, terms; place of delivery, levels or standards required.'); ?></strong>

            R: <?php echo (!empty($evaluations[$supplierRating['SupplierRating']['question_3']])) ? $evaluations[$supplierRating['SupplierRating']['question_3']] : __('No Information'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo __('Foundation'); ?>:</strong>

            <?php echo $supplierRating['SupplierRating']['foundation_question_3']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo __('How do you evaluate the overall performance of the provider?'); ?></strong>

            R: <?php echo (!empty($evaluations[$supplierRating['SupplierRating']['question_4']])) ? $evaluations[$supplierRating['SupplierRating']['question_4']] : __('No Information'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo __('Foundation'); ?>:</strong>

            <?php echo $supplierRating['SupplierRating']['foundation_question_4']; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo __('Would you recommend to third parties the purchase of these products and / or services from this provider?'); ?></strong>

            R: <?php echo $active[$supplierRating['SupplierRating']['question_5']]; ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo __('Foundation'); ?>:</strong>

            <?php echo $supplierRating['SupplierRating']['foundation_question_5']; ?>
        </td>
    </tr>
</table>                    
<div style="text-align: center">
    <?php 
        $approveUserId = $supplierRating['SupplierRating']['id']; 
        $approveUser = $supplierRating['MemoTracking']['to']; 
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