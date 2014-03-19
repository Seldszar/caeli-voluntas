<?php $this->extend('/Layouts/default') ?>
<?php $this->assign('body.class', 'one_column') ?>

<?php $this->start('_content') ?>
<div id="page-header" style="background-image: url('<?= $this->Html->url('/img/headers/full-header.jpg') ?>')">
<h1><?= $this->fetch('header.title') ?></h1>
<?= $this->fetch('header.description') ?>
<?php if ($this->fetch('top')) : ?>
<div id="page-content-top">
<?= $this->fetch('top') ?>
</div>
<?php endif ?>
</div>
<div id="page-content" class="<?= $this->fetch('content.class') ?>">
<?= $this->fetch('content') ?>
</div>
<?php $this->end() ?>
