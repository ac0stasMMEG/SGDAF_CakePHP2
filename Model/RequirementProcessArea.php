<?php
App::uses('AppModel', 'Model');
/**
 * RequirementProcessArea Model
 *
 * @property RequirementProcessTask $RequirementProcessTask
 * @property RequirementProcess $RequirementProcess
 */
class RequirementProcessArea extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'RequirementProcessTask' => array(
			'className' => 'RequirementProcessTask',
			'foreignKey' => 'requirement_process_area_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'RequirementProcess' => array(
			'className' => 'RequirementProcess',
			'foreignKey' => 'requirement_process_area_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
