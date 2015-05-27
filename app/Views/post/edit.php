<h4>Edit Post</h4>
<form class='form' method="POST" action="<?php echo tiga_url("dashboard/posts/{$id}/update/")?>">
	<?php include __DIR__."/form.php" ?>
	<input class='btn btn-primary' type='submit' value='Update'>
</form>
