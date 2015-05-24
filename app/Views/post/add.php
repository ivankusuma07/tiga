<h4>Add Post</h4>
<form class='form' method="POST" action="<?php echo tiga_url('dashboard/posts/create')?>">
	<?php include __DIR__."/form.php" ?>
	<a class='btn btn-success' href='<?php echo tiga_url('dashboard/posts') ?>'>Posts List</a>
	<input class='btn btn-primary' type='submit' value='Create'>
</form>
