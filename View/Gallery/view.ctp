<?php $this->Html->addCrumb("Galerie", array('action' => 'index')) ?>
<?php $this->Html->addCrumb($image['GalleryImage']['caption']) ?>

<?php $this->assign('header.image', 'gallery') ?>
<?php $this->assign('header.title', $image['GalleryImage']['caption']) ?>

<div id="gallery-view">
<div id="gallery-image"><?= $this->Html->image($image['GalleryImage']['file_url']) ?></div>
<p><?= $this->Html->link("Voir l'original", $image['GalleryImage']['file_url'], array('class' => 'ui-button')) ?></p>
</div>