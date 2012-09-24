<?php $this->Html->addCrumb('Forums', array('controller' => 'forums', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($topic['Forum']['name'], array('controller' => 'forums', 'action' => 'view', $topic['Forum']['id'])) ?>
<?php $this->Html->addCrumb($topic['ForumTopic']['title']) ?>

<?php $this->assign('header.image', 'forums') ?>
<?php $this->assign('header.title', $topic['ForumTopic']['title']) ?>
<?php $this->assign('content.class', 'no-padding') ?>

<?php if (AuthComponent::user() && AclComponent::hasForumRole($topic['Forum']['id'], 'reply')) : ?>
<?php $this->start('top') ?>
<?php echo $this->Html->link("Répondre", array('controller' => 'posts', 'action' => 'create', $topic['ForumTopic']['id']), array('class' => 'ui-button float-left')) ?>
<?php echo $this->element('paginator', array('class' => 'float-right')) ?>
<?php $this->end() ?>
<?php endif ?>

<table id="posts">
<?php foreach ($posts as $post) : ?>
<tr class="post">
<td class="post-author">
<?php echo $this->Html->link($post['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $post['CreatedBy']['id']), array('class' => 'name', 'style' => (!empty($post['CreatedBy']['Group']['color']) ? "color: #{$post['CreatedBy']['Group']['color']}" : null))) ?>
<div class="group"><?php echo $post['CreatedBy']['Group']['name'] ?></div>
</td>
<td>
<div class="post-date"><?php echo $this->Time->timeAgoInWords($post['ForumPost']['created']) ?> <?php if ($post['ForumPost']['edited']) : ?>(édité par <?php echo $post['EditedBy']['username'] ?>, <?php echo $this->Time->timeAgoInWords($post['ForumPost']['edited']) ?>)<?php endif ?></div>
<div class="post-body">
<?php echo $this->BBCode->parse($post['ForumPost']['content']) ?>
</div>
<?php if (AuthComponent::user()) : ?>
<ul class="post-action">
<?php if (AclComponent::hasForumRole($topic['Forum']['id'], 'reply')): ?>
<li><?php echo $this->Html->link("Répondre", array('controller' => 'posts', 'action' => 'create', $post['ForumPost']['topic'])) ?></li>
<?php endif ?>
<?php if (($post['CreatedBy']['id'] == AuthComponent::user('id') && AclComponent::hasForumRole($topic['Forum']['id'], 'reply')) || AclComponent::hasForumRole($topic['Forum']['id'], 'moderate')) : ?>
<?php if ($post['ForumPost']['id'] == $topic['ForumTopic']['first_post']): ?>
<li><?php echo $this->Html->link("Editer", array('controller' => 'topics', 'action' => 'edit', $post['ForumPost']['topic'])) ?></li>
<li><?php echo $this->Html->link("Supprimer", array('controller' => 'topics', 'action' => 'delete', $post['ForumPost']['topic']), null, 'Voulez-vous vraiment supprimer ce fil de discussion ?') ?></li>
<?php else: ?>
<li><?php echo $this->Html->link("Editer", array('controller' => 'posts', 'action' => 'edit', $post['ForumPost']['id'])) ?></li>
<li><?php echo $this->Html->link("Supprimer", array('controller' => 'posts', 'action' => 'delete', $post['ForumPost']['id']), null, 'Voulez-vous vraiment supprimer ce message ?') ?></li>
<?php endif ?>
<?php endif ?>
</ul>
<?php endif ?>
</td>
</tr>
<?php endforeach ?>
</table>
