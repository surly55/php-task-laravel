<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Php Task Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
	</head>
    <body>
		<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
			<div class="flex justify-center mt-4 sm:items-center sm:justify-between">
				<div class="container">
					<div class="background">
						<div class="shape"></div>
						<div class="shape"></div>
					</div>
					<form method="POST" action="login">
					<?php echo csrf_field(); ?>
						<h3>Login</h3>
		
						<label for="username">Username</label>
						<input type="email" placeholder="Email" name="email" required>
		
						<label for="password">Password</label>
						<input type="password" placeholder="Password"  name="password" required>
						<?php if($errors->any()): ?>
						<div class="alert alert-danger">
							<ul>
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<span class="alert-danger"><?php echo e($error); ?></span>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
						<?php endif; ?>
						<button>Log In</button>
						<span class="mt-4">Laravel v<?php echo e(Illuminate\Foundation\Application::VERSION); ?> (PHP v<?php echo e(PHP_VERSION); ?>)</span>
					</form>
					<div class="text-center text-sm dark-text"></div>
				</div>
			</div>
         </div>
    </body>
</html>
<?php /**PATH C:\xampp8\htdocs\php_test_assignment\resources\views/login.blade.php ENDPATH**/ ?>