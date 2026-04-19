@php
    $setting = App\Models\SiteSetting::find(1);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/png" />
	<!-- loader-->
	<link href="{{ asset('/backend/assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('/backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('/backend/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/backend/assets/css/icons.css') }}" rel="stylesheet">
	<title>404 - Page non trouvée</title>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<nav class="bg-white rounded shadow-sm navbar navbar-expand-lg navbar-light fixed-top rounded-0">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">
					<img src="{{ asset($setting->logo) }}" width="194" alt="Logo EduPlatform" />
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent1">
					<ul class="mb-2 navbar-nav ms-auto mb-lg-0">
						<li class="nav-item"> <a class="nav-link active" aria-current="page" href="javascript:history.back()"><i class='bx bx-home-alt me-1'></i>Accueil</a>
						</li>
						
					</ul>
				</div>
			</div>
		</nav>
		<div class="error-404 d-flex align-items-center justify-content-center">
			<div class="container">
				<div class="py-5 card">
					<div class="row g-0">
						<div class="col col-xl-5">
							<div class="p-4 card-body">
								<h1 class="display-1"><span class="text-primary">4</span><span class="text-danger">0</span><span class="text-success">4</span></h1>
								<h2 class="font-weight-bold display-4">Perdu dans l'espace</h2>
								<p>Vous avez atteint la limite de l'univers.<br>La page demandée n'a pas pu être trouvée.<br>Ne vous inquiétez pas et retournez à la page précédente.</p>
								<div class="mt-5"> 
									<a href="javascript:history.back()" class="btn btn-primary btn-lg px-md-5 radius-30">Retour</a>
								</div>
							</div>
						</div>
						<div class="col-xl-7">
							<img src="https://cdn.searchenginejournal.com/wp-content/uploads/2019/03/shutterstock_1338315902.png" class="img-fluid" alt="Image d'erreur 404">
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
		</div>
		{{-- <div class="p-3 bg-white shadow fixed-bottom border-top">
			<div class="flex-wrap d-flex align-items-center justify-content-between">
				<ul class="mb-0 list-inline">
					<li class="list-inline-item">Suivez-nous :</li>
					<li class="list-inline-item"><a href="javascript:;"><i class='bx bxl-facebook me-1'></i>Facebook</a>
					</li>
					<li class="list-inline-item"><a href="javascript:;"><i class='bx bxl-twitter me-1'></i>Twitter</a>
					</li>
					<li class="list-inline-item"><a href="javascript:;"><i class='bx bxl-google me-1'></i>Google</a>
					</li>
				</ul>
				<p class="mb-0">Copyright © 2025. Tous droits réservés.</p>
			</div>
		</div> --}}
	</div>
	<!-- end wrapper -->
	<!-- Bootstrap JS -->
	<script src="{{ asset('/backend/assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>