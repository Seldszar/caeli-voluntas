<?php $this->Html->addCrumb('Connexion') ?>

<?php $this->assign('header.image', 'login') ?>
<?php $this->assign('header.title', 'Connexion') ?>

<div id="login">
<?= $this->Session->flash() ?>
<?= $this->Session->flash('auth') ?>
<?= $this->Form->create() ?>
<?= $this->Form->input("email", array('label' => "Adresse e-mail", 'autofocus')) ?>
<?= $this->Form->input("password", array('label' => "Mot de passe", 'value' => false)) ?>
<?= $this->Form->end(array('label' => "Se connecter", 'after' => $this->Html->link("Mot de passe oublié ?", array('action' => "lostPassword")))); ?>
</div>
