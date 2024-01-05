<div id="shell">
	
	
	<?php $__env->startSection('content'); ?>
	
		<div class="box">
			<div class="head">
				<h3 style="font-weight:bold;color:orange;">BOOKS by <?php echo e($authorData['first_name']); ?> <?php echo e($authorData['last_name']); ?></h3>
			</div>
			<div class="row">
			<?php $__currentLoopData = $authorData['books']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<div class="col-lg-4" style="margin-top:50px;">
					<h4><?php echo e($book['title']); ?></h4>
					<a href="#"><img src="<?php echo e(asset('images/book_mockup.jpg')); ?>" alt="" /></a>
					<p style="color:black;"><?php echo e($book['description']); ?></p>
					<span style="color:black;">Release date: </span><span style="color:black;"><?php echo e(date('d.m.Y', strtotime($book['release_date']))); ?></span><br>
					<span style="color:black;">Format: </span><span style="color:black;"><?php echo e($book['format']); ?></span><br>
					<span style="color:black;">ISBN: </span><span style="color:black;"><?php echo e($book['isbn']); ?></span><br>
					<span style="color:black;">#Pages: </span><span style="color:black;"><?php echo e($book['number_of_pages']); ?></span>
					<button type="button" class="btn btn-danger btn-sm" onclick="deleteBook(<?php echo e($book['id']); ?>);">Delete</button>
					<button style="display:none;" id="deleteBtn_<?php echo e($book['id']); ?>" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeleteBook">Delete</button>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php if(!$authorData['books']): ?>
				<span style="font-weight:bold;font-size:18px;color:red;">Author doesn't hav any books yet! Check other authors! (or delete)
				<br><br>
				<button type="button" class="btn btn-danger btn-sm" onclick="deleteAuthor(<?php echo e($authorData['id']); ?>);">Delete</button>
				<button style="display:none;" id="deleteBtnAuthor" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeleteAuthor">Delete</button>
				</span>
			<?php endif; ?>
			</div>
		</div>
</div>

<div id="modalDeleteBook" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="color:red;">Delete book?</h4>
      </div>
		<form action="/deleteBook" method="POST">
			<?php echo csrf_field(); ?>
			<div class="modal-body">
				<input type="number" id="modalBookDeleteId" name="book_to_delete" style="display:none"/>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-danger">Delete</button>
			</div>
		</form>
    </div>

  </div>
</div>	


<div id="modalDeleteAuthor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="color:red;">Delete author?</h4>
      </div>
		<form action="/deleteAuthor" method="POST">
			<?php echo csrf_field(); ?>
			<div class="modal-body">
				<input type="number" id="modalAuthorDeleteId" name="author_to_delete" style="display:none"/>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-danger">Delete</button>
			</div>
		</form>
    </div>

  </div>
</div>	

 <?php $__env->stopSection(); ?>


<?php echo $__env->make('base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8\htdocs\php_test_assignment\resources\views/authorBooks.blade.php ENDPATH**/ ?>