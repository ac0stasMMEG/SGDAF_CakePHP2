<?php
App::uses('AppModel', 'Model');
/**
 * Holiday Model
 *
 */
class Holiday extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'holiday_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
