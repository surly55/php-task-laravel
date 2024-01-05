<div id="shell">
	@extends('base')
	
	@section('content')
	<div id="main">
		<div id="content">
		
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addAuthor">Add author</button>
			
			<div class="box">
				<div class="head">
					<h2>AUTHORS</h2>
				</div>
				<div>
					<table style="color:black;" id="authorsTable">
						<thead>
							<th>ID</th><th>Surname</th><th>Name</th><th>Place</th><th></th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="addAuthor" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
		<form action="addAuthor" method="POST">
			@csrf
			<div class="modal-header">
				<h4 class="modal-title">New author</h4>
			</div>
			<div class="modal-body">
				<p>
				<span>First name</span>
				<input type="text" class="form-control" name="first_name">
				
				<span>Last name</span>
				<input type="text" class="form-control" name="last_name">
				
				
				<div class="row">
					<div class="col-lg-4">
						<span>Birthday (Year)</span>
						<select class="form-control" required name="birthday_year">
							<option value="">Select ...</option>
							@for($i=1901;$i<2025;$i++)
								<option value="{{ $i }}">{{ $i }}</option>
							@endfor
						</select>
					</div>
					<div class="col-lg-4">
						<span>Birthday (Month)</span>
						<select class="form-control" required name="birthday_month">
							<option value="">Select ...</option>
							@for($i=1;$i<13;$i++)
								<option value="{{ $i }}">{{ $i }}</option>
							@endfor
						</select>
					</div>
					<div class="col-lg-4">
						<span>Birthday (Day)</span>
						<select class="form-control" required name="birthday_day">
							<option value="">Select ...</option>
							@for($i=1;$i<32;$i++)
								<option value="{{ $i }}">{{ $i }}</option>
							@endfor
						</select>
					</div>
				</div>
				
				<span>Gender</span>
				<select class="form-control" required name="gender">
					<option value="">Select ...</option>
					<option value="female">Female</option>
					<option value="male">Male</option>
					<option value="other">Other</option>
				</select>
				<span>Place of birth</span>
				<input type="text" class="form-control" name="place_of_birth">
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-info">Save</button>
			</div>
		</form>
    </div>

  </div>
</div>

 @endsection
