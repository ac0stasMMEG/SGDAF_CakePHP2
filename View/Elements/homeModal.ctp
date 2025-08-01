<!-- DETALLE DE REQUERIMIENTO -->
<!-- MODAL DETALLE -->
<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalScrollable-<?php echo $idRequirement ?>">
	<i class='bx bx-search-alt-2' title="DETALLE"></i>
	DETALLE
	<!-- Detalle -->
</button>
<div class="modal fade modal-xl" id="modalScrollable-<?php echo $idRequirement ?>" tabindex="-1" aria-labelledby="modalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<?php
				$countMilestoneTraking = 0;
				$nHito = count($result) + 1;
				foreach ($result as $requirementTracking) {
				?>
					<ul class="timeline pt-3">
						<!-- ****************** DETALLE REQUERIMIENTO ****************** -->
						<?php
						if ($countMilestoneTraking == 0) { ?>
							<li class="timeline-item pb-4 timeline-item-success border-left-dashed">
								<span class="timeline-indicator-advanced timeline-indicator-success">
									<i class="bx bx-message"></i>
								</span>
							<?php $countMilestoneTraking = 1;
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
								$vuelta = 0;
								$registro = 0;
								#debug($requirementTracking);
								foreach ($requirementTracking as $id => $data) {
									#$vuelta = ++$vuelta;
									$registro = ++$registro;
									if ($data['RequirementTracking']['requirement_tracking_type_id'] == '65c52553-eef0-4651-9175-3df8c26b1ae0') { ?>
										<div class="timeline-header border-bottom mb-3">
											<h5 class="mb-0">Registro: #<?= $nHito; ?></h5>
											<span class="text-muted"><i>Fecha de Creación: </i>
												<?php echo $data['RequirementTracking']['created']; ?></span>
										</div>
										<ul class="list-group list-group-flush list-unstyled">
											<li class="timeline-item timeline-item-transparent border-info">
												<ul class="list-unstyled">
													<li>
														<div class="ps-3 mb-3">
															<span class="text-muted mb-1">
																<h6 class="mb-1"><i><b>Nombre o Referencía:</b></i></h6>
																<p>
																	<?= $data['Requirement']['name'] ?>
																</p>
															</span>
														</div>
													</li>
													<li>
														<!-- <div class="ps-3 mb-3">
															<span class="text-muted mb-1">
																<h6 class="mb-1"><i><b>Tarea:</b></i></h6>
																<p>
																	<?php
																	for ($i = 0; $i < $processTasksModalCount; $i++) {
																		#pr($processTasksModal['RequirementProcess']);
																		if ($processTasksModal['RequirementProcessTask'][$i]['id'] == $data['RequirementTracking']['requirement_process_tasks_id']) {
																			echo $processTasksModal['RequirementProcessTask'][$i]['name'];
																		}
																	}
																	?>
																</p>
															</span>
														</div> -->
													</li>
													<li>
														<div class="ps-3 mb-3">
															<span class="text-muted mb-1">
																<h6 class="mb-1"><i><b>Creado por:</b></i></h6>
																<p>
																	<?= $this->requestAction('memos/find_user_username/' . $data['RequirementTracking']['creator']); ?>
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
																	<?= $data['RequirementTracking']['description'] ?>
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
											<span class="text-muted"><i>Elementos agregados:</i>
												<?php #echo count($data['RequirementTracking']['requirement_tracking_type_id']);
												?>
											</span>
										</div>
									<?php } ?>

									<ul class="timeline pb-0 mb-0">

										<?php #VALIDAMOS TAREA ADJUNTAR MEMO DIGITAL
										if ($data['RequirementTracking']['requirement_tracking_type_id'] == '65b94f7c-fb7c-4c3c-a2b6-3df80a220016') { ?>
											<li class="timeline-item timeline-item-transparent border-primary">
												<!-- <li> -->
												<div class="ps-3 mb-4">
													<h6 class="border-top-0 mt-3"><i><b>Memos digitales referenciados:</b></i></h6>
													<p>
														<span class="text-muted mb-1">
															<!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
															<ul class="text-muted">
																<?php
																$memos = explode(',', $data['RequirementTracking']['memo_number']);
																$nMemos = count($memos);
																for ($i = 0; $i < $nMemos - 1; $i++) {
																	if ($memos[$i] != '') {
																		$memoExplode = explode('-', $memos[$i]);
																		$memoNumber = $memoExplode[0];
																		$memoYear   = $memoExplode[1];
																		$AttachMemos = $this->requestAction('requirements/searchIdMemos/' . $memoNumber . '/' . $memoYear);
																		$acceptedReception = $this->requestAction('requirements/acceptedReception/' . $memoNumber . '/' . $memoYear);
																		$supplierRatings = $this->requestAction('requirements/supplierRatings/' . $memoNumber . '/' . $memoYear); ?>
																		<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0 mb-1">
																			<div class="input-group input-group-md">
																				<span id="<?= $memos[$i] ?>" onclick="obtenerNumeroMemo('<?= $memos[$i] ?>')" class="input-group-text" >
																					<a href="#" class="btn btn-default btn-sm"><i class='bx bx-clipboard'></i><a>
																				</span>
																				<a href="/requirements/pdf/<?= $memos[$i] ?>.pdf" class="btn btn-primary btn-sm" target="_blank"><p id="memo<?= $memos[$i] ?>"><?= $memos[$i] ?></p></a>

																				<!-- Botones con IDs -->
    																			
																				<script>
																					// Función que recibe el ID del botón y muestra un resultado
																					function obtenerNumeroMemo(idBoton) {
																						const resultado = document.getElementById('resultado');
																						navigator.clipboard.writeText(idBoton);
																					}
																				</script>
																			</div>
																		</li>
																		<?php if (count($AttachMemos) > 0) { ?>
																			<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0 mb-1">
																				<div class="card">
																					<h5 class="card-header">Documentos Adjuntos</h5>
																					<!-- <span>Documentos Adjuntos</span> -->
																					<div class="card-body">
																						<div class="table-responsive">
																							<table class="table table-sm table-bordered table-hover">
																								<thead>
																									<tr>
																										<th width="65%">Nombre</th>
																										<th width="25%">Fecha Creación</th>
																									</tr>
																								</thead>
																								<tbody>
																									<?php if ($acceptedReception != '') {  ?>
																										<tr>
																										<td><a target="_blank" href="https://qasgdaf.minmujeryeg.gob.cl/accepted_receptions/pdf/<?= $acceptedReception ?>.pdf">RECEPCION CONFORME</a></td>
																										<td><a download="<?= $acceptedReception ?>.pdf" href="https://qasgdaf.minmujeryeg.gob.cl/accepted_receptions/pdf/<?= $acceptedReception ?>.pdf"><i class='bx bx-printer'></i></a></td>
																										</tr>
																									<?php }  ?>
																									<?php if ($supplierRatings != '') {  ?>
																										<tr>
																									<td><a target="_blank" href="https://qasgdaf.minmujeryeg.gob.cl/supplier_ratings/pdf/<?= $supplierRatings ?>.pdf">CALIFICACION PROVEEDOR</a></td>
																									<td><a download="<?= $supplierRatings ?>.pdf" href="https://qasgdaf.minmujeryeg.gob.cl/supplier_ratings/pdf/<?= $supplierRatings ?>.pdf"><i class='bx bx-printer'></i></a></td>
																										</tr>
																									<?php }  ?>
																									<?php
																									foreach ($AttachMemos as $key => $value) { ?>
																										<tr>
																											<td><a title="Número Memo" href="https://digital.minmujeryeg.gob.cl/files/<?= $value['Attachment']['id'] . '/' . $value['Attachment']['name'] ?>" target="_blank"><?= strtoupper($value['Attachment']['name']) ?></a></td>
																											<td><?= $value['Attachment']['created'] ?></td>
																										</tr>
																									<?php } ?>
																								</tbody>
																							</table>
																						</div>
																					</div>
																				</div>
																			</li>
																		<?php } ?>
																<?php }
																} ?>
															</ul>
															<!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
														</span>
													</p>
												</div>
											</li>
										<?php } ?>

										<?php #VALIDAMOS TAREA ADJUNTAR DOCUMENTO
										if ($data['RequirementTracking']['requirement_tracking_type_id'] == '65b951a7-c290-4159-82df-3df80a220016') { ?>
											<!-- <li class="timeline-item timeline-item-transparent border-primary"> -->
											<li class="timeline-item timeline-item-transparent border-primary">
												<div class="ps-3 mb-4">
													<?php
													if ($vuelta < 1) {
														echo '<h6 class="border-top-0 mt-3"><i><b>Documentos adjuntos: </b></i></h6>';
														$vuelta++;
													} ?>
													<ul>
														<span class="text-muted mb-1">
															<!-- <li> -->
															<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
																<!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
																
																<div class="input-group input-group-md">
																	<span class="input-group-text">
																		<i class='bx bx-paperclip'></i>
																	</span>
																	<a class="btn btn-primary btn-sm" target="_blank" title="Documento Adjunto" href="<?php echo $this->Html->url('/files_requirements/' . $data['RequirementAttachment']['id'] . '/' . $data['RequirementAttachment']['name']); ?>">
																		<?php echo strtoupper($data['RequirementAttachment']['name']); ?>
																	</a>
																	<span class="input-group-text">
																		<i class='bx bxs-file-pdf'></i>
																	</span>
																</div>

																<!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
															</li>
														</span>
													</ul>
												</div>
											</li>
										<?php } $vuelta = 0; ?>



										<?php #VALIDAMOS TAREA CARETA OFERENTES
										if ($data['RequirementTracking']['requirement_tracking_type_id'] == '66f43108-daa8-4f8e-b56f-39a40a320009') { ?>
											<li class="timeline-item timeline-item-transparent border-primary">
												<div class="ps-3 mb-4">
													<?php
													if ($vuelta < 1) {
														echo '<h6 class="border-top-0 mt-3"><i><b>Link Carpeta Oferentes: </b></i></h6>';
														$vuelta++;
													} ?>
													<ul>
														<span class="text-muted mb-1">
															<!-- <li> -->
															<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
																<!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
																<div class="input-group input-group-md">
																	<span class="input-group-text">
																	<i class='bx bx-link-external'></i>
																	</span>																	
																	<a class="btn btn-primary btn-sm" style="color:white;" href="<?php echo strtoupper($data['RequirementTracking']['description']); ?>" target="_blank" noopener>
																		OneDrive
																	</a>
																	<span class="input-group-text">
																	<i class='bx bx-clipboard' ></i>
																	</span>
																</div>
																<!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
															</li>
														</span>
													</ul>
												</div>
											</li>
										<?php } ?>

										<?php #VALIDAMOS TAREA ORDEN DE COMPRA
										if ($data['RequirementTracking']['requirement_tracking_type_id'] == '66f430e5-6048-4d68-976c-39a50a320009') { ?>
											<li class="timeline-item timeline-item-transparent border-primary">
												<div class="ps-3 mb-4">
													<?php
													if ($vuelta < 1) {
														echo '<h6 class="border-top-0 mt-3"><i><b>Número Orden de Compra: </b></i></h6>';
														$vuelta++;
													} ?>
													<ul>
														<span class="text-muted mb-1">
															<!-- <li> -->
															<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
																<!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
																<div class="input-group input-group-md">
																	<span class="input-group-text">
																	
																	</span>																	
																	<a class="btn btn-primary btn-sm" style="color:white;">
																		<?php echo strtoupper($data['RequirementTracking']['description']); ?>
																	</a>
																	<span class="input-group-text">
																	<i class='bx bx-clipboard' ></i>
																	</span>
																</div>
																<!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
															</li>
														</span>
													</ul>
												</div>
											</li>
										<?php } ?>

										<?php #VALIDAMOS TAREA FOLIO TESORERIA
										if ($data['RequirementTracking']['requirement_tracking_type_id'] == '66f4323b-db94-4060-8361-3db10a320009') { ?>
											<li class="timeline-item timeline-item-transparent border-primary">
												<div class="ps-3 mb-4">
													<?php
													if ($vuelta < 1) {
														echo '<h6 class="border-top-0 mt-3"><i><b>Número Folio Tesoreria: </b></i></h6>';
														$vuelta++;
													} ?>
													<ul>
														<span class="text-muted mb-1">
															<!-- <li> -->
															<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
																<!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
																<div class="input-group input-group-md">
																	<span class="input-group-text">
																	
																	</span>																	
																	<a class="btn btn-primary btn-sm" style="color:white;">
																		<?php echo strtoupper($data['RequirementTracking']['description']); ?>
																	</a>
																	<span class="input-group-text">
																	<i class='bx bx-clipboard' ></i>
																	</span>
																</div>
																<!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
															</li>
														</span>
													</ul>
												</div>
											</li>
										<?php } ?>


										<?php #VALIDAMOS TAREA FOLIO PRESUPUESTARIO
										if ($data['RequirementTracking']['requirement_tracking_type_id'] == '66f41a32-0820-42a0-a24a-3ccc0a320009') { ?>
											<li class="timeline-item timeline-item-transparent border-primary">
												<div class="ps-3 mb-4">
													<?php
													if ($vuelta < 1) {
														echo '<h6 class="border-top-0 mt-3"><i><b>Número Folio Presupuestario: </b></i></h6>';
														$vuelta++;
													} ?>
													<ul>
														<span class="text-muted mb-1">
															<!-- <li> -->
															<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
																<!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
																<div class="input-group input-group-md">
																	<span class="input-group-text">
																	
																	</span>																	
																	<a class="btn btn-primary btn-sm" style="color:white;">
																		<?php echo strtoupper($data['RequirementTracking']['description']); ?>
																	</a>
																	<span class="input-group-text">
																	<i class='bx bx-clipboard' ></i>
																	</span>
																</div>
																<!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
															</li>
														</span>
													</ul>
												</div>
											</li>
										<?php } ?>


										<?php #VALIDAMOS TAREA FOLIO DEVENGO
										if ($data['RequirementTracking']['requirement_tracking_type_id'] == '66f43259-8d68-4a35-b3c7-39a60a320009') { ?>
											<li class="timeline-item timeline-item-transparent border-primary">
												<div class="ps-3 mb-4">
													<?php
													if ($vuelta < 1) {
														echo '<h6 class="border-top-0 mt-3"><i><b>Número Folio Devengo: </b></i></h6>';
														$vuelta++;
													} ?>
													<ul>
														<span class="text-muted mb-1">
															<!-- <li> -->
															<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
																<!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
																<div class="input-group input-group-md">
																	<span class="input-group-text">
																	</span>																	
																	<a class="btn btn-primary btn-sm" style="color:white;">
																		<?php echo strtoupper($data['RequirementTracking']['description']); ?>
																	</a>
																	<span class="input-group-text">
																	<i class='bx bx-clipboard' ></i>
																	</span>
																</div>
																<!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
															</li>
														</span>
													</ul>
												</div>
											</li>
										<?php } ?>


										<?php /*
										<?php #VALIDAMOS TAREA SOLICITUD DE APROBACION
										if ($data['RequirementTracking']['requirement_tracking_type_id'] == '65c3a473-06c0-4bef-b594-3df8c26b1ae0') { ?>
											<li class="timeline-item timeline-item-transparent border-primary">
												<div class="ps-3 mb-4">
													<h6 class="border-top-0 mt-3">
														<p>
															<i><b>Tarea: </b>Solicitud de Aprobacion</i>
															<!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
															<?php if ($data['RequirementTracking']['approver'] == $usuario) { ?>
																<?php if (is_null($data['RequirementTracking']['approval_status'])) : ?>
																	<button type="button" data-approv="1" id="<?= $data['RequirementTracking']['id'] ?>" class="approv btn btn-sm btn-success"><i class='bx bx-check'></i></button>
																	<button type="button" data-approv="0" id="<?= $data['RequirementTracking']['id'] ?>" class="approv btn btn-sm btn-danger"> <i class='bx bx-x'> </i></button>
																<?php endif; ?>
														</p>
													</h6>
												<?php } ?>
												<p><i><b>Aprobador: </b><?= $this->requestAction('memos/find_user_username/' . $data['RequirementTracking']['approver']) ?></i></p>
												<p>
													<i>
														<b>Estado: </b>
														<span id="<?= 'p_' . $data['RequirementTracking']['id'] ?>">
															<?php if (is_null($data['RequirementTracking']['approval_status'])) { ?>
																<span>En Aprobación</span>
															<?php } elseif ($data['RequirementTracking']['approval_status'] == 0) { ?>
																<span class="text-danger">Rechazado</span>
															<?php } else { ?>
																<span class="text-success">Aprobado</span>
															<?php } ?>
														</span>
													</i>
												</p>
												<!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->

												</div>
											</li>
										<?php } ?>

										<?php #VALIDAMOS TAREA COLABORADOR
										if ($data['RequirementTracking']['requirement_tracking_type_id'] == '65b94f54-1c84-4ee4-863c-3df80a220016') { ?>
											<li class="timeline-item timeline-item-transparent border-primary">
												<div class="ps-3 mb-4">
													<h6 class="border-top-0 mt-3">
														<i><b>Tarea:</b> Colaborador</i>
													</h6>
													<p>
														<span class="text-muted mb-1">
															<!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
															<p><i>Se agrega como colaborador a: </i></p>
															<ul>
																<?php
																$nombreCollas = explode(',', $data['RequirementTracking']['collaborator']);
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


										<?php #VALIDAMOS TAREA ESPECIFICA
										if ($data['RequirementTracking']['requirement_tracking_type_id'] == '661d61cb-c97c-44f3-84aa-09c10a320009') { ?>
											<li class="timeline-item timeline-item-transparent border-primary">
												<div class="ps-3 mb-4">
													<h6 class="border-top-0 mt-3">
														<i><b>Tarea:</b> Especifica</i>
													</h6>
													<p>
														<span class="text-muted mb-1">
															<!-- CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
															<p><b><i>Se asigna tarea a: </i></b></p>
															<ul>
																<?php
																$nombreCollas = explode(',', $data['RequirementTracking']['specific_task_person']);
																foreach ($nombreCollas as $key => $value) {
																	$nombreColla = explode('@', $value);
																	echo '<li>' . $this->requestAction('memos/find_user_username/' . $nombreColla[0]) . '</li>';
																}
																?>
															</ul>
															<!-- // CONTENIDO DESCRIPTIVO DEL REQUERIMIENTO -->
														</span>
													</p>
													<p>
														<i><b>Detalle</b></i></br>
														<?= $data['RequirementTracking']['specific_task_description'] ?>
													</p>
												</div>
											</li>
										<?php } ?>
										*/ ?>


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
				<?php 
					foreach ($result as $key => $resultTracking) {
						foreach ($resultTracking as $key => $valueExportEP) {
							
							#debug($valueExportEP['RequirementTracking']);

							if( 
								$valueExportEP['RequirementTracking']['requirement_process_tasks_id'] == '66993bc2-5e48-447d-b3d9-3eab0a320009'
								 && $valueExportEP['RequirementTracking']['requirement_tracking_type_id'] == '65b94f7c-fb7c-4c3c-a2b6-3df80a220016'
							):
								#echo 'tenemos ID TRACKING 8';
								echo $this->Html->link(
									__('Exportar Expediente (PAGO)'),
									array('action' => 'create_zip_exp', $idRequirement), 
									array(
										'class' => "btn btn-sm btn-primary",
										'escape' => false,
										'data-toggle' => 'tooltip',
										'title' => 'export'
									)
								);				
							endif;
						}
					}
				?>
				<?php #if( ): ?>
					<a type="button" href="index/<?php echo $idRequirement ?>" class="btn btn-sm btn-primary text-truncate">Nuevo registro</a>
				<?php #endif; ?>
				<button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- // MODAL DETALLE -->
