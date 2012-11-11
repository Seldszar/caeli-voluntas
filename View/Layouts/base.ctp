<!DOCTYPE html>
<html>
<head>
<title><?php echo $this->Html->getCrumbListStr(" - ", "Caeli Voluntas") ?></title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<link rel="favicon" href="<?php echo $this->Html->url('/img/favicon.png') ?>" type="image/png" />
<?php echo $this->Html->css(array('https://fonts.googleapis.com/css?family=Oswald:300|Open+Sans|Open+Sans:400italic|Open+Sans:600|Open+Sans:600italic', 'global')); ?>
<?php echo $this->Html->script('modernizr') ?>
<script type="text/javascript">Modernizr.load({ test: Modernizr.fontface, nope: 'js/cufon.js' });</script>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-35239300-1']);
_gaq.push(['_setDomainName', 'caeli-voluntas.fr']);
_gaq.push(['_trackPageview']);
(function() {var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
</head>
<body id="<?php echo $this->fetch('body.id') ?>" class="<?php echo $this->fetch('body.class') ?>">
<div id="background"></div>
<div id="page">
<div id="header">
<a id="logo" href="<?php echo $this->Html->url(array('controller' => 'blog', 'action' => 'index', 'admin' => false)) ?>"></a>
<div id="menu">
<a href="<?php echo $this->Html->url(array('controller' => 'forums', 'action' => 'index', 'admin' => false)) ?>"><span>Forums</span></a>
<a href="<?php echo $this->Html->url(array('controller' => 'roster', 'action' => 'index', 'admin' => false)) ?>"><span>Roster</span></a>
<a href="<?php echo $this->Html->url(array('controller' => 'gallery', 'action' => 'index', 'admin' => false)) ?>"><span>Galerie</span></a>
<a href="<?php echo $this->Html->url(array('controller' => 'rules', 'action' => 'index', 'admin' => false)) ?>"><span>Charte</span></a>
</div>
</div>
<div id="topbar">
<ul class="float-left">
<div id="breadcrumb">
<?php echo $this->Html->getCrumbList(null, "Caeli Voluntas") ?>
</div>
</ul>
<ul class="float-right">
<?php if (AuthComponent::user()) : ?>
<li><?php echo $this->Html->link(AuthComponent::user('username'), array('controller' => 'users', 'action' => 'index', 'admin' => false)) ?></li>
<li><?php echo $this->Html->link("Se déconnecter", array('controller' => 'users', 'action' => 'logout', 'admin' => false)) ?></li>
<?php else : ?>
<li><a id="login-action" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login', 'admin' => false)) ?>">Se connecter</a></li>
<li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'register', 'admin' => false)) ?>">S'inscrire</a></li>
<?php endif ?>
</ul>
</div>
<div id="content">
<?php echo $this->fetch('_content') ?>
</div>
<div id="footer">
<div class="float-left">&copy; Caeli Voluntas 2012 - Tous droits réservés</div>
<div class="float-right">Créé par Alexandre.B avec <?php echo $this->Html->link('CakePHP', 'http://cakephp.org/') ?></div>
</div>
</div>
<?php echo $this->Html->script(array('jquery', 'jquery-ui', 'common', 'tooltip', 'toolbar')); ?>
<?php if ($this->fetch('scripts')) : ?>
<script type="text/javascript">
<?php echo $this->fetch('scripts') ?>
</script>
<?php endif ?>
</body>
</html>