<!-- filepath: /Users/christianmartincabucos/Downloads/test-BE/application/modules/users/views/index.php -->
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Members</h2>
    
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
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($users)): ?>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $user->name; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $user->email; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $user->phone ? $user->phone : 'N/A'; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                <a href="<?php echo base_url('users/edit/'.$user->id); ?>" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                                <a href="<?php echo base_url('users/reset_password/'.$user->id); ?>" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">Reset Password</a>
                                <?php if ($user->id != $this->session->userdata('user_id')): ?>
                                    <a href="javascript:void(0);" 
                                        class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm" 
                                        onclick="confirmDelete(<?php echo $user->id; ?>)">Delete</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No members found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function confirmDelete(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            window.location.href = '<?php echo base_url('users/delete/'); ?>' + userId;
        }
        return false;
    }
</script>