<?php $this->Html->addCrumb('Forums', array('controller' => 'forums', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($topic['Forum']['name'], array('controller' => 'forums', 'action' => 'view', $topic['Forum']['id'])) ?>
<?php $this->Html->addCrumb($topic['ForumTopic']['title'], array('controller' => 'topics', 'action' => 'view', $topic['ForumTopic']['id'])) ?>
<?php $this->Html->addCrumb('Répondre') ?>

<?php $this->assign('header.image', 'forums') ?>
<?php $this->assign('header.title', 'Répondre') ?>
<?php $this->assign('content.class', 'no-padding') ?>

<?php echo $this->Session->flash() ?>
<?php echo $this->Form->create(array('id' => 'forum-post-form')) ?>
<?php echo $this->Form->input('content', array('label' => false)) ?>
<?php echo $this->Form->end('Envoyer') ?>

<?php echo $this->element('latest_posts', array('posts' => $topic['ForumPost'])) ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#ForumPostContent').markItUp(mySettings);
});
<?php $this->end() ?>