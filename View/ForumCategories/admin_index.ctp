<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Catégories') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Catégories') ?>

<?php if (!empty($categories)) : ?>
<ul class="ui-custom-list" id="categories">
<?php foreach ($categories as $category) : ?>
<li id="category-<?php echo $category['ForumCategory']['id'] ?>">
<ul class="float-left">
<li><?php echo $this->Html->link($category['ForumCategory']['name'], array('action' => 'view', $category['ForumCategory']['id'])) ?></li>
</ul>
<ul class="float-right ui-button-set on-hover">
<li><?php echo $this->Html->link('Supprimer', array('action' => 'delete', $category['ForumCategory']['id']), null, 'Voulez-vous vraiment supprimer cette catégorie ?') ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
<?php endif ?>
<div class="section-action">
<?php echo $this->Html->link('Ajouter une catégorie', array('action' => 'create'), array('class' => 'ui-button')) ?>
</div>

<?php $this->start('scripts') ?>
$(function() {
	$('#categories').sortable({
		axis: 'y',
		update: function() {
			$.post('<?php echo $this->Html->url(array('action' => 'order')) ?>', $(this).sortable('serialize'));
		}
	});
});
<?php $this->end() ?>