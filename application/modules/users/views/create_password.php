<div class="max-w-md mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-2 text-center">Create Password</h2>
    <p class="text-center text-gray-600 mb-6">Please create a secure password for your account</p>
    
    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
    
    <?php if (validation_errors()): ?>
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
    
    <form action="" method="POST">
        <input type="hidden" name="ref" value="register_step_two">
        <input type="hidden" name="token" value="<?php echo $user_token; ?>">
        
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password*</label>
            <input type="password" name="password" id="password"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   required="required" />
            <p class="text-gray-600 text-xs mt-1">Must be at least 6 characters</p>
        </div>
        
        <div class="mb-6">
            <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password*</label>
            <input type="password" name="confirm_password" id="confirm_password"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   required="required" />
        </div>
        
        <div class="mb-6">
            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Complete Registration
            </button>
        </div>
    </form>
</div>