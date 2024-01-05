 $(document).ready(function() {
        $('#authorsTable').DataTable({
            processing: true,
            serverSide: true,
			pageLength: 25,
            ajax: '/authors',
            columns: [
                { data: 'id', name: 'id' },
				{ data: 'last_name', name: 'last_name' },
				{ data: 'first_name', name: 'first_name' },
				{ data: 'place_of_birth', name: 'place_of_birth' },
				{ data: 'author_details', name: 'author_details' }
			],
			ordering: false 
        });
		
		$('#booksTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/books',
			pageLength: 25,
            columns: [
                { data: 'id', name: 'id' },
				{ data: 'title', name: 'title' },
				{ data: 'format', name: 'format' },
				{ data: 'release_date_beautify', name: 'release_date_beautify' },
				{ data: 'isbn', name: 'isbn' },
				{ data: 'number_of_pages', name: 'number_of_pages' }
			],
			ordering: false 
        });
		
});

function deleteBook(val){
	
	$("#modalBookDeleteId").val(val);
	$("#deleteBtn_"+val+"").click();
}

function deleteAuthor(val){
	$("#modalAuthorDeleteId").val(val);
	$("#deleteBtnAuthor").click();
}