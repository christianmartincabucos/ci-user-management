<div class="max-w-md mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
    
    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    
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
        <input type="hidden" name="ref" value="login">
        
        <div class="mb-4">
            <input type="email" name="email" value="<?php echo set_value('email'); ?>" 
                   placeholder="Email*" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" 
                   required="required" />
        </div>
        
        <div class="mb-4">
            <input type="password" name="password" 
                   placeholder="Password*" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" 
                   required="required" />
        </div>
        
        <div class="mb-6">
            <button class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Login
            </button>
        </div>
    </form>
    
    <div class="text-center">
        <p>Don't have an account? <a href="<?php echo base_url('register'); ?>" class="text-primary hover:underline">Register</a></p>
    </div>
</div>