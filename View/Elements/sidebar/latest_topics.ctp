<?php $topics = $this->requestAction(array('controller' => 'topics', 'action' => 'latest')) ?>
<div class="sidebar-module">
<h2>Derniers sujets postés</h2>
<div class="sidebar-module-content">
<?php foreach ($topics as $topic) : ?>
<div class="latest-topic">
<div class="name"><?= $this->Html->link($topic['ForumTopic']['title'], array('controller' => 'topics', 'action' => 'view', $topic['ForumTopic']['id'])) ?></div>
<div class="created"><span title="<?= $this->Time->nice($topic['FirstPost']['created']) ?>"><?= $this->Time->timeAgoInWords($topic['FirstPost']['created']) ?></span> par <?= $this->Html->link($topic['FirstPost']['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $topic['FirstPost']['CreatedBy']['id'])) ?></div>
</div>
<?php endforeach ?>
</div>
</div>
