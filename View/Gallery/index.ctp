<?php $this->Html->addCrumb("Galerie") ?>

<?php $this->assign('header.image', 'gallery') ?>
<?php $this->assign('header.title', "Galerie") ?>

<?php if (!empty($images)): ?>
<ul id="gallery">
<?php foreach ($images as $image): ?>
<li><?= $this->Html->link($this->Html->image($image['GalleryImage']['file_url'], array('alt' => $image['GalleryImage']['caption'], 'title' => $image['GalleryImage']['caption'])), array('action' => 'view', $image['GalleryImage']['id']), array('escape' => false)) ?></li>
<?php endforeach ?>
</ul>
<?php else: ?>
<h2 class="caption-empty">Il n'y a actuellement aucune image dans la galerie</h2>
<?php endif ?>