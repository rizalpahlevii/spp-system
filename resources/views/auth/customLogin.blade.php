<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login {{ucwords($url)}} | E-SPP</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('assets_template')}}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('assets_template')}}/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('assets_template')}}/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('assets_template')}}/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('assets_template')}}/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets_template')}}/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets_template')}}/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<h2>E-SPP SYSTEM</h2>
								{{-- <div class="logo text-center"><img src="{{asset('assets_template')}}/img/logo-dark.png" alt="Klorofil Logo"></div> --}}
								<p class="lead">Login to your account</p>
							</div>
							@if (Session::has('message'))
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger">
											{{Session::get('message')}}
										</div>
									</div>
								</div>
							@endif
							<form class="form-auth-small" action="{{url("login/$url")}}" method="POST">
								@csrf
								@if ($url == "admin")
									<div class="form-group">
										<label for="email" class="control-label sr-only">Email / Username</label>
										<input type="text" class="form-control" name="email" id="email" placeholder="Email / Username">
									</div>
								@else
									<div class="form-group">
										<label for="nis" class="control-label sr-only">NIS</label>
										<input type="text" class="form-control" name="nis" id="nis" placeholder="NIS">
									</div>	
								@endif
								<div class="form-group">
									<label for="password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Password">
								</div>
								<div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input type="checkbox" name="remember" id="remember">
										<span>Remember me</span>
									</label>
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">SCHOOL SPP SYSTEM {{$url == "admin" ? " / ADMIN" : " / SISWA"}}</h1>
							<p>SMK WIKRAMA 1 JEPARA</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
