<?php $this->extend('/Layouts/two_column_base') ?>

<?php $this->start('left') ?>
<?php if (!$this->getVar('no-header')): ?>
<div id="page-header" style="background-image: url('<?= $this->Html->url('/img/headers/' . $this->fetch('header.image') . '.jpg') ?>')">
<h1><?= $this->fetch('header.title') ?></h1>
<?php if ($this->fetch('header.description')): ?>
<div class="description"><?= $this->fetch('header.description') ?></div>
<?php endif ?>
</div>
<?php endif ?>
<div id="page-content" class="<?= $this->fetch('content.class') ?>">
<?= $this->fetch('content') ?>
</div>
<?php $this->end() ?>

<?php $this->start('right') ?>
<?= $this->element('sidebar/encounters') ?>
<?= $this->element('sidebar/recruitment') ?>
<?= $this->element('sidebar/latest_topics') ?>
<?php $this->end() ?>
