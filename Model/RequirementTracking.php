<?php
App::uses('AppModel', 'Model');
/**
 * RequirementTracking Model
 *
 * @property Requirement $Requirement
 * @property RequirementTrackingType $RequirementTrackingType
 * @property Milestone $Milestone
 */
class RequirementTracking extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'requirement_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'requirement_tracking_type_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'to' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Requirement' => array(
			'className' => 'Requirement',
			'foreignKey' => 'requirement_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RequirementTrackingType' => array(
			'className' => 'RequirementTrackingType',
			'foreignKey' => 'requirement_tracking_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Milestone' => array(
			'className' => 'Milestone',
			'foreignKey' => 'milestone_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RequirementAttachment' => array(
			'className' => 'RequirementAttachment',
			'foreignKey' => 'requirement_attachment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
