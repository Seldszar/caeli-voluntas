<?php $this->assign('body.id', 'homepage') ?>
<?php $this->set('no-header', true) ?>

<?php if ($articles) : ?>
<?php foreach ($articles as $article) : ?>
<div class="blog-article">
<h1><?php echo $this->Html->link($article['BlogArticle']['title'], array('action' => 'view', $article['BlogArticle']['id'])) ?></h1>
<div class="by-line"><?php echo $this->Time->timeAgoInWords($article['BlogArticle']['created']) ?> par <?php echo $this->Html->link($article['CreatedBy']['username'], array('controller' => 'users', 'action' => 'view', $article['CreatedBy']['id'])) ?></div>
<?php echo $this->Markitup->parse($article['BlogArticle']['content']) ?>
</div>
<?php endforeach ?>
<?php echo $this->element('paginator', array('class' => 'center')) ?>
<?php else : ?>
<div class="blog-article">
<h2 class="caption-empty">Il n'y a actuellement aucun article</h2>
</div>
<?php endif ?>
