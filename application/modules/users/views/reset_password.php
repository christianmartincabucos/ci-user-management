<div class="container mx-auto px-4">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <h2 class="text-2xl font-bold text-center mb-6">Reset Password for <?php echo $user->name; ?></h2>
            
            <?php if ($this->session->flashdata('success')): ?>
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (validation_errors()): ?>
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            
            <form action="" method="POST" class="space-y-4">
                <input type="hidden" name="ref" value="reset_password">
                
                <div>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="New Password*" 
                        title="New Password*" 
                        required 
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                    />
                </div>
                
                <div>
                    <input 
                        type="password" 
                        name="confirm_password" 
                        placeholder="Confirm New Password*" 
                        title="Confirm New Password*" 
                        required 
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300"
                    />
                </div>
                
                <div>
                    <button 
                        type="submit" 
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
                    >
                        Reset Password
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-6">
                <a 
                    href="<?php echo base_url('users'); ?>" 
                    class="text-blue-500 hover:underline"
                >
                    Back to Members
                </a>
            </div>
        </div>
    </div>
</div>