<?php if (!empty($posts)) foreach ($posts as $v): ?>
    <li class="posts_list">
        <div style="margin-bottom: 8px;">
            <a href="<?php echo site_url('user/user_home/' . $v['uid']) ?>" target="_blank"><img alt="<?php echo $v['username'] ?>"src="<?php echo base_url($v['avatar']) ?>" class="img-rounded" style="height:46px; width:46px; margin-right: 14px; float: left"/></a>
            <a class="post_title" href="<?php echo site_url('post/show/' . $v['post_id']) ?>" target="_blank" >
                <span style="font-size: 15px;"><?php echo $v['title'] ?></span>
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
        <div class="text-muted" style="font-size: 12px; margin-top: 8px;">
             <a href="<?php echo site_url('user/user_home/' . $v['uid']) ?>" class="text-muted"target="_blank" ><?php echo $v['username']?></a>
            &nbsp;•&nbsp;
            <a class="topic_small" href="<?php echo site_url('topic/show/' . $v['topic_id']) ?>" target="_blank"><?php echo $v['topic_name'] ?></a>
            <div style="float: right">
                <?php if ($v['is_good'] == 1): ?><span class="post_good">精</span> &nbsp;•&nbsp;<?php endif ?>
                <?php if ($v['is_top'] == 1): ?><span class="post_top">置顶</span> &nbsp;•&nbsp;<?php endif ?>
                <?php echo wordTime($v['reply_last_time']) ?>
                &nbsp;•&nbsp;
                <span class="glyphicon glyphicon-comment" style="color: #0785d1;"><span style="margin-left: 4px;"><?php echo $v['comments_count'] ?></span></span>
            </div><div style="clear:both"></div>
        </div>
    </div><div style="clear:both"></div>

    </li>
<?php endforeach; ?>

