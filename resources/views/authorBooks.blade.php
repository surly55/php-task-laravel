<div id="shell">
	@extends('base')
	
	@section('content')
	
		<div class="box">
			<div class="head">
				<h3 style="font-weight:bold;color:orange;">BOOKS by {{ $authorData['first_name'] }} {{ $authorData['last_name'] }}</h3>
			</div>
			<div class="row">
			@foreach($authorData['books'] as $book)
			
				<div class="col-lg-4" style="margin-top:50px;">
					<h4>{{ $book['title'] }}</h4>
					<a href="#"><img src="{{ asset('images/book_mockup.jpg') }}" alt="" /></a>
					<p style="color:black;">{{ $book['description'] }}</p>
					<span style="color:black;">Release date: </span><span style="color:black;">{{ date('d.m.Y', strtotime($book['release_date'])) }}</span><br>
					<span style="color:black;">Format: </span><span style="color:black;">{{ $book['format'] }}</span><br>
					<span style="color:black;">ISBN: </span><span style="color:black;">{{ $book['isbn'] }}</span><br>
					<span style="color:black;">#Pages: </span><span style="color:black;">{{ $book['number_of_pages'] }}</span>
					<button type="button" class="btn btn-danger btn-sm" onclick="deleteBook({{ $book['id'] }});">Delete</button>
					<button style="display:none;" id="deleteBtn_{{ $book['id'] }}" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeleteBook">Delete</button>
				</div>
			@endforeach
			@if(!$authorData['books'])
				<span style="font-weight:bold;font-size:18px;color:red;">Author doesn't hav any books yet! Check other authors! (or delete)
				<br><br>
				<button type="button" class="btn btn-danger btn-sm" onclick="deleteAuthor({{ $authorData['id'] }});">Delete</button>
				<button style="display:none;" id="deleteBtnAuthor" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeleteAuthor">Delete</button>
				</span>
			@endif
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
			@csrf
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
			@csrf
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

 @endsection

