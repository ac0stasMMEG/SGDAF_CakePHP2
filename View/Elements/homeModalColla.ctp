<!-- DETALLE DE REQUERIMIENTO -->
<!-- MODAL NUEVO -->
<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalScrollable-<?php echo $idRequirement ?>">Ver</button>
<div class="modal fade modal-lg" id="modalScrollable-<?php echo $idRequirement ?>" tabindex="-1" aria-labelledby="modalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="modalScrollableTitle" title="<?php echo $requirement['Requirement']['name']; ?>">Detalle Requerimiento: <?php echo substr($requirement['Requirement']['name'], 0, 60) ?></h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <?php
                $countMilestoneTrakingColla = 0;
                $nHito = count($resultColla) + 1;
                foreach ($resultColla as $requirementTrackingColla) {
                ?>
                    <ul class="timeline pt-3">
                        <!-- ****************** DETALLE REQUERIMIENTO ****************** -->
                        <?php
                        if ($countMilestoneTrakingColla == 0) { ?>
                            <li class="timeline-item pb-4 timeline-item-success border-left-dashed">
                                <span class="timeline-indicator-advanced timeline-indicator-success">
                                    <i class="bx bx-message"></i>
                                </span>
                            <?php $countMilestoneTrakingColla = 1;
                        } else { ?>
                            <li class="timeline-item pb-4 timeline-item-dark border-left-dashed">
                                <span class="timeline-indicator-advanced timeline-indicator-dark">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                            <?php
                        } ?>
                            <div class="timeline-event">
                                <?php
                                $nHito = --$nHito;
                                foreach ($requirementTrackingColla as $id => $dataColla) {
                                    if ($dataColla['RequirementTracking']['requirement_tracking_type_id'] == '65c52553-eef0-4651-9175-3df8c26b1ae0') { ?>
                                        <div class="timeline-header border-bottom mb-3">
                                            <h5 class="mb-0"></h5>
                                            <span class="text-muted"><i>Fecha de Creación: </i>
                                            <?php echo $dataColla['RequirementTracking']['created']; ?></span>
                                        </div>
                                        <ul class="list-group list-group-flush list-unstyled">
                                            <li class="timeline-item timeline-item-transparent border-info">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <div class="ps-3 mb-3">
                                                            <span class="text-muted mb-1">
                                                                <h6 class="mb-1"><i><b>Hito:</b></i></h6>
                                                                <p>
                                                                    <?= $dataColla['Milestone']['name'] ?>
                                                                </p>
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="ps-3 mb-3">
                                                            <span class="text-muted mb-1">
                                                                <h6 class="mb-1"><i><b>Creado por:</b></i></h6>
                                                                <p>
                                                                    <?= $this->requestAction('memos/find_user_username/' . $dataColla['RequirementTracking']['creator']); ?>
                                                                </p>
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="ps-3 mb-3">
                                                            <span class="text-muted mb-1">
                                                                <h6 class="mb-1"><i><b>Detalle:</b></i></h6>
                                                                <p>
                                                                    <!-- DETALLE DEL REQUERIMIENTO -->
                                                                    <?= $dataColla['RequirementTracking']['description'] ?>
                                                                    <!-- // DETALLE DEL REQUERIMIENTO -->
                                                                </p>
                                                            </span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                                                <div class="d-flex flex-wrap align-items-center"></div>
                                            </li>
                                        </ul>
                                        <div class="timeline-header border-bottom mb-3">
                                            <h5 class="mb-0"></h5>
                                            <span class="text-muted"><i>Tareas Agregadas: </i><?php #echo count($dataColla['RequirementTracking']['requirement_tracking_type_id']); 
                                                                                                ?></span>
                                        </div>
                                    <?php
                                    } ?>

                                    <ul class="timeline pb-0 mb-0">
                                        <?php #VALIDAMOS TAREA ADJUNTAR DOCUMENTO
                                        if ($dataColla['RequirementTracking']['requirement_tracking_type_id'] == '65b951a7-c290-4159-82df-3df80a220016') { ?>
                                            <li class="timeline-item timeline-item-transparent border-primary">
                                                <div class="ps-3 mb-4">
                                                    <h6 class="border-top-0 mt-3">
                                                        <b>Tarea:</b> <i>Adjuntar Documento</i>
                                                    </h6>
                                                    <p>
                                                        <span class="text-muted mb-1">
                                                            <!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
                                                            <p><i><b>Documento:</b></i>
                                                                <a target="_blank" href="<?php echo $this->Html->url('/files_requirements/' . $dataColla['RequirementAttachment']['id'] . '/' . $dataColla['RequirementAttachment']['name']); ?>"><button type="button" class="btn btn-gray"><i class="fa fa-cloud-download"></i> <?php echo $dataColla['RequirementAttachment']['name'] ?></button></a>
                                                            </p>
                                                            <!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
                                                    </p> </span>

                                                </div>
                                            </li>
                                        <?php } ?>

                                        <?php #VALIDAMOS TAREA SOLICITUD DE APROBACION
                                        if ($dataColla['RequirementTracking']['requirement_tracking_type_id'] == '65c3a473-06c0-4bef-b594-3df8c26b1ae0') { ?>
                                            <li class="timeline-item timeline-item-transparent border-primary">
                                                <div class="ps-3 mb-4">
                                                    <h6 class="border-top-0 mt-3">
                                                        <i><b>Tarea: </b>Solicitud de Aprobacion</i>
                                                        <!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
                                                        <?php if ($dataColla['RequirementTracking']['approver'] == $usuario) { ?>
                                                            <?php if (is_null($dataColla['RequirementTracking']['approval_status'])) { ?>
                                                                <button type="button" data-approv="1" id="<?= $dataColla['RequirementTracking']['id'] ?>" class="approv btn btn-sm btn-success"><i class='bx bx-check'></i></button>
                                                                <button type="button" data-approv="0" id="<?= $dataColla['RequirementTracking']['id'] ?>" class="approv btn btn-sm btn-danger"> <i class='bx bx-x'> </i></button>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        </p>
                                                        <p><i><b>Aprobador: </b><?= $this->requestAction('memos/find_user_username/' . $dataColla['RequirementTracking']['approver']) ?></i></p>
                                                        <p>
                                                            <i>
                                                                <b>Estado: </b>
                                                                <span id="<?= 'p_' . $dataColla['RequirementTracking']['id'] ?>">
                                                                    <?php if (is_null($dataColla['RequirementTracking']['approval_status'])) { ?>
                                                                        <span>En Aprobación</span>
                                                                    <?php } elseif ($dataColla['RequirementTracking']['approval_status'] == 0) { ?>
                                                                        <span class="text-danger">Rechazado</span>
                                                                    <?php } else { ?>
                                                                        <span class="text-success">Aprobado</span>
                                                                    <?php } ?>
                                                                </span></i>
                                                        </p>
                                                        <!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
                                                    </h6>
                                                </div>
                                            </li>
                                        <?php } ?>

                                        <?php #VALIDAMOS TAREA ADJUNTAR MEMO DIGITAL
                                        if ($dataColla['RequirementTracking']['requirement_tracking_type_id'] == '65b94f7c-fb7c-4c3c-a2b6-3df80a220016') { ?>
                                            <li class="timeline-item timeline-item-transparent border-primary">
                                                <div class="ps-3 mb-4">
                                                    <h6 class="border-top-0 mt-3"><i><b>Tarea:</b> Adjuntar Memo Digital</i></h6>
                                                    <p>
                                                        <span class="text-muted mb-1">
                                                            <!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
                                                            <p><i><b>Número de memo: </i></b>
                                                                <a href="/requirements/pdf/<?= $dataColla['RequirementTracking']['memo_number'] ?>.pdf" class="btn btn-gray" target="_blank"><?= $dataColla['RequirementTracking']['memo_number'] ?></a>
                                                            </p>
                                                            <!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
                                                        </span>
                                                    </p>
                                                </div>
                                            </li>
                                        <?php } ?>

                                        <?php #VALIDAMOS TAREA COLABORADOR
                                        if ($dataColla['RequirementTracking']['requirement_tracking_type_id'] == '65b94f54-1c84-4ee4-863c-3df80a220016') { ?>
                                            <li class="timeline-item timeline-item-transparent border-primary">
                                                <div class="ps-3 mb-4">
                                                    <h6 class="border-top-0 mt-3">
                                                        <i><b>Tarea:</b> Colaborador</i>
                                                    </h6>
                                                    <p>
                                                        <span class="text-muted mb-1">
                                                            <!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
                                                            <p><b><i>Se agrega como colaborador a: </i></b></p>
                                                            <ul>
                                                                <?php
                                                                $nombreCollas = explode(',', $dataColla['RequirementTracking']['collaborator']);
                                                                foreach ($nombreCollas as $key => $value) {
                                                                    $nombreColla = explode('@', $value);
                                                                    echo '<li>' . $this->requestAction('memos/find_user_username/' . $nombreColla[0]) . '</li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                            <!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
                                                        </span>
                                                    </p>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php
                                } ?> <!-- endforeach -->
                            </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                                <div class="d-flex flex-wrap align-items-center"></div>
                            </li>
                    </ul>
                <?php } ?>
            </div>
            <!-- ****************** // DETALLE REQUERIMIENTO ****************** -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a type="button" href="index/<?php echo $idRequirement ?>" class="btn btn-primary text-truncate">Registrar Hito</a>
            </div>
        </div>
    </div>
</div>
<!-- // MODAL NUEVO -->
<script>
    /* VALIDAMOS LA APROBACIÓN */
    $(".approv").click(function() {
        var id = $(this).attr('id');
        var approv = $(this).attr("data-approv");

        $.ajax({
            type: 'POST',
            dataType: 'jsonp',
            url: '<?php echo $this->Html->webroot("requirements/requirement_approval/"); ?>' + id + '/' + approv
        });

        /* alert(approv); */
        /* $('#' + id).prop("disabled", true); */
        /* $('#' + id).hide(); */

        $('.approv').hide();

        /* var approv = $(this).attr("data-approv"); */

        if (approv == 1) {
            $('#p_' + id).text('Aprobado correctamente');
            $('#p_' + id).addClass(" text-success ");
        } else {
            $('#p_' + id).text('Aprobación denegada');
            $('#p_' + id).addClass(" text-danger ");
        }

    });
</script>