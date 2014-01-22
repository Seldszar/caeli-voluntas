<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Avancée raids', array('action' => 'index')) ?>
<?php $this->Html->addCrumb('Ajouter une zone') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Ajouter une zone') ?>

<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('name', array('label' => 'Nom')) ?>
<?php echo $this->Form->end('Sauver') ?>
