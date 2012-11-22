<?php $this->assign('header.image', 'forums') ?>
<?php $this->assign('header.title', 'Editer le sujet') ?>
<?php $this->assign('content.class', 'no-padding') ?>

<?php $this->Html->addCrumb('Forums', array('controller' => 'forums', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($topic['Forum']['name'], array('controller' => 'forums', 'action' => 'view', $topic['Forum']['id'])) ?>
<?php $this->Html->addCrumb('Editer le sujet') ?>

<?php echo $this->Session->flash() ?>
<?php echo $this->Form->create(array('id' => 'forum-post-form')) ?>
<?php echo $this->Form->input('ForumTopic.title', array('label' => false, 'placeholder' => 'Titre du sujet')) ?>
<?php echo $this->Form->input('FirstPost.content', array('label' => false, 'placeholder' => 'Message')) ?>
<?php echo $this->Form->end(array('label' => "Envoyer", 'div' => array('class' => 'form-action'))) ?>

<?php echo $this->element('latest_posts', array('posts' => $topic['ForumPost'])) ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#FirstPostContent').markItUp(mySettings);
});
<?php $this->end() ?>