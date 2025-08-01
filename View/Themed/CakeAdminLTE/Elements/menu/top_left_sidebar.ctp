<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>
<!-- ADD THE CLASS sidedar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle user-menu" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li style="background-color:rgba(0,0,0,0)">
                            <ul style="padding-top:15px;padding-right:5px;font-size:15px;color:white">
                                <i class="fa fa-clock-o"></i>
                                <span class="timer"></span>
                            </ul>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning label_shunt"><?php echo count($this->requestAction('memoTrackings/alert_shunt')); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php

                                            $alertsShunt = $this->requestAction('memoTrackings/alert_shunt');

                                            if(empty($alertsShunt)):
                                                echo __('<li class="shunt"><a>Usted no tiene notificaciones pendientes.</a></li>');
                                            else:
                                                foreach($alertsShunt as $shunt): 
                                                    if(!empty($shunt['Memo']['id'])):
                                                        $iClass = ($shunt['MemoTracking']['created'] == $shunt['MemoTracking']['modified']) ? 'fa fa-warning text-yellow' : 'fa fa-check text-green';
                                        ?>
                                                        <li class="shunt" id="<?php echo $shunt['MemoTracking']['id']; ?>">
                                                            <a href="<?php echo Router::url('/memos/time_line/'.$shunt['Memo']['id'], true); ?>">
                                                                <i class="<?php echo $iClass; ?>"></i><?php echo __('the memo ').'D'.$shunt['Memo']['memo_number'].'-'.date('Y', strtotime($shunt['Memo']['created'])).__(' has been shunted');?>
                                                            </a><button type="button" class="btn btn-danger btn-flat alert-shunt"><i class="fa fa-close"></i></button>
                                                        </li>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <?php $thumbnailphoto = $this->Session->read('Auth.User.thumbnailphoto'); ?>

                                <?php echo $this->Html->image('../dist/img/digital.png', array('class' => 'user-image')); ?>

                                <span class="hidden-xs"><?php echo $this->requestAction('memos/find_user_username/'.$this->Session->read('Auth.User.username')); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <?php echo $this->Html->image('../dist/img/digital.png', array('class' => 'img-circle')); ?>
                                    <p>
                                        <?php echo $this->requestAction('memos/find_user_username/'.$this->Session->read('Auth.User.username')); ?><br>
                                        <small>
                                            <?php echo $this->requestAction('memos/find_title_username/'.$this->Session->read('Auth.User.username')); ?>
                                        </small>
                                        <small>
                                            <?php echo $this->requestAction('memos/find_department_username/'.$this->Session->read('Auth.User.username')); ?>
                                        </small>
                                        <small>Ministerio de la Mujer y la Equidad de Género</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?php echo $this->webroot.'users/logout'; ?>" class="btn btn-flat btn-danger"><?php echo __('Sign out'); ?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <!-- Control Sidebar Toggle Button -->

                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar" style="height: auto;">
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class=""><a href="<?php echo $this->Html->url('/manual', true); ?>" target="_blank"><i class="fa fa-info-circle"></i> <span>Manual de Usuario</span></a></li>
                    <li class=""><a href="<?php echo $this->Html->url('/memos/search', true); ?>" target="_blank"><i class="fa fa-search"></i> <span><?php echo __('Searcher'); ?></span></a></li>
                    <!--<li class=""><a href="<?php //echo $this->Html->url('/memos/search_report', true); ?>" target="_blank"><i class="fa fa-signal"></i> <span><?php echo __('Reportes Avanzados'); ?></span></a></li>-->
                    <?php 
                            $groupId = $this->Session->read('groupDB_id');
                            if($groupId === '1'): 
                        ?>

                    <li class="treeview">
                        <a>
                            <i class="fa fa-gears"></i>
                            <span><?php echo __('Panel Administrador'); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo $this->Html->url('/users', true); ?>" target="_blank"><i class="fa fa-users"></i><?php echo __('Agregar Usuario'); ?></a></li>
                            <li><a href="<?php echo $this->Html->url('/shares', true); ?>" target="_blank"><i class="fa fa-object-ungroup"></i><?php echo __('Compartir Memos'); ?></a></li>
                            <li><a href="<?php echo $this->Html->url('/subrogances', true); ?>" target="_blank"><i class="fa fa-user-plus"></i><?php echo __('Subrogancias'); ?></a></li>
                        </ul>
                    </li>
                    <?php 
                            endif;

                            if(($groupId === '4') OR ($groupId === '1')): 
                        ?>

                    <li class="treeview">
                        <a>
                            <i class="fa fa-folder-open-o"></i>
                            <span><?php echo __('Oficina de Partes'); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo $this->Html->url('/memos/parts_office', true); ?>"><i class="fa fa-plus-square-o"></i><?php echo __('Ingresos'); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <li class=""><a href="<?php echo $this->Html->url('/historials/index', true); ?>" target="_blank"><i class="fa fa-history"></i> <span><?php echo __('Historial de Unir Memos'); ?></span></a></li>
                    <!--<li class="treeview">
              <a href="">
                <i class="fa fa-area-chart"></i>
                <span>Reporte Trazabilidad</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: block;">
              <?php //foreach(range(2018, date('Y')) as $year): ?>
                    <li><a href="<?php //echo $this->Html->url('/memos/traceability/'.$year, true); ?>"><i class="fa fa-calendar-check-o"></i> <span><?php //echo $year; ?></span></a></li>
              <?php //endforeach; ?>    
              </ul>
            </li>-->
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Right side column. Contains the navbar and content of the page -->
            <section class="content-header">
                <h1>
                    <?php echo __('System'); ?> <?php echo __('Memorandum'); ?>
                </h1><br>
                Tu sesión finalizará en <b><span class="timer"></span></b>
                <ol class="breadcrumb">
                    <?php echo $this->element('breadcrumbs'); ?>
                </ol>
            </section>

            <section class="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </section>
            <div id="loader" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="box box-danger box-solid">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo __('Loading state'); ?></h3>
                        </div>
                        <div class="box-body">
                            <?php echo __('Please wait, the memo is being generated.'); ?>
                        </div>

                        <div class="overlay">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>

                    </div>
                </div>
            </div>
            <div id="logout_modal" class="modal modal-primary" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="box box-primary box-solid">
                        <div class="box-header">
                            <h3 class="box-title"><?php echo __('Alerta - Cierre de Sesión'); ?></h3>
                        </div>
                        <div class="box-body">
                            <?php echo __('Estimada/o, La sesión está a punto de expirar. Por favor, presione el botón "Continuar" para reactivar la sesión o solo cierre su sesión.'); ?>
                        </div>
                        <div class="modal-footer">
                            <button id="reset" type="button" class="btn btn-outline pull-left" data-dismiss="modal"><?php echo __('Continuar'); ?></button>
                            <button id="logout" type="button" class="btn btn-outline"><?php echo __('Cerrar Sesion'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <?php echo $this->element('sql_dump'); ?>
            </footer>
        </div>
        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">

        <div class="tab-pane active" id="control-sidebar-home-tab">
            <!-- Home tab content -->
            <div class="box-header">
                <div class="btn-group">
                    <?php
                        echo $this->Html->link(__('<i class="glyphicon glyphicon-list"></i> Listar'), array('controller' => 'requirements', 'action' => 'home'), array('class' => 'btn btn-linkedin', 'escape' => false)); 

                        echo $this->Html->link(__('<i class="glyphicon glyphicon-plus"></i> Crear'), array('controller' => 'requirements', 'action' => 'index'), array('class' => 'btn btn-linkedin', 'escape' => false)); 
                    ?>
                </div>    
            </div><br>
            <div class="box-body">             
                <table id="Requirements" style="width:100%;margin-top:-15px !important">
                    <thead>
                        <tr>
                            <th class="text-left"><h3 class="control-sidebar-heading"><?php echo __('Bandeja de Requerimientos'); ?></h3></th>
                            <th class="text-center"><?php echo 'Acción'; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($requirements as $requirement): ?>
                            <tr>
                                <td style="width:80%">
                                    <li style="list-style-type: none;">
                                        <a href="#">
                                            <h4 class="control-sidebar-subheading">
                                                <?php
                                                
                                                    $id = $requirement['Requirement']['id'];
                                                
                                                    $percentageQuery = $this->requestAction('milestones/percentage/'.$id);
                                                    
                                                    $percentage = (!empty($percentageQuery['Milestone']['percentage'])) ? $percentageQuery['Milestone']['percentage'] : 0;
                                                
                                                    if($percentage > 80):
                                                        $classSpan = 'label label-success pull-right';
                                                        $classDiv = 'progress-bar progress-bar-success';
                                                    elseif(($percentage > 40) AND ($percentage <= 80)):
                                                        $classSpan = 'label label-warning pull-right';
                                                        $classDiv = 'progress-bar progress-bar-warning';
                                                    else:
                                                        $classSpan = 'label label-danger pull-right';
                                                        $classDiv = 'progress-bar progress-bar-danger';
                                                    endif;
                                                
                                                    echo $requirement['Requirement']['name']; 
                                                ?>
                                                <span class="<?php echo $classSpan; ?>">
                                                    <?php 
                                                        echo $percentage.' %';
                                                    ?>
                                                </span>
                                            </h4>
                                            <div class="progress progress-xxs">
                                                <div class="<?php echo $classDiv; ?>" style="<?php echo 'width:'.$percentage.'%';?>"></div>
                                            </div>
                                        </a>
                                    </li>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        echo $this->Html->link(__('<i class="glyphicon glyphicon-search"></i>'), array('controller' => 'requirements', 'action' => 'index',$id), array('class' => 'btn btn-linkedin', 'escape' => false));
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>    
            <!-- /.control-sidebar-menu -->
        </div>
    
</aside>
<!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->

    </div>
    <!-- ./wrapper -->
</body>

</html>
<script>
    $(".alert-shunt").click(function() {
        var id = $(this).closest('li').attr('id');
        var valShunt = $('.label_shunt').html();
        var calcShunt = parseInt(valShunt) - 1;

        $.ajax({
            type: 'POST',
            dataType: 'jsonp',
            url: '<?php echo $this->Html->webroot("memoTrackings/delete_alert_shunt/"); ?>' + id,
        });

        $('#' + id).hide();
        $(".label_shunt").text(calcShunt);

    });
    
    $(document).ready(function() {

        var url = <?php echo json_encode($this->Html->url('/users/logout', true)); ?>;

        //Contador Regresivo

        String.prototype.toHHMMSS = function () {
            var sec_num = parseInt(this, 10); // don't forget the second parm
            var hours = Math.floor(sec_num / 3600);
            var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
            var seconds = sec_num - (hours * 3600) - (minutes * 60);

            if (hours < 10) {
                hours = "0" + hours;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            if (seconds < 10) {
                seconds = "0" + seconds;
            }
            var time = hours + ':' + minutes + ':' + seconds;
            return time;
        }

        //var count = '28800'; // 8 horas

        if (localStorage.getItem("counter")) {
            count = localStorage.getItem("counter");
        } else {
            var count = '14400'; // 3.600 (1 hora)
        }
        
        var counter = setInterval(timer, 1000);

        function timer() {

            if (parseInt(count) <= 0) {
                clearInterval(counter);
                window.location.href = url;
                return;
            }else if(parseInt(count) == 1800){ // Llama para renovar la sesion, 1.800 = 30 min
                $('#logout_modal').modal('show');
            }
            var temp = count.toHHMMSS();
            count = (parseInt(count) - 1).toString();
            localStorage.setItem("counter", count);

            $('.timer').html(temp);
        }

        $("#reset").click(function() {

            var count = '14400';

            localStorage.setItem("counter", count);
            clearInterval(counter);

            $.ajax({
                type: 'POST',
                dataType: 'jsonp',
                url: '<?php echo $this->Html->webroot("users/logout/1"); ?>'
            });

        });

        $("#logout").click(function() {

            localStorage.clear();
            window.location.href = url;

        });

    });

</script>
