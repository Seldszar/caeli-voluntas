<?php $this->assign('header.image', 'forums') ?>
<?php $this->assign('header.title', 'Editer le sujet') ?>
<?php $this->assign('content.class', 'no-padding') ?>

<?php $this->Html->addCrumb('Forums', array('controller' => 'forums', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($topic['Forum']['name'], array('controller' => 'forums', 'action' => 'view', $topic['Forum']['id'])) ?>
<?php $this->Html->addCrumb('Editer le sujet') ?>

<?= $this->Session->flash() ?>
<?= $this->Form->create(array('id' => 'forum-post-form')) ?>
<?= $this->Form->input('ForumTopic.title', array('label' => false, 'placeholder' => 'Titre du sujet')) ?>
<?= $this->Form->input('FirstPost.content', array('label' => false, 'placeholder' => 'Message')) ?>
<?= $this->Form->end(array('label' => "Envoyer", 'div' => array('class' => 'form-action'))) ?>

<?= $this->element('latest_posts', array('posts' => $topic['ForumPost'])) ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#FirstPostContent').markItUp(mySettings);
});
<?php $this->end() ?>