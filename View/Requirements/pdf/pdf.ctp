<?php
    $i = 1;
    $countPDF = count($leadershipMemo);
    if (!empty($leadershipMemo)) :
        foreach ($leadershipMemo as $memo) : ?>
            <div>
                <?php echo $this->Html->image('logo_memo.jpg'); ?>
            </div>
            <br><br>
            <div class="title"><br>
                <h1><?php echo __('INTERNAL MEMO'); ?> N° <?php echo h('D' . $memo['Memo']['memo_number'] . ' - ' . $memo['Memo']['year']); ?></h1>
            </div>
            <br><br>
            <table class="detail">                
                    <tr>
                        <td><?php echo __('From'); ?></td>
                        <td>:</td>
                        <td>
                            <?php foreach ($userTracking as $tracking) : ?>
                                <?php if (($tracking['MemoTracking']['memo_tracking_type_id'] == "5ba4f0ba-ec28-471e-af3e-2630c26b1ae0") and ($tracking['MemoTracking']['viewed'] == '0') and ($tracking['Memo']['id'] == $memo['Memo']['id'])) : // Propietario 
                                ?>
                                    <?php
                                    $approveUser = $tracking['MemoTracking']['to'];
                                    echo $this->requestAction('memos/find_user_username/' . $tracking['MemoTracking']['to']);
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo __('To'); ?></td>
                        <td>:</td>
                        <td>
                            <?php foreach ($userTracking as $tracking) : ?>
                                <?php if (($tracking['MemoTracking']['memo_tracking_type_id'] == "5b8588b3-667c-4f97-a1ec-1f68c26b1ae0") and ($tracking['MemoTracking']['viewed'] == '0') and ($tracking['Memo']['id'] == $memo['Memo']['id'])) : // Aprobación 
                                ?>
                                    <?php
                                    echo $this->requestAction('memos/find_user_username/' . $tracking['MemoTracking']['to']) . '<br>';
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
                
            </table>

            <hr>

            <?php echo str_replace('data:image/png;base64', 'data://text/plain;base64', $memo['Memo']['description']); ?>

            <div class="sign">
                <?php

                $groupId = $this->requestAction('users/find_group/' . $approveUser);

                if (empty($memo['Subrogance']['foot_signature'])) :
                    echo $this->Html->image('../mark/' . strtolower($approveUser) . '.png');
                else :
                    echo $this->Html->image('../mark/' . $memo['Subrogance']['file_name']);
                endif;

                echo $this->Html->image('../sign/' . strtolower($approveUser) . '.png');

                ?><br>
                <?php echo strtoupper($this->requestAction('memos/find_user_username/' . $approveUser)); ?><br>
                <?php
                if (empty($memo['Subrogance']['foot_signature'])) :
                    echo strtoupper($this->requestAction('memos/find_title_username/' . $approveUser));
                else :
                    echo strtoupper($memo['Subrogance']['foot_signature']);
                endif;
                ?><br>
                MINISTERIO DE LA MUJER Y LA EQUIDAD DE GÉNERO
            </div><br>
            <?php echo $memo['Memo']['initial_responsibility']; ?><br>
            <p class="istribution"><?php echo __('Distribution'); ?>:</p>
            <?php foreach ($userTracking as $tracking) : ?>
                <?php if (($tracking['MemoTracking']['memo_tracking_type_id'] == "5b8588b3-667c-4f97-a1ec-1f68c26b1ae0") and ($tracking['MemoTracking']['viewed'] == '0') and ($tracking['Memo']['id'] == $memo['Memo']['id'])) : // Aprobación 
                ?>
                    <li><?php echo $this->requestAction('memos/find_user_username/' . $tracking['MemoTracking']['to']); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
            <footer>
                <?php echo $this->Html->image('footer_memo2.jpg'); ?>
            </footer>
            <?php if ($i <> $countPDF) : ?>
                <div class="page_break"></div>
                
            <?php endif; ?>
            <?php $i++; ?>
        <?php endforeach; ?>
        
    <?php else : ?>

        <div>
            <?php echo $this->Html->image('logo_memo.jpg'); ?>
        </div>
        <br><br>
        <h1><?php echo __('The memorandum still does not have a response from the head'); ?></h1>

    <?php endif; ?>