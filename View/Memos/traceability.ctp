<?php //debug($memos); ?>

<?php
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=trazabilidad.xls");  //File name extension was wrong
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
?>
<table>
    <th><?php echo utf8_decode(__('Number Memo')); ?></th>
    <th><?php echo utf8_decode(__('Broadcast Date')); ?></th>
    <th><?php echo utf8_decode(__('Reception Date')); ?></th>
    <th><?php echo __('Matter'); ?></th>
    <th><?php echo __('From'); ?></th>
    <th><?php echo __('To'); ?></th>
    <th><?php echo __('Response Time'); ?></th>
    <th><?php echo __('Status'); ?></th>
    <?php
        foreach($memos as $countMemo => $memo): 
            
            $nextDataMemoId = (!empty($memos[++$countMemo]['Memo']['id'])) ? $memos[$countMemo]['Memo']['id'] : NULL;
            $nextDataParentId = (!empty($memos[$countMemo]['Memo']['parent_id'])) ? $memos[$countMemo]['Memo']['parent_id'] : NULL;
    
            $created = $memo['MemoTracking']['created'];
            $reception = $this->requestAction('memos/reception_date/'.$nextDataMemoId);
    
            $datetime1 = new DateTime($reception);
            $datetime2 = new DateTime($created);
            $interval = $datetime1->diff($datetime2);
            
            $days = $interval->format('%a');
            $holidays = $this->requestAction('holidays/subtracted_days/'.strtotime($created).'/'.strtotime($reception)); 
    ?>
            <tr>
                <td><?php echo h('D'.$memo['Memo']['memo_number'].'-'.date('Y', strtotime($memo['Memo']['created']))); ?></td>
                <td><?php echo $created; ?></td>
                <td><?php echo (is_null($nextDataMemoId) OR is_null($nextDataParentId)) ? utf8_decode(__('No Information')) : $reception; ?></td>
                <td><?php echo empty($matters[$memo['Memo']['matter_id']]) ? utf8_decode(__('No Information')) : utf8_decode($matters[$memo['Memo']['matter_id']]); ?></td>
                <td><?php echo utf8_decode($this->requestAction('memos/find_owner/'.$memo['Memo']['id'])); ?></td>
                <td><?php echo utf8_decode($this->requestAction('memos/find_recipient/'.$memo['Memo']['id'])); ?></td>
                <td><?php echo (is_null($nextDataMemoId) OR is_null($nextDataParentId)) ? utf8_decode(__('No Information')) : utf8_decode($interval->format('%R'.($days - $holidays).' días , %h horas y %i minutos')); ?></td>
                <td><?php echo is_null($nextDataParentId) ? __('finalized') : __('in process'); ?></td>
            </tr>
    <?php endforeach; ?>
</table>