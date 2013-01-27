<div id="schedule_view_section">
	<div class="hero-unit">
		<h1><?php  echo __('イベントの詳細'); ?></h1>
		<dl>
			<dt><?php echo __('イベント名'); ?></dt>
			<dd>
				<?php echo h($schedule['name']); ?>
			</dd>
			<dt><?php echo __('説明'); ?></dt>
			<dd>
				<?php echo h($schedule['description']); ?>
			</dd>
		</dl>

		<div id="schedule_scrollable_section">
			<table class="table">
				<tr>
					<th>候補日時</th>
					<?php foreach ($members as $key => $value) {  $member = $value['Member'] ?>
						<th><?php echo h($member['name']); ?></th>
					<?php } ?>
				</tr>
				<?php foreach ($candidateDates as $key => $value) {  $cadidate = $value['CandidateDate'] ?>
				<tr>
					<th>
						<?php 
							if ($cadidate['date'] != null) {
								echo date('Y年m月d日', strtotime($cadidate['date'])).'('.$weeks[date('w', strtotime($cadidate['date']))].')';
							}
						?>
						<?php 
							if ($cadidate['date'] != null && $cadidate['time'] != null) {
								echo date('h時〜', strtotime($cadidate['time'])); 
							}
						?>
					</th>
					<?php foreach ($members as $memberValue) {  $member = $memberValue['Member'] ?>
						<td><?php echo h($member['Answers'][$key]['Answer']['answer']); ?></td>
					<?php } ?>
				</tr>
				<?php } ?>
				<tr>
					<td>一言</td>
					<?php foreach ($members as $memberValue) {  $member = $memberValue['Member'] ?>
						<td><?php echo h($member['comment']); ?></td>
					<?php } ?>
				</tr>
			</table>
		</div>
	</div>

	<?php echo $this->element('member_answer_form', array('cadidate' => $cadidate, 'weeks' => $weeks, 'schedule' => $schedule)); ?>
</div>
