<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Galerie') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Galerie') ?>

<?php if (!empty($images)) : ?>
<ul class="ui-custom-list">
<?php foreach ($images as $image): ?>
<li>
<ul class="float-left">
<li><?= $this->Html->link($image['GalleryImage']['caption'], array('action' => 'view', $image['GalleryImage']['id'])) ?></li>
</ul>
<ul class="float-right on-hover">
<li><?= $this->Html->link('Supprimer', array('action' => 'delete', $image['GalleryImage']['id']), null, "Voulez-vous vraiment supprimer cette image ?") ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
<?php endif ?>
<?= $this->Html->link('Ajouter une image', array('action' => 'create'), array('class' => 'ui-button')) ?>
