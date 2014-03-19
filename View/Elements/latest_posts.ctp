<?php if (!empty($posts)) : ?>
<div id="latest-posts">
<h2>Derniers messages postés <em>(du plus récent au plus vieux)</em></h2>
<table id="posts">
<?php foreach ($posts as $post) : ?>
<tr class="post" id="p<?= $post['id'] ?>">
<td class="post-author">
<div class="avatar">
<img src="<?= $post['CreatedBy']['avatar_url'] ?>" alt="Avatar de <?= $post['CreatedBy']['username'] ?>" />
</div>
<?= $this->Html->link($post['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $post['CreatedBy']['id']), array('class' => 'name', 'style' => (!empty($post['CreatedBy']['Group']['color']) ? "color: #{$post['CreatedBy']['Group']['color']}" : null))) ?>
<div class="group"><?= $post['CreatedBy']['Group']['name'] ?></div>
</td>
<td>
<div class="post-date"><?= $this->Html->link($this->Time->timeAgoInWords($post['created']), array('controller' => 'topics', 'action' => 'view', $post['topic'], '#' => 'p' . $post['id'])) ?> <?php if ($post['edited']) : ?>(édité par <?= $post['EditedBy']['username'] ?>, <?= $this->Time->timeAgoInWords($post['edited']) ?>)<?php endif ?></div>
<div class="post-body">
<?= $this->Parser->parseAsString($post['content'], 'bbcode') ?>
</div>
</td>
</tr>
<?php endforeach ?>
</table>
</div>
<?php endif ?>
