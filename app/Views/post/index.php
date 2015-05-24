<h4>All Post</h4>
<table class="table table-condendsed">
	<tr>
		<th>No</th>
		<th>Post Title</th>
		<th>Publish Date</th>
		<th>Action</th>
	</tr>	
	<?php 
		$count = 1;

		global $post;

		foreach ($posts as $post) {

			setup_postdata($post);

			echo "<tr>";
			echo "<td>{$count}</td>";
			echo "<td>".get_the_title()."</td>";
			echo "<td>".get_the_date()."</td>";
			echo "<td>";
				echo "<a class='btn btn-sm btn-success'href='".tiga_url('/tiga-dashboard/posts/edit/'.$post->ID)."'>Edit</a>";
				echo "&nbsp;";
				echo "<a class='btn btn-sm btn-info'href='".get_permalink($post->ID)."'>Show</a>";
				echo "&nbsp;";
				echo "<a class='btn btn-sm btn-danger'href='".tiga_url('/tiga-dashboard/posts/delete/'.$post->ID)."'>Delete</a>";
			echo "</td>";
			echo "</tr>";

			$count++;
		}

	?>
</table>
<a class='btn btn-primary' href='<?php echo tiga_url('/dashboard/posts/add') ?>'>Add</a>
