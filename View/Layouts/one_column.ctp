<?php $this->extend('/Layouts/default') ?>
<?php $this->assign('body.class', 'one_column') ?>

<?php $this->start('_content') ?>
<div id="page-header" style="background-image: url('<?php echo $this->Html->url('/img/headers/full-header.jpg') ?>')">
<h1><?php echo $this->fetch('header.title') ?></h1>
<?php echo $this->fetch('header.description') ?>
<?php if ($this->fetch('top')) : ?>
<div id="page-content-top">
<?php echo $this->fetch('top') ?>
</div>
<?php endif ?>
</div>
<div id="page-content" class="<?php echo $this->fetch('content.class') ?>">
<?php echo $this->fetch('content') ?>
</div>
<?php $this->end() ?>
