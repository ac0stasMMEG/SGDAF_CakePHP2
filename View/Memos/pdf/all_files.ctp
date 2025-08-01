<?php 
    /*if(!empty($allAttachMemos)):
        foreach ($allAttachMemos as $attachment):
            $file = Router::url('/files/'.$attachment['Attachment']['id'].'/'.$attachment['Attachment']['name'], true);
            $output_format = "jpeg"; 
            $preview_page = "1"; 
            $resolution = "300"; 
            $output_file = "imagick_preview.jpg"; 

            echo "Fetching preview...\n"; 
            $img_data = new Imagick(); 
            $img_data->setResolution( $resolution, $resolution ); 
            $img_data->readImage( $file . "[" . ($preview_page - 1) . "]" ); 
            $img_data->setImageFormat( $output_format ); 

            file_put_contents( $output_file, $img_data, FILE_USE_INCLUDE_PATH ); 
        endforeach;
    endif; */
?>

<?php 
    $i = 1;
    $countPDF = count($leadershipMemo);
    if(!empty($leadershipMemo)):
        foreach($leadershipMemo as $memo): ?>
            <div>
                <?php echo $this->Html->image('logo_memo.jpg'); ?>
            </div>
            <br><br>
            <div class="title"><br>
                <h1><?php echo __('INTERNAL MEMO'); ?> N° <?php echo h('D'.$memo['Memo']['memo_number'].' - '.$memo['Memo']['year']); ?></h1>
            </div>
            <br><br>
            <table class="detail">
                <tbody>
                    <tr>
                        <td style="width:100px"><?php echo __('From'); ?></td>
                        <td>:</td>
                        <td>
                            <?php foreach($userTracking as $tracking):?>
                                <?php if(($tracking['MemoTracking']['memo_tracking_type_id'] == "5ba4f0ba-ec28-471e-af3e-2630c26b1ae0") AND ($tracking['MemoTracking']['viewed'] == '0') AND ($tracking['Memo']['id'] == $memo['Memo']['id'])): // Propietario ?>
                                    <?php 
                                        $approveUser = $tracking['MemoTracking']['to'];
                                        echo $this->requestAction('memos/find_user_username/'.$tracking['MemoTracking']['to']); 
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo __('To'); ?></td>
                        <td>:</td>
                        <td>
                            <?php foreach($userTracking as $tracking):?>
                                <?php if(($tracking['MemoTracking']['memo_tracking_type_id'] == "5b8588b3-667c-4f97-a1ec-1f68c26b1ae0") AND ($tracking['MemoTracking']['viewed'] == '0') AND ($tracking['Memo']['id'] == $memo['Memo']['id'])): // Aprobación ?>
                                    <?php 
                                        echo $this->requestAction('memos/find_user_username/'.$tracking['MemoTracking']['to']).'<br>'; 
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo __('Reference'); ?></td>
                        <td>:</td>
                        <td><?php echo $memo['Memo']['reference']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo __('Date'); ?></td>
                        <td>:</td>
                        <td><?php echo date('Y-m-d', strtotime($memo['MemoTracking']['created'])); ?></td>
                    </tr>
                </tbody>
            </table>

            <hr>

            <?php echo str_replace('data:image/png;base64','data://text/plain;base64',$memo['Memo']['description']); ?>

            <div class="sign">
                <?php 

                    $groupId= $this->requestAction('users/find_group/'.$approveUser); 
                    
                    if(empty($memo['Subrogance']['foot_signature'])):
                        echo $this->Html->image('../mark/'.strtolower($approveUser).'.png'); 
                    else:
                        echo $this->Html->image('../mark/'.$memo['Subrogance']['file_name']); 
                    endif;
                    
                    echo $this->Html->image('../sign/'.strtolower($approveUser).'.png'); 
                   
                ?><br>
                <?php echo strtoupper($this->requestAction('memos/find_user_username/'.$approveUser)); ?><br>
                <?php 
                    if(empty($memo['Subrogance']['foot_signature'])):
                        echo strtoupper($this->requestAction('memos/find_title_username/'.$approveUser)); 
                    else:
                        echo strtoupper($memo['Subrogance']['foot_signature']);
                    endif;
                ?><br>
                MINISTERIO DE LA MUJER Y LA EQUIDAD DE GÉNERO
            </div><br>
            <?php echo $memo['Memo']['initial_responsibility']; ?><br>
            <p class="istribution"><?php echo __('Distribution'); ?>:</p>
            <?php foreach($userTracking as $tracking):?>
                <?php if(($tracking['MemoTracking']['memo_tracking_type_id'] == "5b8588b3-667c-4f97-a1ec-1f68c26b1ae0") AND ($tracking['MemoTracking']['viewed'] == '0') AND ($tracking['Memo']['id'] == $memo['Memo']['id'])): // Aprobación ?>
                    <li><?php echo $this->requestAction('memos/find_user_username/'.$tracking['MemoTracking']['to']); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
            <footer>
                <?php echo $this->Html->image('footer_memo2.jpg'); ?>
            </footer>
            <?php if($i <> $countPDF): ?>
                <div class="page_break"></div>
            <?php endif; ?>
            <?php $i++;?>
        <?php endforeach; ?>
    <?php else: ?>
            <div>
                <?php echo $this->Html->image('logo_memo.jpg'); ?>
            </div>
            <br><br>
            <h1><?php echo __('The memorandum still does not have a response from the head'); ?></h1>
    <?php endif;?>


<!-- Recepción Conforme -->
    <?php if(!empty($acceptedReception)) : ?>
        <div class="page_break"></div>
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
    <?php endif; ?>
<!-- Fin Recepción Conforme -->

<!-- Calificación Proveedor -->
    <?php if(!empty($supplierRating)) : ?>
        <div class="page_break"></div>
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
    <?php endif; ?>
<!-- Fin Calificación Proveedor -->