<div id="schedule_add_section">
  <?php echo $this->Form->create('Schedule'); ?>
    <fieldset>
      <legend>新しいイベントを作成</legend>
      <?php
        echo $this->Form->input('Schedule.name', array('label' => 'イベント名', 'placeholder' => 'イベント名を入力してください'));
        echo $this->Form->input('Schedule.description', array('label' => '説明'));
      ?>
      <p>候補日を設定してください</p>
      <ul id="cadidate_add_section">
        <li>
          <?php
            echo $this->Form->select('CandidateDate.0.date', $date, array('class' => 'date'));
            echo $this->Form->select('CandidateDate.0.time', $time, array('class' => 'time'));
          ?>
        </li>
      </ul>
      <p class="btn small" id="cadidate_add_btn">候補日の追加</p>
      <?php
        echo $this->Form->submit('イベントを作成する', array('class' => 'btn btn-primary'));
      ?>
    </fieldset>
  <?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#cadidate_add_btn').on('click', function() {
      var $ul = $('#cadidate_add_section');
      var size = $ul.find('li').length;
      var $li = $ul.find('li:last').clone();
      var dateName = $li.find('select.date').attr('name').replace('['+(size-1)+']', '['+size+']');
      $li.find('select.date').attr('name', dateName);
      var timeName = $li.find('select.time').attr('name').replace('['+(size-1)+']', '['+size+']');
      $li.find('select.time').attr('name', timeName);
      $ul.append($li);
    })
  });
</script>