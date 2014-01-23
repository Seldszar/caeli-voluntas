<?php $this->extend('/Layouts/default') ?>
<?php $this->assign('body.class', 'one_column') ?>

<?php $this->start('_content') ?>
<div id="page-header" style="background-image: url('<?php echo $this->Html->url('/img/headers/full-forums.jpg') ?>')">
<h1><?php echo $this->fetch('header.title') ?></h1>
<?= $this->fetch('header.description') ?>
</div>
<div id="forums-top">
<?= $this->fetch('forums.top') ?>
</div>
<div id="page-content" class="<?php echo $this->fetch('content.class') ?>">
<?= $this->fetch('content') ?>
</div>
<?php $this->end() ?>