<?php echo $this->Form->create('Schedule'); ?>
  <fieldset>
    <legend>新しいイベントを作成</legend>
    <?php
      echo $this->Form->input('Schedule.name', array('label' => 'イベント名', 'placeholder' => 'イベント名を入力してください'));
      echo $this->Form->input('Schedule.description', array('label' => '説明'));
    ?>
    <p>候補日を設定してください</p>
    <ul>
      <li>
        <?php
          echo $this->Form->select('CandidateDate.0.date', $date);
          echo $this->Form->select('CandidateDate.0.time', $time);
        ?>
      </li>
      <li>
        <?php
          echo $this->Form->select('CandidateDate.1.date', $date);
          echo $this->Form->select('CandidateDate.1.time', $time);
        ?>
      </li> 
    </ul>
    <p class="btn small">候補日の追加</p>
    <?php
      echo $this->Form->submit('イベントを作成する', array('class' => 'btn btn-primary'));
    ?>
  </fieldset>
<?php echo $this->Form->end(); ?>