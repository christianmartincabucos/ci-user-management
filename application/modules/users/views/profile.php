<div class="container">
    <div class="row">
        <div class="col-xs-60 col-sm-40 center-block">
            <h2 class="page-title">User Profile</h2>
            
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($user) && $user): ?>
                <div class="profile-details">
                    <div class="row">
                        <div class="col-sm-20">Name:</div>
                        <div class="col-sm-40"><?php echo $user->name; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-20">Email:</div>
                        <div class="col-sm-40"><?php echo $user->email; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-20">Phone:</div>
                        <div class="col-sm-40"><?php echo $user->phone ? $user->phone : 'N/A'; ?></div>
                    </div>
                </div>
                
                <div class="row mt-4 text-center">
                    <a href="<?php echo base_url('users/edit'); ?>" class="button button--secondary">Edit Profile</a>
                    <a href="<?php echo base_url('users'); ?>" class="button button--secondary">Members List</a>
                    <a href="<?php echo base_url('users/logout'); ?>" class="button">Logout</a>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">User not found</div>
            <?php endif; ?>
        </div>
    </div>
</div>