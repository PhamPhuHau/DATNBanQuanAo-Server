<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="heading">Đăng nhập</div>
    <form action="{{route('dang-nhap')}}" class="form" method="POST">
    @csrf
	@if(session('thong_bao'))
		<div class="alert alert-danger">
			{{ session('thong_bao') }}
		</div>
	@endif


	@if ($errors->any())
		<div class="alert alert-danger">
		
		@foreach($errors->all() as $error)
		{{$error }}<br>
	@endforeach

</div>
@endif
      <input class="input" type="text" name="ten_dang_nhap" id="ten_dang_nhap" placeholder="Tài khoản">
      <input class="input" type="password" name="password" id="password" placeholder="Mật khẩu">
      <input class="login-button" type="submit" value="Đăng nhập">

    </form>
   
  </div>

</body>


</html>

			<!-- /GLOABAL LOADER -->

			<!-- PAGE -->
			<!-- <div class="page">
				<div>
					<div class="col col-login mx-auto text-center">
						<a href="index.html" class="text-center">
							<img src="../assets/images/brand/logo.png" class="header-brand-img" alt="">
						</a>
					</div>
					<div class="container-login100">
						<div class="wrap-login100 p-0">
							<div class="card-body">
								<form class="login100-form validate-form" method="POST" action="{{route('xl-dang-nhap')}}">
								@csrf
									<span class="login100-form-title">
										Login
									</span>
									<div class="wrap-input100 validate-input" data-bs-validate = "Valid email is required: ex@abc.xyz">
										<input class="input100" type="text" name="ten_dang_nhap" placeholder="Tài khoản">
										<span class="focus-input100"></span>
										<span class="symbol-input100">
											<i class="zmdi zmdi-email" aria-hidden="true"></i>
										</span>
									</div>
									<div class="wrap-input100 validate-input" data-bs-validate = "Password is required">
										<input class="input100" type="password" name="password" placeholder="Password">
										<span class="focus-input100"></span>
										<span class="symbol-input100">
											<i class="zmdi zmdi-lock" aria-hidden="true"></i>
										</span>
									</div>
									<div class="text-end pt-1">
										<p class="mb-0"><a href="forgot-password.html" class="text-primary ms-1">Forgot Password?</a></p>
									</div>
									<div class="container-login100-form-btn">
										<button type="submit" class="login100-form-btn btn-primary">
											Login
										</button>
									</div>
									<div class="text-center pt-3">
										<p class="text-dark mb-0">Not a member?<a href="register.html" class="text-primary ms-1">Create an Account</a></p>
									</div>
								</form>
							</div>
							<div class="card-footer">
								<div class="d-flex justify-content-center my-3">
									<a href="javascript:void(0)" class="social-login  text-center me-4">
										<i class="fa fa-google"></i>
									</a>
									<a href="javascript:void(0)" class="social-login  text-center me-4">
										<i class="fa fa-facebook"></i>
									</a>
									<a href="javascript:void(0)" class="social-login  text-center">
										<i class="fa fa-twitter"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>



		<script src="../assets/js/jquery.min.js"></script>


		<script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>

		<script src="../assets/js/sticky.js"></script>

		<script src="../assets/js/themeColors.js"></script>

		<script src="../assets/js/custom.js"></script>

	</body>
</html> -->
