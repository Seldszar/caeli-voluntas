<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Galerie') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Galerie') ?>

<?php if (!empty($images)) : ?>
<ul class="ui-custom-list">
<?php foreach ($images as $image): ?>
<li>
<ul class="float-left">
<li><?php echo $this->Html->link($image['GalleryImage']['caption'], array('action' => 'view', $image['GalleryImage']['id'])) ?></li>
</ul>
<ul class="float-right on-hover">
<li><?php echo $this->Html->link('Supprimer', array('action' => 'delete', $image['GalleryImage']['id']), null, "Voulez-vous vraiment supprimer cette image ?") ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
<?php endif ?>
<?php echo $this->Html->link('Ajouter une image', array('action' => 'create'), array('class' => 'ui-button')) ?>
