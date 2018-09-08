<!-- 全部话题 -->
<div style="margin-top: 16px; padding-bottom: 20px; border-bottom: #cccccc dashed 1px;">
    <h5 style="margin-bottom: 10px;">全部话题</h5>
    <?php foreach($topics_all as $v): ?>
    <span class="topic_span" ><a href="<?php echo site_url('topic/topic_show/'.$v['topic_id']) ?>"> <?php echo $v['topic_name']?></a></span>
    <?php endforeach;?>
    <div style="clear: both"></div>
</div>