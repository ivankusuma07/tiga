<?php get_header(); ?>
			
	<div id="content" class="clearfix row">
	
		<div id="main" class="col-sm-12 clearfix" role="main">
			<h4>Testing Form</h4>
			<?php
				$options = array(
						'url'=>tiga_url('/form/process'),
						'method'=>'POST'
					);

				// echo Form::open($options);
				echo Form::model($postModel,$options);
				echo Form::label('email', 'E-Mail Address', array('class' => 'awesome'));
				echo Form::text('email','todiadiyatmo@gmail.com');
				echo "<br>";
				echo Form::password('password');
				echo "<br>";
				echo Form::file('myfile');
				echo "<br>";
				echo Form::checkbox('ck1[]', 'rahasia 0');
				echo "rahasia 0";
				echo Form::checkbox('ck1[]', 'rahasia 1', true);
				echo "rahasia 1";
				echo Form::checkbox('ck1[]', 'rahasia 2', true);
				echo "rahasia 2";
				echo Form::checkbox('ck1[]', 'rahasia 3', true);
				echo "rahasia 3";
				echo "<br>";
				echo Form::radio('r1', 'radio 1', true);
				echo "radio 1";
				echo Form::radio('r1', 'radio 2');
				echo "radio 2";
				echo Form::radio('r1', 'radio 3');
				echo "radio 3";
				echo "<br>";
				echo Form::number('number', '14');
				echo "<br>";
				echo Form::select('size', array('L' => 'Large','M'=>'Medium' ,'S' => 'Small'),'S');
				echo "<br>";
				echo Form::select('animal', array(
				    'Cats' => array('leopard' => 'Leopard'),
				    'Dogs' => array('spaniel' => 'Spaniel'),
				));
				echo "<br>";
				echo Form::selectRange('number', 10, 20);
				echo "<br>";
				echo Form::selectMonth('month');
				echo Form::submit('Click Me!');
				echo Form::close();

			?>

		</div><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>