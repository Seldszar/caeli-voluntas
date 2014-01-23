<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Forums', array('action' => 'index')) ?>
<?php $this->Html->addCrumb($category['ForumCategory']['name']) ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', $category['ForumCategory']['name']) ?>
<?php $this->start('header.description') ?>
<div class="section-action">
<?= $this->Html->link('Editer', array('action' => 'edit', $category['ForumCategory']['id']), array('class' => 'ui-button')) ?>
</div>
<?php $this->end() ?>

<?php if (!empty($category['Forum'])) : ?>
<ul class="ui-custom-list" id="forums">
<?php foreach ($category['Forum'] as $forum) : ?>
<li id="forum-<?php echo $forum['id'] ?>">
<ul class="float-left">
<li>
<?= $this->Html->link($forum['name'], array('controller' => 'forums', 'action' => 'edit', $forum['id'])) ?>
<div class="link-desc"><?php echo $forum['description'] ?></div>
</li>
</ul>
<ul class="float-right ui-button-set on-hover">
<li><?php echo $this->Html->link('Supprimer', array('controller' => 'forums', 'action' => 'delete', $forum['id']), null, 'Voulez-vous vraiment supprimer ce forum ?') ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
<?php else : ?>
<h2 class="caption-empty">Il n'y a actuellement aucun forum</h2>
<?php endif ?>
<div class="section-action">
<?= $this->Html->link('Ajouter un forum', array('controller' => 'forums', 'action' => 'create', $category['ForumCategory']['id']), array('class' => 'ui-button')) ?>
</div>

<?php $this->start('scripts') ?>
$(function() {
	$('#forums').sortable({
	axis: 'y',
	update: function() {
		$.post('<?php echo $this->Html->url(array('controller' => 'forums', 'action' => 'order', $category['ForumCategory']['id'])) ?>', $(this).sortable('serialize'));
		}
	});
});
<?php $this->end() ?>