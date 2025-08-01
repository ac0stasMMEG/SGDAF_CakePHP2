<?php
App::uses('AppModel', 'Model');
/**
 * RequirementProcess Model
 *
 * @property RequirementProcessArea $RequirementProcessArea
 * @property RequirementProcessTask $RequirementProcessTask
 * @property Requirement $Requirement
 */
class RequirementProcess extends AppModel {

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
		'RequirementProcessArea' => array(
			'className' => 'RequirementProcessArea',
			'foreignKey' => 'requirement_process_area_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'RequirementProcessTask' => array(
			'className' => 'RequirementProcessTask',
			'foreignKey' => 'requirement_process_id',
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
		'Requirement' => array(
			'className' => 'Requirement',
			'foreignKey' => 'requirement_process_id',
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
