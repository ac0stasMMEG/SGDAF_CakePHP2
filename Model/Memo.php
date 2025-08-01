<?php
App::uses('AppModel', 'Model');
/**
 * Memo Model
 *
 * @property Memo $ParentMemo
 * @property Matter $Matter
 * @property MemoType $MemoType
 * @property Attachment $Attachment
 * @property MemoAlert $MemoAlert
 * @property MemoTracking $MemoTracking
 * @property Memo $ChildMemo
 */
class Memo extends AppModel {
    
    public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentMemo' => array(
			'className' => 'Memo',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Matter' => array(
			'className' => 'Matter',
			'foreignKey' => 'matter_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MemoType' => array(
			'className' => 'MemoType',
			'foreignKey' => 'memo_type_id',
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
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'memo_id',
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
		'MemoAlert' => array(
			'className' => 'MemoAlert',
			'foreignKey' => 'memo_id',
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
		'MemoTracking' => array(
			'className' => 'MemoTracking',
			'foreignKey' => 'memo_id',
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
		'ChildMemo' => array(
			'className' => 'Memo',
			'foreignKey' => 'parent_id',
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
		/*'Historial' => array(
			'className' => 'Historial',
			'foreignKey' => 'memo_one',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),*/
	);

}
