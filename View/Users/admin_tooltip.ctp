<h3><?php echo $user['User']['username'] ?></h3>
<ul>
<li>Inscription : <?php echo $this->Time->timeAgoInWords($user['User']['created']) ?></li>
<li>Dernière connexion : <?php echo $user['User']['last_login'] ? $this->Time->timeAgoInWords($user['User']['last_login']) : 'Aucune' ?></li>
<li>Dernière IP utilisée : <?php echo $user['User']['last_ip'] ? $user['User']['last_ip'] : 'Inconnue' ?></li>
</ul>