<!--我的资料 -->
<?php $this->load->view('home/common/nav'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <!--我的资料-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-2">
                        <img style="height: 80px;" class="img-rounded img-responsive"
                             src="<?php echo base_url($user['avatar']); ?>" alt="admin large avatar">
                    </div>
                    <div class="col-md-6">
                        <p style="padding-top: 6px; font-size: 20px;"><?php echo $user['username']; ?></p>
                        <p style="padding-top: 6px; font-size: 12px;"><?php echo $user['signature'] ?></p>
                        <p style="padding-top: 6px; font-size: 14px;"><?php echo $user['introduction'] ?></p>
                        <p style="padding-top: 6px; font-size: 14px;"><a  href="<?php echo site_url('personal/set') ?>">修改资料</a>
                        </p>
                    </div>

                </div>
            </div>
            <!--end 我的资料 -->

