<div class="max-w-md mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
    
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
        <input type="hidden" name="ref" value="register_step_one">
        
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name*</label>
            <input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   required="required" />
        </div>
        
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email*</label>
            <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   required="required" />
        </div>
        
        <div class="mb-6">
            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone (optional)</label>
            <input type="text" name="phone" id="phone" value="<?php echo set_value('phone'); ?>" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        
        <div class="mb-6">
            <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Continue to Create Password
            </button>
        </div>
    </form>
    
    <div class="text-center">
        <p>Already have an account? <a href="<?php echo base_url('log-in'); ?>" class="text-blue-500 hover:underline">Login</a></p>
    </div>
</div>