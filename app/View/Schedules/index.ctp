<div class="hero-unit">
	<h1>すけちゃん(beta)</h1>
	<p>みんなで簡単にスケジュールを調整しよう</p>
	<?php echo $this->Html->link('新しいスケジュールを作成する', '/schedules/add', array('class' => 'btn btn-primary btn-large')) ?>
	<p><b>これは何？</b></p>
	<p class="lead">スマホで簡単にスケジュール調整するサービスがなかなか無かったのがきっかけで作り始めましたが、ほとんどCakePHPの勉強が目的という感じのゆるふわなサービスです。</p>
	<p class="lead">何かご要望がありましたら<a href="http://wwww.twitter.com/toshipon">こちら(@toshipon)</a>までご連絡いただければと思います。</p>
	<p><b>TODO</b></p>
	<ul>
		<li>編集・削除機能</li>
		<li>テスト</li>	
		<li>Elasticsearchを使って検索を高速化</li>
		<li>CoffeeScriptとSassを使ってコードを綺麗にする</li>
		<li>脱あからさまなbootstrapデザイン</li>
	</ul>
	<?php echo $this->Html->link('新しいスケジュールを作成する', '/schedules/add', array('class' => 'btn btn-primary btn-large')) ?>
</div>