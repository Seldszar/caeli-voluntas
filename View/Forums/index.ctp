<?php $this->Html->addCrumb('Forums') ?>

<?php $this->assign('header.image', 'forums') ?>
<?php $this->assign('header.title', 'Forums') ?>

<?php if (!empty($categories)): ?>
<?php foreach ($categories as $category): ?>
<?php if (!empty($category['Forum'])): ?>
<div class="category-item">
<h2><?php echo $category['ForumCategory']['name'] ?></h2>
<table>
<?php foreach ($category['Forum'] as $forum) : ?>
<tr class="forum-item">
<td class="forum-item-icon">
<?php echo $this->Html->link(null, array('controller' => 'forums', 'action' => 'view', $forum['id'], '?' => array('unread' => true)), array('class' => array('forum-icon', ($forum['new_messages'] ? 'new-messages' : null)), 'title' => 'Voir les messages non-lus')) ?>
</td>
<td class="forum-item-desc">
<?php echo $this->Html->link($forum['name'], array('controller' => 'forums', 'action' => 'view', $forum['id'])) ?> <span class="link-desc">(<?php echo $forum['num_topics'] ?> sujets, <?php echo $forum['num_posts'] ?> messages)</span>
<div class="link-desc"><?php echo $forum['description'] ?></div>
<?php if ($forum['last_post']) : ?>
<div class="link-desc">Dernier message : <?php echo $this->Html->link($this->Time->timeAgoInWords($forum['LastPost']['created']), array('controller' => 'topics', 'action' => 'view', $forum['LastPost']['topic'], '#' => 'p' . $forum['LastPost']['id'])) ?> par <?php echo $this->Html->link($forum['LastPost']['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $forum['LastPost']['CreatedBy']['id'])) ?></div>
<?php endif ?>
</td>
</tr>
<?php endforeach ?>
</table>
</div>
<?php endif ?>
<?php endforeach ?>
<?php else : ?>
<h2 class="caption-empty">Il n'y a actuellement aucun forum disponible</h2>
<?php endif ?>
