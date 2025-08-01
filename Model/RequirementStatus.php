<?php
App::uses('AppModel', 'Model');
/**
 * RequirementStatus Model
 *
 * @property RequirementProcess $RequirementProcess
 */
class RequirementStatus extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'requirement_status';

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
		'RequirementProcess' => array(
			'className' => 'RequirementProcess',
			'foreignKey' => 'requirement_status_id',
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
