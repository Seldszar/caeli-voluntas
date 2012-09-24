<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Etat du recrutement') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Etat du recrutement') ?>

<ul class="ui-custom-list">
<?php foreach ($classes as $class): ?>
<li>
<ul class="float-left">
<li class="color-c<?php echo $class['CharacterClass']['id'] ?>"><?php echo $class['CharacterClass']['name'] ?></li>
</ul>
<ul class="float-right ui-button-set on-hover">
<?php foreach ($class['CharacterSpec'] as $spec): ?>
<li><?php echo $this->Html->link($spec['name'], '#', array('data-spec' => $spec['id'], 'class' => array($spec['recruitment_active'] ? 'checked' : null), 'style' => array('width: 93px;'))) ?></li>
<?php endforeach ?>
</ul>
</li>
<?php endforeach ?>
</ul>

<?php $this->start('scripts') ?>
$(function() {
	$('a[data-spec]').click(function() {
		var $t = $(this);
		$.post('<?php echo $this->Html->url(array('action' => 'toggle')) ?>', { id: $t.data('spec') }, function(data) {
			if (data.value) {
				$t.addClass('checked');
			} else {
				$t.removeClass('checked');
			}
		}, 'json');
		return false;
	});
});
<?php $this->end() ?>