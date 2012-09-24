<?php $this->Html->addCrumb('Inscription') ?>

<?php $this->assign('header.image', 'login') ?>
<?php $this->assign('header.title', 'Inscription') ?>

<div id="login">
<?php echo $this->Form->create() ?>
<?php echo $this->Form->input("username", array('label' => "Nom d'utilisateur")) ?>
<?php echo $this->Form->input("email", array('label' => "Adresse e-mail")) ?>
<?php echo $this->Form->input("password", array('label' => "Mot de passe", 'value' => false)) ?>
<?php echo $this->Form->input("password_confirm", array('type' => 'password', 'label' => "Confirmez votre mot de passe", 'value' => false)) ?>
<?php echo $this->Form->end("S'inscrire") ?>
</div>
