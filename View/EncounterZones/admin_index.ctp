<?php $this->Html->addCrumb($this->Auth->user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Avancée raids') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Avancée raids') ?>

<ul class="ui-custom-list" id="encounter-zones">
<?php foreach($zones as $zone): ?>
<li id="encounter-zone-<?php echo $zone['EncounterZone']['id'] ?>">
<ul class="float-left">
<li><?php echo $this->Html->link($zone['EncounterZone']['name'], array('action' => 'view', $zone['EncounterZone']['id'])) ?></li>
</ul>
<ul class="float-right">
<li><div class="link-desc">Normal : <?php echo $zone['EncounterZone']['normal_progress'] ?> / <?php echo $zone['EncounterZone']['num_bosses'] ?></div></li>
<li><div class="link-desc">Héroïque : <?php echo $zone['EncounterZone']['heroic_progress'] ?> / <?php echo $zone['EncounterZone']['num_bosses'] ?></div></li>
</ul>
</li>
<?php endforeach ?>
</ul>
<div class="section-action">
<?php echo $this->Html->link('Ajouter une zone', array('action' => 'create'), array('class' => 'ui-button')) ?>
</div>

<?php $this->start('scripts') ?>
$(function() {
	$('#encounter-zones').sortable({
		axis: 'y',
		update: function() {
			$.post('<?php echo $this->Html->url(array('controller' => 'encounterZones', 'action' => 'order')) ?>', $(this).sortable('serialize'));
		}
	});
});
<?php $this->end() ?>