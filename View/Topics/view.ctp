<?php $this->Html->addCrumb('Forums', array('controller' => 'forums', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($topic['Forum']['name'], array('controller' => 'forums', 'action' => 'view', $topic['Forum']['id'])) ?>
<?php $this->Html->addCrumb($topic['ForumTopic']['title']) ?>

<?php $this->assign('header.image', 'forums') ?>

<?php $this->start('header.title') ?>
<?= $topic['ForumTopic']['title'] ?> 
<?php if ($topic['ForumTopic']['sticky']) : ?>
<em class="topic-sticky icon-attach" title="Epinglé"></em>
<?php endif ?>
<?php if ($topic['ForumTopic']['closed']) : ?>
<em class="topic-closed icon-lock" title="Fermé"></em>
<?php endif ?>
<?php $this->end() ?>

<?php $this->assign('content.class', 'no-padding') ?>

<?php $this->start('top') ?>
<?php if ($this->Auth->user() && (AclComponent::hasForumRole($topic['Forum']['id'], 'reply') && !$topic['ForumTopic']['closed'] || AclComponent::hasForumRole($topic['Forum']['id'], 'moderate'))) : ?>
<?= $this->Html->link("Répondre", array('controller' => 'posts', 'action' => 'create', $topic['ForumTopic']['id']), array('class' => 'ui-button float-left')) ?>
<?php endif ?>
<?= $this->element('paginator', array('class' => 'float-right')) ?>
<?php $this->end() ?>

<table id="posts">
<?php foreach ($posts as $post) : ?>
<tr class="post" id="p<?= $post['ForumPost']['id'] ?>">
<td class="post-author">
<div class="avatar">
<?= $this->Html->image($post['CreatedBy']['avatar_url'], array('alt' => "Avatar de " . $post['CreatedBy']['username'])) ?>
</div>
<?= $this->Html->link($post['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $post['CreatedBy']['id']), array('class' => 'name', 'style' => (!empty($post['CreatedBy']['Group']['color']) ? "color: #{$post['CreatedBy']['Group']['color']}" : null))) ?>
<div class="group"><?php echo $post['CreatedBy']['Group']['name'] ?></div>
</td>
<td>
<div class="post-date"><?php echo $this->Html->link($this->Time->timeAgoInWords($post['ForumPost']['created']), array('controller' => 'topics', 'action' => 'view', $post['ForumPost']['topic'], '#' => 'p' . $post['ForumPost']['id'])) ?> <?php if ($post['ForumPost']['edited']) : ?>(édité par <?= $post['EditedBy']['username'] ?>, <?= $this->Time->timeAgoInWords($post['ForumPost']['edited']) ?>)<?php endif ?></div>
<div class="post-body">
<?= $this->Parser->parseAsString($post['ForumPost']['content'], 'bbcode') ?>
</div>
<?php if ($this->Auth->user()) : ?>
<ul class="post-action">
<?php if (($post['CreatedBy']['id'] == $this->Auth->user('id') && AclComponent::hasForumRole($topic['Forum']['id'], 'reply')) || AclComponent::hasForumRole($topic['Forum']['id'], 'moderate')) : ?>
<li><?php echo $this->Html->link("Citer", array('controller' => 'posts', 'action' => 'create', $topic['ForumTopic']['id'], '?' => array('quote' => $post['ForumPost']['id']))) ?></li>
<?php if ($post['ForumPost']['id'] == $topic['ForumTopic']['first_post']): ?>
<li><?php echo $this->Html->link("Editer", array('controller' => 'topics', 'action' => 'edit', $post['ForumPost']['topic'])) ?></li>
<li><?php echo $this->Html->link("Supprimer", array('controller' => 'topics', 'action' => 'delete', $post['ForumPost']['topic']), null, 'Voulez-vous vraiment supprimer ce fil de discussion ?') ?></li>
<?php if (AclComponent::hasForumRole($topic['Forum']['id'], 'moderate')) : ?>
<li><?php echo $this->Html->link(($topic['ForumTopic']['sticky'] ? 'Ne plus épingler' : 'Epingler'), array('controller' => 'topics', 'action' => 'sticky', $post['ForumPost']['topic'])) ?></li>
<li><?php echo $this->Html->link(($topic['ForumTopic']['closed'] ? 'Rouvrir le sujet' : 'Fermer'), array('controller' => 'topics', 'action' => 'close', $post['ForumPost']['topic'])) ?></li>
<?php endif ?>
<?php else: ?>
<li><?php echo $this->Html->link("Editer", array('controller' => 'posts', 'action' => 'edit', $post['ForumPost']['id'])) ?></li>
<li><?php echo $this->Html->link("Supprimer", array('controller' => 'posts', 'action' => 'delete', $post['ForumPost']['id']), null, 'Voulez-vous vraiment supprimer ce message ?') ?></li>
<?php endif ?>
<?php endif ?>
</ul>
<?php endif ?>
<?php if (!empty($post['CreatedBy']['signature'])) : ?>
<div class="post-author-signature">
<?= $this->Parser->parseAsString($post['CreatedBy']['signature'], 'bbcode') ?>
</div>
<?php endif ?>
</td>
</tr>
<?php endforeach ?>
</table>
