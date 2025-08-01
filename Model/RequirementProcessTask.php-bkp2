<?php
App::uses('AppModel', 'Model');
/**
 * RequirementProcessTask Model
 *
 * @property RequirementProcess $RequirementProcess
 * @property RequirementProcessArea $RequirementProcessArea
 */
class RequirementProcessTask extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'RequirementProcess' => array(
			'className' => 'RequirementProcess',
			'foreignKey' => 'requirement_process_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RequirementProcessArea' => array(
			'className' => 'RequirementProcessArea',
			'foreignKey' => 'requirement_process_area_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
