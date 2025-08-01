<?php
App::uses('AppModel', 'Model');
/**
 * Attachment Model
 *
 * @property Memo $Memo
 * @property AttachmentType $AttachmentType
 */
class Attachment extends AppModel
{

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
		'attachment_type_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
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
		'AttachmentType' => array(
			'className' => 'AttachmentType',
			'foreignKey' => 'attachment_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
