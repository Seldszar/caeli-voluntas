<?php $this->extend('/Layouts/default') ?>

<?php $this->assign('body.class', 'two_column') ?>

<?php $this->start('_content') ?>
<div id="left">
<?php echo $this->fetch('left') ?>
</div>
<div id="right">
<?php echo $this->fetch('right') ?>
</div>
<?php $this->end() ?>
