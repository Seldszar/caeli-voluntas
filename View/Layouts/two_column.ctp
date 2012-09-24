<?php $this->extend('/Layouts/two_column_base') ?>

<?php $this->start('left') ?>
<div id="page-header" style="background-image: url('<?php echo $this->Html->url('/img/headers/' . $this->fetch('header.image') . '.jpg') ?>')">
<h1><?php echo $this->fetch('header.title') ?></h1>
<?php if ($this->fetch('header.description')): ?>
<div class="description"><?php echo $this->fetch('header.description') ?></div>
<?php endif ?>
</div>
<div id="page-content">
<?php echo $this->fetch('content') ?>
</div>
<?php $this->end() ?>

<?php $this->start('right') ?>
<?php echo $this->element('sidebar/encounters') ?>
<?php echo $this->element('sidebar/recruitment') ?>
<?php $this->end() ?>
