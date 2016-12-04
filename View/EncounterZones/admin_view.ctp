<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>

<?php $this->Html->addCrumb('Avancée raids', array('action' => 'index')) ?>
<?php $this->Html->addCrumb($zone['EncounterZone']['name']) ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', $zone['EncounterZone']['name']) ?>

<?php $this->start('header.description') ?>
<div class="section-action">
<?php echo $this->Html->link('Editer', array('action' => 'edit', $zone['EncounterZone']['id']), array('class' => 'ui-button')) ?>
<?php echo $this->Html->link('Supprimer', array('action' => 'delete', $zone['EncounterZone']['id']), null, 'Voulez-vous vraiment supprimer cette zone ?') ?>
</div>
<?php $this->end() ?>
<ul class="ui-custom-list" id="encounters">
<?php foreach($zone['Encounter'] as $encounter): ?>
<li id="encounter-<?php echo $encounter['id'] ?>">
<?php echo $this->Html->link($encounter['name'], array('controller' => 'encounters', 'action' => 'edit', $encounter['id']), array('class' => 'link-title')) ?>
<ul class="float-right ui-button-set on-hover">
<li><?php echo $this->Html->link('Normal', '#', array('class' => ($encounter['normal'] ? 'checked' : null), 'data-encounter' => json_encode(array('id' => $encounter['id'], 'difficulty' => 'normal')))) ?></li>
<li><?php echo $this->Html->link('Héroïque', '#', array('class' => ($encounter['heroic'] ? 'checked' : null), 'data-encounter' => json_encode(array('id' => $encounter['id'], 'difficulty' => 'heroic')))) ?></li>
<li><?php echo $this->Html->link('Mythique', '#', array('class' => ($encounter['mythic'] ? 'checked' : null), 'data-encounter' => json_encode(array('id' => $encounter['id'], 'difficulty' => 'mythic')))) ?></li>
</ul>
</li>
<?php endforeach ?>
</ul>
<div class="section-action">
<?php echo $this->Html->link('Ajouter un boss', array('controller' => 'encounters', 'action' => 'create', $zone['EncounterZone']['id']), array('class' => 'ui-button')) ?>
</div>
<?php $this->start('scripts') ?>
$(function() {
	$('a[data-encounter]').click(function() {
		var $t = $(this);
		$.post('<?php echo $this->Html->url(array('controller' => 'encounters', 'action' => 'toggle')) ?>', $t.data('encounter'), function(data) {
			if (data.value) {
				$t.addClass('checked');
			} else {
				$t.removeClass('checked');
			}
		}, 'json');
		return false;
	});
	
	$('#encounters').sortable({
		axis: 'y',
		update: function() {
			$.post('<?php echo $this->Html->url(array('controller' => 'encounters', 'action' => 'order', $zone['EncounterZone']['id'])) ?>', $(this).sortable('serialize'));
		}
	});
});
<?php $this->end() ?>