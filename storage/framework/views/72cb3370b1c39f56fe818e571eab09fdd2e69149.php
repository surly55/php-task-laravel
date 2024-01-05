<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <title>PHP test assignment</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
	<script type="text/javascript" src="<?php echo e(asset('js/main.js')); ?>"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<?php if(session('userToken')): ?>
        <div id="header" style="min-height:100px;">
			<div class="social"> <span style="font-weight:bold;">Welcome: <?php echo e($sessionData['firstName']); ?> <?php echo e($sessionData['lastName']); ?></span>
				<a href="/logout"><ul><li>Logout</li></ul></a>
			</div>
			<div id="navigation">
				<ul>
					<li><a style="color:blue !important;" href="/booklet">AUTHORS</a></li>
					<li><a style="color:blue !important;" href="/booklist">BOOKS</a></li>
				</ul>
			</div>
		</div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>


</body>
</html>
<?php /**PATH C:\xampp8\htdocs\php_test_assignment\resources\views/base.blade.php ENDPATH**/ ?>