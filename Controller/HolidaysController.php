<?php
App::uses('AppController', 'Controller');
/**
 * Holidays Controller
 *
 * @property Holiday $Holiday
 * @property PaginatorComponent $Paginator
 */
class HolidaysController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
        
		$holidays = $this->Holiday->find('all');
        
        $this->set(compact('holidays'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Holiday->exists($id)) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		$options = array('conditions' => array('Holiday.' . $this->Holiday->primaryKey => $id));
		$this->set('holiday', $this->Holiday->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Holiday->create();
			if ($this->Holiday->save($this->request->data)) {
				$this->Session->setFlash(__('The holiday has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The holiday could not be saved. Please, try again.'), 'flash/error');
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->Holiday->id = $id;
		if (!$this->Holiday->exists($id)) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Holiday->save($this->request->data)) {
				$this->Session->setFlash(__('The holiday has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The holiday could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Holiday.' . $this->Holiday->primaryKey => $id));
			$this->request->data = $this->Holiday->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Holiday->id = $id;
		if (!$this->Holiday->exists()) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		if ($this->Holiday->delete()) {
			$this->Session->setFlash(__('Holiday deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Holiday was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
    
/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
    
    public function subtracted_days($later = null, $earlier = null) { // Funcion restar días sin considerar el fin de semana
    
        $holidays = $this->Holiday->find('list', array('fields' => array('holiday_date', 'holiday_date')));
  
        $diff=(($earlier-$later)/86400);
        $later = date("Y-m-d H:i:s", $later);
        $parts=explode("-",$later);
        $diffSum = 0;
        for ($i=0;$i<=$diff;$i++)
        {
            $day=mktime(0,0,0,$parts[1],$parts[2]+$i,$parts[0]);
            $weekDay = date("w",strtotime(date("Y-m-d",$day)));
            $dayFormat = date("Y-m-d",$day);

            if(($weekDay == 5) || ($weekDay == 6) || (@$holidays[$dayFormat])){ // Sábado, Domingo y Festivos
                $diffSum++;    
            }else{
                
            }
        }
        
        return $diffSum;
    }
}
