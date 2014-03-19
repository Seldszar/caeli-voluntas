<h3><?= $user['User']['username'] ?></h3>
<ul>
<li>Inscription : <?= $this->Time->timeAgoInWords($user['User']['created']) ?></li>
<li>Dernière connexion : <?= $user['User']['last_login'] ? $this->Time->timeAgoInWords($user['User']['last_login']) : 'Aucune' ?></li>
<li>Dernière IP utilisée : <?= $user['User']['last_ip'] ? $user['User']['last_ip'] : 'Inconnue' ?></li>
</ul>