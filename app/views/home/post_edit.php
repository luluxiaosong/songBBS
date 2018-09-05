<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>发帖--mybbs</title>
    <script src="<?php echo base_url('static/ueditor/ueditor.config.js') ?>"></script>
    <script src="<?php echo base_url('static/ueditor/ueditor.all.js') ?>"></script>
<?php $this->load->view('home/common/header'); ?>

</head>
<script>
    $(function () {
        var ue = UE.getEditor('content');
    })
</script>
<body>
<?php $this->load->view('home/common/nav'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-1 col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="" style="padding:10px;">
                        <img style="height: 50px; width: 60px; border-radius: 6px" src="<?php echo base_url($topic['ico']) ?>"/> <span style="font-size: 20px;"><?php echo $topic['topic_name']; ?></span>
                        <p style="font-size: 10px; padding: 8px 0px 6px 0px;"><?php echo $topic['content'] ?> </p>
                    </div>
                    <hr />
                    <form accept-charset="UTF-8" class="form-horizontal" action="<?php echo site_url('post/post_add') ?>" id="new_post" method="post"  name="add_new">
                   <input type="hidden" name="topic_id" value="<?php echo $topic['topic_id'] ?>">
                       <div class="form-group">
                           <label class="control-label col-md-2" style="width: 12%">标题：</label>
                           <div class="col-md-9">
                           <input type="text" class="form-control"  name="title" placeholder="40字以内">
                          </div>
                       </div>
                        <br/>
                        <div class="form-group" >
                            <label class="control-label col-md-2" style="width: 12%">内容：</label>
                            <div class="col-md-6">
                            <textarea id="content" name="content"   style="height: 300px; width: 550px" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div style="margin-left: 14%">
                                <button type="submit" class="btn btn-primary">发布</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->
</div><!-- /.container -->
<footer class="small">
    <div class= "container">
    </div>
</footer>
</body>
</html>