<?php $this->Html->addCrumb('Forums', array('controller' => 'forums', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($forum['Forum']['name'], array('controller' => 'forums', 'action' => 'view', $forum['Forum']['id'])) ?>
<?php $this->Html->addCrumb('Nouveau sujet') ?>

<?php $this->assign('header.image', 'forums') ?>
<?php $this->assign('header.title', 'Nouveau sujet') ?>

<?php echo $this->Session->flash() ?>
<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('title', array('label' => false, 'placeholder' => 'Titre du sujet')) ?>
<?php echo $this->Form->input('ForumPost.0.content', array('label' => false, 'placeholder' => 'Message', 'rows' => 12)) ?>
<?php echo $this->Form->end(array('label' => "Envoyer", 'div' => array('class' => "form-action"))) ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#ForumPost0Content').markItUp(mySettings);
});
<?php $this->end() ?>