@extends('frontend.main_master')
@section('content')
{{-- @php 
$user = DB::table('users')->where('id',Auth::user()->id)->first();
@endphp  co the dung cach nay ko can compact user ben controller--}}
<div class="body-content">
	<div class="container">
		<div class="col-md-2"><br>
			<img class="card-img-top" style="border-radius: 50%;" src="{{(!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/no_image.jpg')}}" height="100%" width="100%"><br><br>
			<ul class="list-group list-group-flush">
				<a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
				<a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
				<a href="" class="btn btn-primary btn-sm btn-block">Change Password</a>
				<a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
			</ul>	
		</div>
		<div class="col-md-2">
			
		</div>
		<div class="col-md-6">
			<div class="card">
				<h3 class="text-center">
					Change Your Password
				</h3>
				@if ($errors->any())
			    <div class="alert alert-danger" style="margin:20px; padding:10px;">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
		@endif
				<div class="card-body">
					<form method="post" action="{{route('user.password.update')}}">
					@csrf
					<div class="form-group">
						<label class="info-title">Current Password</label> 
						<input type="password" id="current_password" name="oldpassword" class="form-control">
					</div>	
					<div class="form-group">
						<label class="info-title">New Password</label> 
						<input type="password" id="password" name="password" class="form-control">
					</div>
					<div class="form-group">
						<label class="info-title">Confirm Password</label> 
						<input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
					</div>	
					<div class="form-group">
						<button type="submit" class="btn btn-danger">Update</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection