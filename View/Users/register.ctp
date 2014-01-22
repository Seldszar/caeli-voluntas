<?php $this->Html->addCrumb('Inscription') ?>

<?php $this->assign('header.image', 'login') ?>
<?php $this->assign('header.title', 'Inscription') ?>

<div id="login">
<p>Veuillez saisir les informations relatives à votre compte</p>
<p>Vous reçevrez par la suite un e-mail contenant un lien vous permettant de confirmer votre inscription</p>
<?= $this->Form->create() ?>
<?= $this->Form->input("username", array('label' => "Nom d'utilisateur")) ?>
<?= $this->Form->input("email", array('label' => "Adresse e-mail")) ?>
<?= $this->Form->input("email_confirm", array('label' => "Confirmez votre adresse e-mail")) ?>
<?= $this->Form->input("password", array('label' => "Mot de passe", 'value' => false)) ?>
<?= $this->Form->input("password_confirm", array('type' => 'password', 'label' => "Confirmez votre mot de passe", 'value' => false)) ?>
<?= $this->Form->end("S'inscrire") ?>
</div>
