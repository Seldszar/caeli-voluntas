<?php $this->Html->addCrumb('Inscription terminée') ?>

<?php $this->assign('header.image', 'login') ?>
<?php $this->assign('header.title', 'Inscription terminée') ?>

<div id="login">
<p>Félicitations ! Vous êtes désormais inscrit.</p>
<p>Vous pouvez dès maintenant vous connecter et profiter des services mis à votre disposition.</p>
<p><?php echo $this->Html->link('Se connecter', array('action' => 'login'), array('class' => 'ui-button')) ?></p>
</div>
