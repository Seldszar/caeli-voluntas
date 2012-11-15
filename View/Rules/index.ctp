<?php $this->Html->addCrumb("Charte de bonne conduite") ?>

<?php $this->assign('header.image', 'rules') ?>
<?php $this->assign('header.title', 'Charte de bonne conduite') ?>

<?php echo $this->Markitup->parse($page['Page']['content']) ?>
