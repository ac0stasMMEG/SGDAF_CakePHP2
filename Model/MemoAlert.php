<?php
App::uses('AppModel', 'Model');
/**
 * MemoAlert Model
 *
 * @property AlertType $AlertType
 * @property Memo $Memo
 * @property User $User
 */
class MemoAlert extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'alert_type_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'AlertType' => array(
			'className' => 'AlertType',
			'foreignKey' => 'alert_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Memo' => array(
			'className' => 'Memo',
			'foreignKey' => 'memo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
