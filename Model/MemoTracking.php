<?php
App::uses('AppModel', 'Model');
/**
 * MemoTracking Model
 *
 * @property Memo $Memo
 * @property MemoTrackingType $MemoTrackingType
 * @property AcceptedReception $AcceptedReception
 * @property SupplierRating $SupplierRating
 */
class MemoTracking extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'memo_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'memo_tracking_type_id' => array(
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
		'Memo' => array(
			'className' => 'Memo',
			'foreignKey' => 'memo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MemoTrackingType' => array(
			'className' => 'MemoTrackingType',
			'foreignKey' => 'memo_tracking_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        'Subrogance' => array(
			'className' => 'Subrogance',
			'foreignKey' => 'subrogance_id',
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
		'AcceptedReception' => array(
			'className' => 'AcceptedReception',
			'foreignKey' => 'memo_tracking_id',
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
		'SupplierRating' => array(
			'className' => 'SupplierRating',
			'foreignKey' => 'memo_tracking_id',
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
