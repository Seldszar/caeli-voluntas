<?php $this->Html->addCrumb('Forums') ?>

<?php $this->assign('header.image', 'forums') ?>
<?php $this->assign('header.title', 'Forums') ?>

<?php if (!empty($categories)): ?>
<?php foreach ($categories as $category): ?>
<?php if (!empty($category['Forum'])): ?>
<div class="section">
<h3><?php echo $category['ForumCategory']['name'] ?></h3>
<ul class="link-list">
<?php foreach ($category['Forum'] as $forum) : ?>
<li class="span-2">
<a href="<?php echo $this->Html->url(array('controller' => 'forums', 'action' => 'view', $forum['id'])) ?>"><?php echo $forum['name'] ?></a>
<div class="link-desc"><?php echo $forum['description'] ?></div>
</li>
<?php endforeach ?>
</ul>
</div>
<?php endif ?>
<?php endforeach ?>
<?php else : ?>
<h2 class="caption-empty">Il n'y a actuellement aucun forum disponible</h2>
<?php endif ?>
