<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Forums') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Forums') ?>

<?php if (!empty($categories)) : ?>
<div id="categories">
<?php foreach ($categories as $category) : ?>
<div id="category-<?php echo $category['ForumCategory']['id'] ?>" class="section category">
<h3><?php echo $this->Html->link($category['ForumCategory']['name'], array('action' => 'edit', $category['ForumCategory']['id'])) ?> <em>(<?php echo $this->Html->link('Supprimer', array('action' => 'delete', $category['ForumCategory']['id']), null, 'Voulez-vous vraiment supprimer cette catégorie ?') ?>)</em></h3>
<div class="category-inner">
<ul class="ui-custom-list forums" data-category="<?php echo $category['ForumCategory']['id'] ?>">
<?php foreach ($category['Forum'] as $forum) : ?>
<li id="forum-<?php echo $forum['id'] ?>">
<?php echo $this->Html->link($forum['name'], array('controller' => 'forums', 'action' => 'edit', $forum['id'])) ?> <span class="link-desc">(<?php echo $this->Html->link('Supprimer', array('controller' => 'forums', 'action' => 'delete', $forum['id']), array('class' => 'link-desc'), 'Voulez-vous vraiment supprimer ce forum ?') ?>)</span>
<div class="link-desc"><?php echo $forum['description'] ?></div>
</li>
<?php endforeach ?>
</ul>
</div>
</div>
<?php endforeach ?>
</div>
<?php endif ?>
<div class="section-action">
<?php echo $this->Html->link('Ajouter un forum', array('controller' => 'forums', 'action' => 'create', $category['ForumCategory']['id']), array('class' => 'ui-button')) ?>
<?php echo $this->Html->link('Ajouter une catégorie', array('action' => 'create')) ?>
</div>

<?php $this->start('scripts') ?>
$(function() {
	$('#categories').sortable({
		items: '.category',
		axis: 'y',
		update: function() {
			$.post('<?php echo $this->Html->url(array('action' => 'order')) ?>', $(this).sortable('serialize'));
		}
	}).disableSelection();

	$('.category h3').click(function() {
		$(this).parent().children('.category-inner').slideToggle();
	}).css('cursor', 'pointer');

	$('.forums').sortable({
		connectWith: '.forums',
		axis: 'y',
		update: function() {
			$.post('<?php echo $this->Html->url(array('controller' => 'forums', 'action' => 'order')) ?>/' + $(this).data('category'), $(this).sortable('serialize'));
		}
	}).disableSelection();
});
<?php $this->end() ?>