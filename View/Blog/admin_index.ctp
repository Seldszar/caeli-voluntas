<?php $this->Html->addCrumb(AuthComponent::user('username'), array('controller' => 'users')) ?>
<?php $this->Html->addCrumb('Blog') ?>

<?php $this->assign('header.image', 'administration') ?>
<?php $this->assign('header.title', 'Blog') ?>

<ul class="ui-custom-list">
<?php foreach($articles as $article): ?>
<li>
<?php echo $this->Html->link($article['BlogArticle']['title'], array('action' => 'edit', $article['BlogArticle']['id'], 'admin' => true)) ?>
<div class="link-desc"><?php echo $this->Time->timeAgoInWords($article['BlogArticle']['created']) ?> par <?php echo $article['CreatedBy']['username'] ?></div>
</li>
<?php endforeach ?>
</ul>
<div class="section-action">
<?php echo $this->Html->link('Ajouter un article', array('action' => 'create'), array('class' => 'ui-button')) ?>
</div>
