<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">&nbsp;</h4>
</div>
<div class="modal-body">
    <!-- info row -->
    <div class="row">
        <div class="col-sm-3">  
            <span class="input-group-btn input-group">  
                <label><p class="lead"><?php echo __('Memo') . ' N°1'; ?></p></label>
                <?php 
                    echo $this->Form->create('Memo', array('role' => 'form'));
                    echo $this->Form->input('first', array('class' => 'form-control', 'label' => false, 'required' => true, 'style' => 'width:100px', 'placeholder' => __('Ej: 123-2023'))); 
                ?>
                <button type="button" class="btn btn-primary btn-flat online1"><?php echo __('Previsualizar'); ?></button>
            </span>

            <span class="input-group-btn input-group"> 
                <label><p class="lead"><?php echo __('Memo') . ' N°2'; ?></p></label>
                <?php echo $this->Form->input('second', array('class' => 'form-control', 'label' => false, 'required' => true, 'style' => 'width:100px', 'placeholder' => __('Ej: 123-2023'))); ?>
                <button type="button" class="btn btn-primary btn-flat online2"><?php echo __('Previsualizar'); ?></button>
            </span>
            <label><p class="lead"></p></label>
            <?php 
                echo $this->Form->submit(__('Unir Memorándums'), array('class' => 'btn btn-large btn-primary')); 
                echo $this->Form->end();
            ?>
        </div>
        <!-- /.col -->
        <div class="col-sm-9">
            <div id="memoDetailMerge"><div class="text-center"><pre style="font-weight: 600;"><?php echo __('Para previsualizar un memorámdum. Por favor, ingrese un número.'); ?></pre></div></div>
        </div>
        <!-- /.col -->
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __('Close'); ?></button>
</div>
<script>
    $(document).ready(function() {

        $('.online1').click(function() {
            var memo = $("#MemoFirst").val();
            $("#memoDetailMerge").load("<?php echo $this->Html->url(array('action' => 'view_detail'), true) ?>", {
                memo_number: memo,
                menu : true
            });
        });
        
        $('.online2').click(function() {
            var memo = $("#MemoSecond").val();
            $("#memoDetailMerge").load("<?php echo $this->Html->url(array('action' => 'view_detail'), true) ?>", {
                memo_number: memo,
                menu : true
            });
        });
    });
</script>