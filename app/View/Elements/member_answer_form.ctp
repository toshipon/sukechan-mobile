<?php echo $this->Form->create('Member', array('controller' => 'Members', 'action' => 'add')); ?>
  <fieldset>
    <legend>予定を入力する</legend>
    <?php
      echo $this->Form->input('Member.name', array('label' => '名前', 'placeholder' => '名前を入力してください'));
    ?>
    <p>予定を設定してください</p>
    <ul id="answer_add_section">
    	<?php foreach ($candidateDates as $key => $value) {  $cadidate = $value['CandidateDate'] ?>
			<li>
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
				<?php 
					echo $this->Form->hidden('Answer.'.$key.'.schedule_id', array('value'=>$schedule['id']));
					echo $this->Form->select('Answer.'.$key.'.answer', array('◯' => '◯', '☓' => '☓', '△' => '△'), array('class'=>'answer_select')); 
				?>
			</li>
		<?php } ?>
    </ul>
    <?php
    	echo $this->Form->hidden('Member.schedule_id', array('value'=>$schedule['id']));
    	echo $this->Form->hidden('Member.rand_url_key', array('value'=>$schedule['rand_url_key']));
    	echo $this->Form->input('Member.comment', array('label' => '一言', 'placeholder' => '何か一言を入力してください'));
    ?>
    <?php
      echo $this->Form->submit('予定を登録する', array('class'=>'btn btn-primary answer_submit_btn'));
    ?>
  </fieldset>
<?php echo $this->Form->end(); ?>
<script type="text/javascript">
  $(document).ready(function(){
    // ２度押し防止
    var submit_btn_flg = false;
    $('.answer_submit_btn').on('click', function() {
      if (submit_btn_flg) { return false; }
      submit_btn_flg = true;
    })
  });
</script>