<?php $this->extend('/Layouts/base') ?>

<?php $this->assign('body.id', 'error') ?>

<?php $this->Html->addCrumb('Une erreur est survenue') ?>

<?php $this->start('_content') ?>
<?php echo $this->fetch('content') ?>
<?php $this->end() ?>
