<?php
App::uses('AppModel', 'Model');
/**
 * AcceptedReception Model
 *
 * @property MemoTracking $MemoTracking
 */
class AcceptedReception extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'memo_tracking_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
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
		'MemoTracking' => array(
			'className' => 'MemoTracking',
			'foreignKey' => 'memo_tracking_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
