<div id="shell">
	
	
	<?php $__env->startSection('content'); ?>
	<div id="main">
		<div id="content">
				<div class="row">
					<div class="col-lg-12">
						<h2>BOOKS</h2>
					</div>
				</div>
				
				<form action="saveBook" method="POST">
					<?php echo csrf_field(); ?>
					<div class="row" style="margin-bottom:35px;">
						<div class="col-lg-12">
							<span class="font-weight-bold" >ADD NEW BOOK</span>
						</div>
						<div class="col-lg-3">
							<span>Autor</span>
							<select class="form-control" required name="book_author">
								<option value="">Select author...</option>
								<?php $__currentLoopData = $listOfAuthors['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value='<?php echo e($item["id"]); ?>'><?php echo e($item['last_name']); ?> <?php echo e($item['first_name']); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							
						</div>
						<div class="col-lg-3">
							<span>Title</span>
							<input class="form-control" type="text" required name="book_title" />
						</div>
						<div class="col-lg-2">
							<span>ISBN</span>
							<input class="form-control" type="text" required name="book_isbn" />
						</div>
						<div class="col-lg-2">
							<span>Format</span>
							<input class="form-control" type="text" required name="book_format" />
						</div>
						<div class="col-lg-2">
							<span>#Pages</span>
							<input class="form-control" type="number" required name="book_pages" />
						</div>
						<div class="col-lg-6">
							<span>Short description</span>
							<input class="form-control" type="text" required name="book_description" />
						</div>
						<div class="col-lg-4">
							<br><button type="submit" class="btn btn-sm btn-success" value="submit" name="save_book">ADD BOOK</button>
						</div>
					</div>
					
					
				</form>
				
				
				<div class="row">
					<div class="col-lg-12">
					<table style="color:black;" id="booksTable">
						<thead>
							<th>ID</th><th>Title</th><th>Format</th><th>Release date</th><th>ISBN</th><th>#Pages</th>
						</thead>
						<tbody>
						</tbody>
					</table>
					</div>
				</div>
			
		</div>
		
	</div>

 
</div>
 <?php $__env->stopSection(); ?>




<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8\htdocs\php_test_assignment\resources\views/books.blade.php ENDPATH**/ ?>