<?php
App::uses('AppModel', 'Model');
/**
 * Historial Model
 *
 */
class Historial extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'owner' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'memo_one' => array(
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

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Memo' => array(
			'className' => 'Memo',
			'foreignKey' => 'memo_one',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
