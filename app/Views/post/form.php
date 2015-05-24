<div class="form-group">
    <label>Title</label>
    <input type='text' value="<?php echo Request::input('post_title',$post->post_title) ?>" 
    name='post_title' placeholder='Enter title' class='form-control' >
</div>
<div class="form-group">
    <label >Content</label>
    <?php wp_editor( Request::input('post_content',$post->post_content),"post_content")?>
</div>