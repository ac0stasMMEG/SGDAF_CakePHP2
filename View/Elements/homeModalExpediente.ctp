<!-- DETALLE DE REQUERIMIENTO -->
<!-- MODAL EXPEDIENTE -->
<button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalScrollableExpediente-<?php echo $idRequirement ?>">
	<i class='bx bx-folder-open' title="EXPEDIENTE"></i>
	EXPEDIENTE
	<!-- Expediente -->
</button>
<div class="modal fade modal-xl" id="modalScrollableExpediente-<?php echo $idRequirement ?>" tabindex="-1" aria-labelledby="modalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<!-- Content -->
				<div class="container-xxl flex-grow-1 container-p-y">
					<h4 class="py-1 mb-1">
						<span class="fw-light text-muted">Expediente / </span>
						<?php
						foreach ($resultExpediente as $key => $value) :
							foreach ($value as $key => $value2) :
								for ($i = 0; $i < 1; $i++) :
									echo 'P' . $value2['Requirement']['requirement_number'] . '-' . $value2['Requirement']['year'] . ':<br>';
									echo '<i>' . $value2['Requirement']['name'] . '</i>';
									break;
								endfor;
								break;
							endforeach;
							break;
						endforeach;
						?>
					</h4>
					<!-- Basic -->
					<div class="col-md-12 col-12">
						<div class="">
							<!-- <h5 class="card-header">Basic</h5> -->
							<div class="card-body mb-0">
								<div>
									<?php
									$registro = 0;
									foreach ($resultExpediente as $key => $value) {
										echo '<div class="card bg-label-primary mt-3 mb-3 ">';
										echo '<div class="card-body">';
										#echo '<ul>';
										echo '<ul class="list-group list-group-flush list-unstyled flex-wrap">';
										echo '<li class="list-group-item d-flex  justify-content-between align-items-center flex-wrap border-top-0 p-0 mb-0" mt-2>';
										switch ($processTasks['RequirementProcessArea']['name']):
											case 'COMPRAS':
												$colorBadge = 'succeful';
												break;
											case 'AGPP':
												$colorBadge = 'info';
												break;
											case 'FINANZAS':
												$colorBadge = 'danger';
												break;
											default:
												$colorBadge = 'default';
												break;
										endswitch;
										echo '<h5 class="mt-2">Tarea: ' . $processTasks['RequirementProcessTask'][$registro]['name'] . '</h5>';
										$registro++;
										foreach ($value as $key2 => $value2) :
											if ($value2['RequirementTracking']['requirement_tracking_type_id'] == '65b94f7c-fb7c-4c3c-a2b6-3df80a220016') :
												$memos = explode(',', $value2['RequirementTracking']['memo_number']);
												for ($i = 0; $i < count($memos); $i++) :
													if ($memos[$i] != '') :
														$memos = explode(',', $value2['RequirementTracking']['memo_number']);
														$nMemos = count($memos);
														for ($i = 0; $i < $nMemos - 1; $i++) :
															if ($memos[$i] != '') :
																$memoExplode = explode('-', $memos[$i]);
																$memoNumber = $memoExplode[0];
																$memoYear = $memoExplode[1];
																$AttachMemos = $this->requestAction('requirements/searchIdMemos/' . $memoNumber . '/' . $memoYear);
																$acceptedReception = $this->requestAction('requirements/acceptedReception/' . $memoNumber . '/' . $memoYear);
																$supplierRatings = $this->requestAction('requirements/supplierRatings/' . $memoNumber . '/' . $memoYear); ?>
																<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0 mb-1">
																	Memo referenciado:
																	<div class="input-group input-group-md">
																		<span class="input-group-text">
																			<!-- <input class="form-check-input" type="checkbox" checked> -->
																		</span>
																		<?php #pr($memos[$i]); ?>
																		<a href="/requirements/pdf/<?= $memos[$i] ?>.pdf" class="btn btn-info btn-sm" target="_blank"><?= $memos[$i] ?></a>
																		<span class="input-group-text">
																			<i class='bx bx-clipboard'></i>
																			<!-- <span class="badge rounded-pill bg-danger text-white badge-notifications">5</span> -->
																		</span>
																	</div>
																</li>
																<!-- <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0 mb-1"> -->
																<li class="list-group-item justify-content-between align-items-center flex-wrap border-top-0 p-0 mb-1">
																	<!-- <li> -->
																	<?php if (count($AttachMemos) > 0) : ?>
																		<div class="card mb-4">
																			<div class="card-body">
																				<div class="table-responsive text-nowrap">
																					Documentos Relacionados:
																					<table class="table table-bordered table-hover table-sm">
																						<tbody>
																							<tr>
																								<th witdh="5%"></th>
																								<th width="85%"><b>NOMBRE:</b></th>
																								<th width="10%"><b>ACCION:</b></th>
																							</tr>
																							<?php if ($acceptedReception != '') :  ?>
																								<tr>
																									<td><!-- <input class="form-check-input" type="checkbox" checked> --></td>
																									<td><a target="_blank" href="https://qasgdaf.minmujeryeg.gob.cl/accepted_receptions/pdf/<?= $acceptedReception ?>.pdf">RECEPCION CONFORME</a></td>
																									<td><a download="<?= $acceptedReception ?>.pdf" href="https://qasgdaf.minmujeryeg.gob.cl/accepted_receptions/pdf/<?= $acceptedReception ?>.pdf"><i class='bx bx-printer'></i></a></td>
																								</tr>
																							<?php endif;  ?>
																							<?php if ($supplierRatings != '') :  ?>
																								<tr>
																									<td><!-- <input class="form-check-input" type="checkbox" checked> --></td>
																									<td><a target="_blank" href="https://qasgdaf.minmujeryeg.gob.cl/supplier_ratings/pdf/<?= $supplierRatings ?>.pdf">CALIFICACION PROVEEDOR</a></td>
																									<td><a download="<?= $supplierRatings ?>.pdf" href="https://qasgdaf.minmujeryeg.gob.cl/supplier_ratings/pdf/<?= $supplierRatings ?>.pdf"><i class='bx bx-printer'></i></a></td>
																								</tr>
																							<?php endif;  ?>
																							<?php foreach ($AttachMemos as $key => $value) : ?>
																								<tr>
																									<td><!-- <input class="form-check-input" type="checkbox" checked> --></td>
																									<td><a target="_blank" href="https://digital.minmujeryeg.gob.cl/files/<?= $value['Attachment']['id'] . '/' . $value['Attachment']['name'] ?>" target="_blank"><?= strtoupper($value['Attachment']['name']) ?></a></td>
																									<td>
																										<a title="Imprimir" target="_blank" download="<?= $value['Attachment']['name'] ?>.pdf" href="https://digital.minmujeryeg.gob.cl/files/<?= $value['Attachment']['id'] . '/' . $value['Attachment']['name'] ?>"><i class='bx bx-printer'></i></a>
																										<a title="Descargar" target="_blank" download="<?= $value['Attachment']['name'] ?>.pdf" href="https://digital.minmujeryeg.gob.cl/files/<?= $value['Attachment']['id'] . '/' . $value['Attachment']['name'] ?>"><i class='bx bx-cloud-download'></i></a>
																									</td>
																								</tr>
																							<?php endforeach; ?>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	<?php endif; ?>
																</li>
															<?php endif; ?>
														<?php endfor; ?>
														<?php echo '</li>'; ?>
											<?php
													endif;
												endfor;
											endif;

											// VALIDAMOS TIPO DE TRACKING QUE SEA DE TIMO "ADJUNTAR DOCUMENTO"
											?>
											<!-- <br> -->

											<?php if ($value2['RequirementTracking']['requirement_tracking_type_id'] == '65b951a7-c290-4159-82df-3df80a220016') :
												for ($i = 0; $i < count($value2['RequirementAttachment']['name']); $i++) :
													echo '<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0 mb-2">';
													echo '<span>Documentos adjuntos:</span>';
													echo '<div class="input-group input-group-md">';
													echo '<span class="input-group-text">';
													#echo '<input class="form-check-input" >';
													#echo '<input class="form-check-input" type="checkbox" checked>';
													echo '</span>';
													echo '<a class="btn btn-warning btn-sm" target="_blank" title="Documento Adjunto" href="' . $this->Html->url('/files_requirements/' . $value2['RequirementAttachment']['id'] . '/' . $value2['RequirementAttachment']['name']) . '">';
													echo strtoupper($value2['RequirementAttachment']['name']);
													echo '</a>';
													echo '<span class="input-group-text">';
													echo "<i class='bx bxs-file-pdf' ></i>";
													echo '<a title="Imprimir"  target="_blank" onclick="window.print(' . $this->Html->url('/files_requirements/' . $value2['RequirementAttachment']['id'] . '/' . $value2['RequirementAttachment']['name']) . '.pdf)" href="' . $this->Html->url('/files_requirements/' . $value2['RequirementAttachment']['id'] . '/' . $value2['RequirementAttachment']['name']) . '"><span class="em-2"><i class=\'bx bx-printer\'></i></span></a>';
													echo '<a title="Descargar" target="_blank"
													download="' . $this->Html->url('/files_requirements/' . $value2['RequirementAttachment']['id'] . '/' . $value2['RequirementAttachment']['name']) . '.pdf"
													href="' . $this->Html->url('/files_requirements/' . $value2['RequirementAttachment']['id'] . '/' . $value2['RequirementAttachment']['name']) . '">
													<span class="em-5"><i class=\'bx bx-cloud-download\'></i></span></a>';
													echo '</span>';
													echo '</li>';
												endfor;
											endif;
											?>
											<!-- <br> -->

											<?php if ($value2['RequirementTracking']['requirement_tracking_type_id'] == '66f43108-daa8-4f8e-b56f-39a40a320009') : ?>
												<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0 mb-1">
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
																	<a class="btn btn-primary btn-sm" style="color:white;" href="<?= $value2['RequirementTracking']['description'] ?>" target="_blank" noopener>
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
											<?php endif; $vuelta=0; ?>
											<!-- <br> -->

											<?php if ($value2['RequirementTracking']['requirement_tracking_type_id'] == '66f430e5-6048-4d68-976c-39a50a320009') : ?>
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
																		<?= $value2['RequirementTracking']['description'] ?>
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
											<?php endif; ?>
											<!-- <br> -->

											<?php if ($value2['RequirementTracking']['requirement_tracking_type_id'] == '66f4323b-db94-4060-8361-3db10a320009') : ?>
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
																	<?= $value2['RequirementTracking']['description'] ?>
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
											<?php endif; ?>
											<!-- <br> -->

											<?php if ($value2['RequirementTracking']['requirement_tracking_type_id'] == '66f41a32-0820-42a0-a24a-3ccc0a320009') : ?>
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
																	<?= $value2['RequirementTracking']['description'] ?>
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
											<?php endif; ?>
											<!-- <br> -->

											<?php if ($value2['RequirementTracking']['requirement_tracking_type_id'] == '66f43259-8d68-4a35-b3c7-39a60a320009') : ?>
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
																	<?= $value2['RequirementTracking']['description'] ?>
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
											<?php endif; ?>
											<!-- <br> -->


											<!-- </div>
											</div> -->
									<?php
										endforeach;
										echo '</li>';
										echo '</ul>';
										echo '</div>';
										echo '</div>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<!-- /Basic -->

				</div>
				<!-- / Content -->

			</div>
			<!-- ****************** // DETALLE REQUERIMIENTO ****************** -->
			<div class="modal-footer">

				<?php  $this->Html->link(
					__('Exportar todo (ZIP)'),
					array('action' => 'create_zip', $idRequirement), #'657226d0-02d8-47dd-87de-18fd0a500003'),
					#array('action' => 'create_zip', '657226d0-02d8-47dd-87de-18fd0a500003'),
					array(
						'class' => "btn btn-sm btn-primary",
						'escape' => false,
						'data-toggle' => 'tooltip',
						'title' => 'export'
					)/* ,
					__('It is in the process of exporting the memorandum (s) and their attachments. This process may delay. %s (PDF/ZIP)', $memo['Memo']['reference']) */
				);

				?>
				<!-- <button type="button" class="btn btn-sm btn-primary">Descargar Todo</button> -->
				<a type="button" href="index/<?php echo $idRequirement ?>" class="btn btn-sm btn-primary text-truncate">Nuevo registro</a>
				<button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- // MODAL EXPEDIENTE -->
