<?php $this->Html->addCrumb('Forums', array('controller' => 'forums', 'action' => 'index')) ?>
<?php $this->Html->addCrumb($post['ForumTopic']['Forum']['name'], array('controller' => 'forums', 'action' => 'view', $post['ForumTopic']['Forum']['id'])) ?>
<?php $this->Html->addCrumb($post['ForumTopic']['title'], array('controller' => 'topics', 'action' => 'view', $post['ForumTopic']['id'])) ?>
<?php $this->Html->addCrumb('Editer un message') ?>

<?php $this->assign('header.image', 'forums') ?>
<?php $this->assign('header.title', 'Editer un message') ?>

<?php echo $this->Session->flash() ?>
<?php echo $this->Form->create() ?>
<?php echo $this->Form->input('content', array('label' => false, 'placeholder' => 'Message', 'rows' => 12)) ?>
<?php echo $this->Form->end('Envoyer') ?>

<?php $this->start('scripts') ?>
$(function() {
	$('#ForumPostContent').toolbar({
		tags: {
			'bold': '[b]{0}[/b]',
			'italic': '[i]{0}[/i]',
			'underline': '[u]{0}[/u]',
			'list': '[list]{0}[/list]',
			'list-item': '[*]{0}[/*]',
			'quote': '[quote]{0}[/quote]'
		},
		class: 'clearfix'
	});
});
<?php $this->end() ?>