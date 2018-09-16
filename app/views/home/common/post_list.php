<?php if (!empty($posts)) foreach ($posts as $v): ?>
    <li class="posts_list">
        <div style="margin-bottom: 8px;">
            <a href="<?php echo site_url('user/user_home/' . $v['uid']) ?>" target="_blank" style="float: left; margin-right: 16px; margin-left: 16px; text-align: center;">
                <img alt="<?php echo $v['username'] ?>"src="<?php echo base_url($v['avatar']) ?>" style="border-radius:50%; height:46px; margin-bottom:5px; width:46px; "/> 
                <div class="text-muted"><?php echo $v['username']?></div>
            </a>
            <div style="float: left; width: 580px;">
                <a class="post_title" href="<?php echo site_url('post/show/' . $v['post_id']) ?>" target="_blank" >
                    <span style="font-size: 16px;"><?php echo $v['title'] ?></span>
                
                    <div style="min-height: 40px; font-size: 13px; color: #777; margin: 5px 0px;"><?php echo content_part($v['content'])?></div>
                </a>
                <div class="text-muted" style="font-size: 12px; margin-top: 8px;">
                    <a class="topic_small" href="<?php echo site_url('topic/topic_show/' . $v['topic_id']) ?>" target="_blank"><?php echo $v['topic_name'] ?></a>
                        &nbsp;•&nbsp;
                        <?php if ($v['is_good'] == 1): ?><span class="post_good">精</span> &nbsp;•&nbsp;<?php endif ?>
                        <?php if ($v['is_top'] == 1): ?><span class="post_top">置顶</span> &nbsp;•&nbsp;<?php endif ?>
                        <span class="glyphicon glyphicon-comment" style="color: #0785d1;"><span style="margin-left: 4px;"><?php echo $v['comments_count'] ?></span></span>
                        <div style="float: right; ">
                        <?php echo wordTime($v['reply_last_time']) ?>
                        
                    </div><div style="clear:both"></div>
                </div>
            </div>
    <div style="clear:both"></div>
    </li>
<?php endforeach; ?>

