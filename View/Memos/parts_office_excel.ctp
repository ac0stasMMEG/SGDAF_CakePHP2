<?php 
    header("Pragma: public");
    header("Expires: 0");
    $filename = "memos_periodo_".$year.".xls";
    header("Content-type: application/x-msdownload");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

?>
<table border="1">
    <thead>
        <tr>
            <th><b><?php echo __('Numero'); ?></b></th>
            <th><b><?php echo __('Oficina Partes'); ?></b></th>
            <th><b><?php echo __('Addressee'); ?></b></th>
            <th><b><?php echo __('Reference'); ?></b></th>
            <th><b><?php echo __('Numero Externo'); ?></b></th>
            <th><b><?php echo __('Numero Interno'); ?></b></th>
            <th><b><?php echo __('Fecha Creacion'); ?></b></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($memos as $memo): ?>
        <tr>
            <td><?php echo 'D'.$memo['Memo']['memo_number'].'-'.$memo['Memo']['year']; ?></td>
            <td><?php echo  utf8_decode($this->requestAction('memos/find_owner/'.$memo['Memo']['id'])); ?></td>
            <td><?php echo  utf8_decode($this->requestAction('memos/find_addressees/'.$memo['Memo']['id'])); ?></td>
            <td><?php echo  utf8_decode($memo['Memo']['reference']); ?></td>
            <td><?php echo $memo['Memo']['external_office']; ?></td>
            <td><?php echo $memo['Memo']['internal_office']; ?></td>
            <td><?php echo date("d-m-Y H:i:s", strtotime($memo['Memo']['created'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
