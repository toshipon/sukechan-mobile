<?php

class SchedulesController extends AppController {

	public function index() {
	}

	// イベントの登録画面表示と登録処理
	public function add() {
		App::import('Model', 'CandidateDate');

		if ($this->request->is('post')) {

			$this->Schedule->create();
			$data = $this->request->data['Schedule'];
			$data['rand_url_key'] = $this->get_rand_url_key();

			if ($this->Schedule->save($data)) {
				foreach ($this->request->data['CandidateDate'] as $candidate) {
					$this->CandidateDate = new CandidateDate();
					$candidate['schedule_id'] = $this->Schedule->id;
					$candidate['time'] = '19700101'.$candidate['time'].'0000';
					$this->CandidateDate->save($candidate);
				}

				$this->Session->setFlash(__('イベントの作成が完了しました。'));
				$this->redirect(array('action' => 'view/' . $this->Schedule->id . '/' . $data['rand_url_key']));
			} else {
				$this->Session->setFlash(__('作成に失敗しました。'));
			}
		}

        $now = new DateTime();
		$start = clone($now);
		$start->add( DateInterval::createFromDateString('today'));
		$end = clone($now);
		$end->add( DateInterval::createFromDateString('next next month'));
        $periods = new DatePeriod(
        	$start,
        	new DateInterval('P1D'),
        	$end
        );

        $date = array();
        $weeks = array('月', '火', '水', '木', '金', '土', '日');
        foreach ($periods as $period) {
        	$date[$period->format('Ymd')] = $period->format('m月d日') . '(' . $weeks[$period->format('w')] . ')';
        }
        
        $time = array();
        for ($i = 0; $i < 24; $i++) {
        	$time[substr('0'.$i, -2)] = $i . '時〜';
        }

        $this->set('date', $date);
        $this->set('time', $time);
	}

	// 登録済みイベントの表示
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

		$this->set_schedule_detail_info($id);
		$this->set('weeks', array('月', '火', '水', '木', '金', '土', '日'));
	}

	// イベントに付属する情報の取得
	private function set_schedule_detail_info($id) {
		// 候補日の取得
		App::import('Model', 'CandidateDate');
		$this->CandidateDate = new CandidateDate();
		$conditions = array(
			'conditions' => array(
				'CandidateDate.schedule_id' => $id
			),
			'order' => array('CandidateDate.id')
		);
		$candidateDates = $this->CandidateDate->find('all', $conditions);
		if ($candidateDates == null) {
			$candidateDates = array();
		}
		$this->set('candidateDates', $candidateDates);

		// メンバーの取得
		App::import('Model', 'Member');
		$this->Member = new Member();
		$conditions = array(
			'conditions' => array(
				'Member.schedule_id' => $id
			),
			'order' => array('Member.id')
		);
		$members = $this->Member->find('all', $conditions);
		if ($members == null) {
			$members = array();
		}

		// メンバーの回答の取得
		App::import('Model', 'Answer');
		$this->Answer = new Answer();
		$conditions = array(
			'conditions' => array(
				'Answer.schedule_id' => $id
			),
			'order' => array('Answer.member_id', 'Answer.candidate_date_id')
		);
		$answers = $this->Answer->find('all', $conditions);
		if ($answers == null) {
			$answers = array();
		}

		$cadidateSize = count($candidateDates);
		foreach ($members as $index => $member) {
			$members[$index]['Member']['Answers'] = array_slice($answers, $index*$cadidateSize , $cadidateSize);
		}
		$this->set('members', $members);
	}

	// ランダムな文字列を返却します
	private function get_rand_url_key() {
		for ($i = 0, $str = null; $i < 10; ) {
		    $num = mt_rand(0x30, 0x7A);            // ASCII 文字コードを指定する ( 10 進数でも可 )
		    if ((0x30 <= $num && $num <= 0x39)||        // 0 ～ 9
		        (0x41 <= $num && $num <= 0x5A)||    // A ～ Z
		        (0x61 <= $num && $num <= 0x7A)){    // a ～ z
		        $str .= chr($num);
		        $i++;
		    }
		}
		return $str;
	}
}