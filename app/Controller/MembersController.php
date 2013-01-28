<?php

class MembersController extends AppController {

	public $hasMany = array('CandidateDate', 'Member');

	public function index() {
	}

	public function add() {

		if ($this->request->is('post')) {

			$this->Member->create();
			$data = $this->request->data['Member'];

			if ($this->Member->save($data)) {

				foreach ($this->request->data['Answer'] as $answer) {
					$this->Answer = new Answer();
					$this->Answer->save($answer);
				}

				$this->Session->setFlash(__('予定の登録が完了しました。'));
				$this->redirect(array(
					'controller' => 'schedules', 
					'action' => 'view/' . $data['schedule_id'] . '/' . $data['rand_url_key']
				));
			} else {
				$this->Session->setFlash(__('予定の登録に失敗しました。'));
			}
		}
	}


	public function view() {
		$id = $this->params['id'];
		$key = $this->params['key'];

		if ($id == '' || $key == '') {
			$this->redirect(array('action' => 'index'));
		}

		$conditions = array(
			'conditions' => array(
				'Schedule.id' => $id,
				'Schedule.rand_url_key' => $key
			)
		);
		$schedule = $this->Schedule->find('first', $conditions);
		$this->set('schedule', $schedule["Schedule"]);

		$conditions = array(
			'conditions' => array(
				'CandidateDate.schedule_id' => $schedule["Schedule"]['id']
			)
		);
		$candidateDates = $this->CandidateDate->find('all', $conditions);
		if ($candidateDates == null) {
			$candidateDates = array();
		}
		$this->set('candidateDates', $candidateDates);

		$this->set('weeks', array('月', '火', '水', '木', '金', '土', '日'));
	}
}