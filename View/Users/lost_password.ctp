<?php $this->Html->addCrumb('Mot de passe perdu') ?>

<?php $this->assign('header.image', 'login') ?>
<?php $this->assign('header.title', 'Mot de passe perdu') ?>

<div id="login">
<p>Veuillez saisir l'adresse e-mail avec laquelle vous vous êtes inscrit pour reçevoir un lien vous permettant de réinitialiser votre mot de passe.</p>
<?php echo $this->Form->create() ?>
<?php echo $this->Form->input("email", array('label' => false, 'placeholder' => 'Saisissez votre adresse e-mail')) ?>
<?php echo $this->Form->end("Réinitialiser mon mot de passe") ?>
</div>
