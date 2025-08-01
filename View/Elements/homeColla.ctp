<table class="datatables-ajax table table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Referencía</th>
            <th>Estado</th>
            <th>Creador</th>
            <th>Progreso</th>
            <th>Historial</th>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0">
        <?php
        foreach ($requiColla as $colla) : /* debug( $colla ); */ ?>
            <tr>
                <td>R<?= $colla['Requirement']['requirement_number'] ?></td>
                <td title="<?= $colla['Requirement']['name'] ?>">
                    <?= $colla['Requirement']['name'] ?>
                </td>
                <!-- <td><?= $colla['Requirement']['status'] ?></td> -->
                <td> <!-- ESTADO DEL REQUERIMIENTO -->
                    <?php
                    switch ($colla['Requirement']['status']) {
                        case 1:
                            echo '<span class="badge bg-label-primary rounded-pill text-uppercase">';
                            echo 'INICIADO';
                            echo '</span>';
                            break;
                        case 2:
                            echo '<span class="badge bg-label-warning rounded-pill text-uppercase">';
                            echo 'EN PROCESO';
                            echo '</span>';
                            break;
                        case 3:
                            echo '<span class="badge bg-label-dark rounded-pill text-uppercase">';
                            echo 'DESESTIMADO?';
                            echo '</span>';
                            break;
                        case 4:
                            echo '<span class="badge bg-label-danger rounded-pill text-uppercase">';
                            echo 'DEVUELTO';
                            echo '</span>';
                            break;
                        case 5:
                            echo '<span class="badge bg-label-success rounded-pill text-uppercase">';
                            echo 'DERIVADO';
                            echo '</span>';
                            break;
                        case 6:
                            echo '<span class="badge bg-label-success rounded-pill text-uppercase">';
                            echo 'FINALIZADO';
                            echo '</span>';
                            break;
                    };
                    ?>
                </td>
                <td><?= $colla['Requirement']['creator'] ?></td>
                <td title="<?= $colla['Requirement']['percentage'] ?> %"> <!-- PORCENTAJE DEL REQUERIMIENTO -->
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <div class="progress w-100" style="height:10px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= $colla['Requirement']['percentage'] ?>%" aria-valuenow="<?= $colla['Requirement']['percentage'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <small class="fw-medium"><?= $colla['Requirement']['percentage'] ?> %</small>
                </td>
                <td>
                    <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal" data-bs-target="#modalScrollableColla-<?= $colla['Requirement']['id'] ?>">Ver</button>
                    <div class="modal fade modal-lg" id="modalScrollableColla-<?= $colla['Requirement']['id'] ?>" tabindex="-1" aria-labelledby="modalScrollableColla" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalScrollableColla" title="<?= $colla['Requirement']['name']; ?>"><!-- Detalle Requerimiento: --> <? # substr($colla['Requirement']['name'], 0, 50) 
                                                                                                                                                                    ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <?php #VISTA DE REQUERIMIENTOS DEL COLABORADOR
                                    echo $this->requestAction('/requirements/homeModalColla/' . $requirement['Requirement']['id']);
                                    ?>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <a type="button" href="index/<?= $colla['Requirement']['id'] ?>" class="btn btn-primary text-truncate">Registrar Hito</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>