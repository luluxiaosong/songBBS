<div  style="margin-top: 16px; padding-bottom: 20px; border-bottom: #cccccc dashed 1px;">
    <h5 style="margin-bottom: 10px;">热贴</h5>
    <?php foreach($posts_hot as $v): ?>
    <p style="margin: 8px 0 8px 0;"><a href="<?php echo site_url('post/show/'.$v['post_id']) ?>"> ● <?php echo $v['title'] ?></a></p>
    <?php endforeach ?>
</div>