<?php $this->Html->addCrumb('Forums', array('action' => 'index')) ?>
<?php $this->Html->addCrumb($forum['Forum']['name']) ?>

<?php $this->assign('header.image', 'forums') ?>
<?php $this->assign('header.title', $forum['Forum']['name']) ?>
<?php $this->assign('content.class', 'no-padding') ?>

<?php if ($this->Auth->user() && $this->Acl->hasForumRole($forum['Forum']['id'], 'create')) : ?>
<?php $this->start('top') ?>
<?= $this->Html->link('Nouveau sujet', array('controller' => 'topics', 'action' => 'create', $forum['Forum']['id']), array('class' => 'ui-button float-left')) ?>
<?= $this->element('paginator', array('class' => 'float-right')) ?>
<?php $this->end() ?>
<?php endif ?>

<?php if (!empty($topics)): ?>
<table id="topics">
<tbody>
<?php foreach ($topics as $topic): ?>
<tr class="topic<?= $topic['ForumTopic']['new_messages'] ? ' new-messages' : null ?>">
<td>
<?php if ($topic['ForumTopic']['sticky']) : ?>
<span class="topic-sticky icon-attach" title="Epinglé"></span>
<?php endif ?>
<?php if ($topic['ForumTopic']['closed']) : ?>
<span class="topic-closed icon-lock" title="Fermé"></span>
<?php endif ?>
<?= $this->Html->link($topic['ForumTopic']['title'], array('controller' => 'topics', 'action' => 'view', $topic['ForumTopic']['id']), array('class' => 'topic-title')) ?>
<div class="topic-meta"><?= $this->Html->link($topic['FirstPost']['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $topic['FirstPost']['CreatedBy']['id'])) ?>, <?= $this->Time->timeAgoInWords($topic['FirstPost']['created']) ?></div>
</td>
<td>
<?= $topic['ForumTopic']['num_replies'] ?> réponses<br />
<?= $topic['ForumTopic']['num_views'] ?> vues
</td>
<td>
<div class="last-post-author"><?= $this->Html->link($topic['LastPost']['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $topic['LastPost']['CreatedBy']['id'])) ?></div>
<div class="last-post-date"><?= $this->Time->timeAgoInWords($topic['LastPost']['created']) ?></div>
</td>
</tr>
<?php endforeach ?>
</tbody>
</table>
<?php else : ?>
<h2 class="caption-empty">Il n'y a actuellement aucun fil de discussion disponible</h2>
<?php endif ?>
