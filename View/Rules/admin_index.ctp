<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Charte de bonne conduite') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Charte de bonne conduite') ?>
<?php $this->assign('header.description', $this->Html->link('Editer la charte de bonne de conduite', array('action' => 'edit'), array('class' => 'ui-button'))) ?>

<?php echo $this->Parser->parseAsString($page['Page']['content'], 'bbcode') ?>
