<?php $this->extend('/Layouts/default') ?>

<?php $this->assign('body.class', 'two_column') ?>

<?php $this->start('_content') ?>
<div id="left">
<?= $this->fetch('left') ?>
</div>
<div id="right">
<?= $this->fetch('right') ?>
</div>
<?php $this->end() ?>
