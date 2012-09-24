<?php $this->Html->addCrumb('Connexion') ?>

<?php $this->assign('header.image', 'login') ?>
<?php $this->assign('header.title', 'Connexion') ?>

<div id="login">
<?php echo $this->Session->flash() ?>
<?php echo $this->Session->flash('auth') ?>
<?php echo $this->Form->create() ?>
<?php echo $this->Form->input("email", array('label' => "Adresse e-mail", 'autofocus')) ?>
<?php echo $this->Form->input("password", array('label' => "Mot de passe", 'value' => false)) ?>
<?php echo $this->Form->end(array('label' => "Se connecter", 'after' => $this->Html->link("Mot de passe oublié ?", array('action' => "lostPassword")))); ?>
</div>
