<div class="topic_hot_div">
    <span style="font-size: 14px; margin-left: 12px;">热门话题：</span>
    <?php if (!empty($topics)) foreach ($topics as $v): ?>
        <a class="topic_hot_box <?php if(!empty($topic['topic_id']) && $topic['topic_id']==$v['topic_id']) echo 'topic_hot_select' ?>"  href="<?php echo site_url('topic/topic_show/'.$v['topic_id'])?>" title="帖子 <?php echo $v['posts_count'] ?>">
             <img src="<?php echo base_url($v['ico']) ?>" style="width: 30px; height: 25px; border-radius: 2px;">
             <span><?php echo $v['topic_name'] ?></span>
        </a>
    <?php endforeach?>
    <div style="clear:both;"></div>
</div>