<div class="container mx-auto px-4">
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <h2 class="text-2xl font-bold text-center mb-6">Edit User</h2>
            
            <?php if ($this->session->flashdata('success')): ?>
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (validation_errors()): ?>
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            
            <form action="" method="POST" class="space-y-4">
                <input type="hidden" name="ref" value="edit">
                
                <div>
                    <input type="text" name="name" value="<?php echo set_value('name', $user->name); ?>" placeholder="Full Name*" title="Full Name*" required="required" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
                
                <div>
                    <input type="email" name="email" value="<?php echo set_value('email', $user->email); ?>" placeholder="Email*" title="Email*" required="required" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
                
                <div>
                    <input type="text" name="phone" value="<?php echo set_value('phone', $user->phone); ?>" placeholder="Phone" title="Phone" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-300" />
                </div>
                
                <div>
                    <button class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update User</button>
                </div>
            </form>
            
            <div class="text-center mt-6">
                <a href="<?php echo base_url('users'); ?>" class="text-blue-500 hover:underline">Back to Members</a>
            </div>
        </div>
    </div>
</div>