<div class="form-group <?php echo $errorMessage['post_title']->hasError ?>">
    <label>Title</label>
    <input type='text' value="<?php echo Request::input('post_title',$post->post_title) ?>" 
    name='post_title' placeholder='Enter title' class='form-control' >
    <?php echo $errorMessage['post_title']->errorMessage ?>
</div>
<div class="form-group <?php echo $errorMessage['post_content']->hasError ?>">
    <label >Content</label>
    <?php echo $errorMessage['post_content']->errorMessage ?>
    <?php wp_editor( Request::input('post_content',$post->post_content),"post_content")?>
</div>