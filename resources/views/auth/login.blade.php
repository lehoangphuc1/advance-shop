@extends('frontend.main_master')
@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Login</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->			
<div class="col-md-6 col-sm-6 sign-in">
	<h4 class="">LoginForm</h4>
	<p class="">Login</p>
	<div class="social-sign-in outer-top-xs">
		<a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
		<a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
	</div>
		@if ($errors->any())
			    <div class="alert alert-danger" style="margin:20px; padding:10px;">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
		@endif
	 <form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
            @csrf
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email" name="email" class="form-control unicase-form-control text-input" id="email" >
		</div>
	  	<div class="form-group">
		    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
		    <input type="password" name="password" class="form-control unicase-form-control text-input" id="password" >
		</div>
		<div class="radio outer-xs">
		  	<label>
		    	<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember me!
		  	</label>
		  	<a href="{{ route('password.request') }}" class="forgot-password pull-right">Forgot your Password?</a>
		</div>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
	</form>					
</div>
<!-- Sign-in -->

<!-- create a new account -->
<div class="col-md-6 col-sm-6 create-new-account">
	<h4 class="checkout-subtitle">Create a new account</h4>
	<p class="text title-tag-line">Create your new account.</p>

	<form class="register-form outer-top-xs" role="form" method="POST" action="{{ route('register') }}">
            @csrf
		<div class="form-group">
	    	<label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
	    	<input type="email" name="email" id="email" class="form-control unicase-form-control text-input" >
	    	@if ($errors->has('email'))
                <span class="invalid feedback"role="alert">
                    <strong>{{ $errors->first('email') }}.</strong>
                </span>
            @endif
	  	</div>
        <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
		    <input type="text" name="name" id="name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
		    @if ($errors->has('name'))
                <span class="invalid feedback"role="alert">
                    <strong>{{ $errors->first('name') }}.</strong>
                </span>
            @endif
		</div>
        <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
		    <input type="text" name="phone" id="phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
		    @if ($errors->has('phone'))
                <span class="invalid feedback"role="alert">
                    <strong>{{ $errors->first('phone') }}.</strong>
                </span>
            @endif
		</div>
        <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
		    <input type="password" name="password" id="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
		    @if ($errors->has('password'))
                <span class="invalid feedback"role="alert">
                    <strong>{{ $errors->first('password') }}.</strong>
                </span>
            @endif
		</div>
         <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
		    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
		    
		</div>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
	</form>
	
	
</div>
</div>
</div>
  @include('frontend.body.brand')
</div>
</div>	
@endsection