<?php $this->extend('/Layouts/two_column_base') ?>

<?php $this->start('left') ?>
<?php if (!$this->getVar('no-header')): ?>
<div id="page-header" style="background-image: url('<?php echo $this->Html->url('/img/headers/' . $this->fetch('header.image') . '.jpg') ?>')">
<h1><?php echo $this->fetch('header.title') ?></h1>
<?php if ($this->fetch('header.description')): ?>
<div class="description"><?php echo $this->fetch('header.description') ?></div>
<?php endif ?>
</div>
<?php endif ?>
<div id="page-content" class="<?php echo $this->fetch('content.class') ?>">
<?php echo $this->fetch('content') ?>
</div>
<?php $this->end() ?>

<?php $this->start('right') ?>
<?php echo $this->element('sidebar/encounters') ?>
<?php echo $this->element('sidebar/recruitment') ?>
<?php echo $this->element('sidebar/latest_topics') ?>
<?php $this->end() ?>
