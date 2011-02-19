<?php if ( ! empty($errors)): ?>
<ul class="errors">
<?php foreach ($errors as $error): ?>
	<li><?php echo ucfirst(__($error)) ?></li>
<?php endforeach ?>
</ul>
<?php endif ?>