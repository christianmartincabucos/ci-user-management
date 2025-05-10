<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($meta_title) ? $meta_title : 'User Management'; ?></title>
	<link rel="apple-touch-icon" sizes="57x57" href="/assets/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/assets/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/assets/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/assets/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/assets/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/assets/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/assets/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/assets/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="/assets/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/assets/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<script src="<?php echo base_url('assets/css/tailwind.min.css'); ?>"></script>
	<style>
		:root {
			--color-primary: #007bff;
			--color-secondary: #6c757d;
			--color-success: #28a745;
			--color-danger: #dc3545;
		}
		
		.bg-primary { background-color: var(--color-primary); }
		.bg-secondary { background-color: var(--color-secondary); }
		.bg-success { background-color: var(--color-success); }
		.bg-danger { background-color: var(--color-danger); }
		.text-primary { color: var(--color-primary); }
		.text-secondary { color: var(--color-secondary); }
		.text-success { color: var(--color-success); }
		.text-danger { color: var(--color-danger); }
	</style>
    
    <!-- Custom CSS -->
    <?php if(isset($css) && is_array($css)): ?>
        <?php foreach($css as $css_file): ?>
            <link rel="stylesheet" href="<?php echo base_url($css_file); ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-primary text-white py-4">
        <div class="container mx-auto px-4">
            <nav class="flex justify-between items-center">
                <a href="<?php echo base_url(); ?>" class="text-lg font-bold">Home</a>
                <div>
                    <?php if($this->session->userdata('is_logged_in')): ?>
                        <a href="<?php echo base_url('members'); ?>" class="ml-4 hover:underline">Members</a>
                        <a href="<?php echo base_url('users/logout'); ?>" class="ml-4 hover:underline">Logout</a>
                    <?php else: ?>
                        <a href="<?php echo base_url('register'); ?>" class="ml-4 hover:underline">Register</a>
                        <a href="<?php echo base_url('log-in'); ?>" class="ml-4 hover:underline">Login</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <?php echo $page_content; ?>
    </main>

    <!-- JS Files -->
    <?php if(isset($js) && is_array($js)): ?>
        <?php foreach($js as $js_file): ?>
            <script src="<?php echo base_url($js_file); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>