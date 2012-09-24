<?php $this->Html->addCrumb('Réinitialisation de votre mot de passe') ?>

<?php $this->assign('header.image', 'login') ?>
<?php $this->assign('header.title', 'Réinitialisation de votre mot de passe') ?>

<div id="login">
<p>Veuillez saisir votre nouveau mot de passe pour confirmer la réinitialisation de votre mot de passe.</p>
<?php echo $this->Form->create() ?>
<?php echo $this->Form->input("password", array('label' => false, 'placeholder' => 'Saisissez votre nouveau mot de passe')) ?>
<?php echo $this->Form->input("password_confirm", array('label' => false, 'type' => 'password', 'placeholder' => 'Confirmez votre nouveau mot de passe')) ?>
<?php echo $this->Form->end("Réinitialiser mon mot de passe") ?>
</div>
