<!-- 全部话题 -->
<div style="margin-top: 16px; padding-bottom: 20px; border-bottom: #cccccc dashed 1px;">
    <?php foreach($topics_all as $v): ?>
        <?php if($v['topic_pid'] ==0):?>
            <h4 style="margin-bottom: 10px;"><?php echo $v['topic_name']?></h4>
          <?php foreach ($topics_all as $vv):?>
           <?php if($vv['topic_pid'] == $v['topic_id']):?>
             <span class="topic_span" ><a href="<?php echo site_url('topic/topic_show/'.$vv['topic_id']) ?>"> <?php echo $vv['topic_name']?></a></span>
           <?php endif?>
          <?php endforeach;?>
        <div class="clearfix"></div>
    <?php endif; endforeach;?>
    <div style="clear: both"></div>
</div>