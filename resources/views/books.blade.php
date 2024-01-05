<div id="shell">
	@extends('base')
	
	@section('content')
	<div id="main">
		<div id="content">
				<div class="row">
					<div class="col-lg-12">
						<h2>BOOKS</h2>
					</div>
				</div>
				
				<form action="saveBook" method="POST">
					@csrf
					<div class="row" style="margin-bottom:35px;">
						<div class="col-lg-12">
							<span class="font-weight-bold" >ADD NEW BOOK</span>
						</div>
						<div class="col-lg-3">
							<span>Autor</span>
							<select class="form-control" required name="book_author">
								<option value="">Select author...</option>
								@foreach($listOfAuthors['items'] as $item)
									<option value='{{ $item["id"] }}'>{{ $item['last_name'] }} {{ $item['first_name'] }}</option>
								@endforeach
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
 @endsection



