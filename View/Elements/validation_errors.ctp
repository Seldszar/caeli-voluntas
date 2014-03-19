<div class="message error">
<ul>
<?php foreach ($this->validationErrors as $error) : ?>
	<?php foreach ($error as $field) :  ?>
		<li><?= $field[0] ?></li>
	<?php endforeach ?>
<?php endforeach ?>
</ul>
</div>