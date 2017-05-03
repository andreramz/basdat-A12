<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" type="text/css" href="materialize/css/materialize.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="src/css/style.css">
		<title>Home | TOKOKEREN</title>
	</head>
	<body>
		<nav class="nav-extended">
			<div class="nav-wrapper yellow darken-2">
				<a href="#" class="brand-logo"><img src="src/resources/brand.png" alt="Tokokeren"></a>
				<a href="#" data-activates="mobile-demo" class="button-collapse black-text"><i class="material-icons">menu</i></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="#" class="black-text">SIGN IN</a></li>
					<li><a href="#" class="black-text">REGISTER</a></li>
				</ul>
				<ul class="side-nav" id="mobile-demo">
					<li><a href="#" class="black-text">Sign In</a></li>
					<li><a href="#" class="black-text">Register</a></li>			
				</ul>
			</div>
		</nav>
		<div class="container">
			<div class="row">
				<div class="col m1 l2"></div>
				<div class="col s12 m10 l8">
					<div class="nav-content">
					    <ul class="tabs tabs-transparent">
						    <li class="tab"><a class="active black-text" href="#test1">Promo</a></li>
						    <li class="tab"><a class="black-text" href="#test2">Kategori</a></li>
						    <li class="tab"><a class="black-text" href="#test3">Toko</a></li>
						    <li class="tab"><a class="black-text" href="#test4">Ranks</a></li>
				    	</ul>
					</div>			
				</div>
				<div class="col m1 l2"></div>
			</div>
		</div>
		<div id="test1" class="col s12">
			<div class="container">
				<div class="row">
					<div class="col m4 s12 block">
						1
					</div>
					<div class="col m4 s12 block">
						2
					</div>
					<div class="col m4 s12 block">
						3
					</div>
				</div>
			</div>
		</div>
		<div id="test2" class="col s12">
			<div class="container">
				<div class="row">
					<div class="col m4 s12 block">
						A
					</div>
					<div class="col m4 s12 block">
						B
					</div>
					<div class="col m4 s12 block">
						C
					</div>
				</div>
			</div>
		</div>
		<div id="test3" class="col s12">
			<div class="container">
				<div class="row">
					<div class="col m4 s12 block">
						D
					</div>
					<div class="col m4 s12 block">
						E
					</div>
					<div class="col m4 s12 block">
						F
					</div>
				</div>
			</div>
		</div>
		<div id="test4" class="col s12">
			<div class="container">
				<div class="row">
					<div class="col m4 s12 block">
						G
					</div>
					<div class="col m4 s12 block">
						H
					</div>
					<div class="col m4 s12 block">
						I
					</div>
				</div>
			</div>
		</div>
		<footer class="page-footer yellow darken-2">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="black-text strength">Tokokeren</h5>
                <p class="black-text text-lighten-4">Tokokeren adalah sebuah <i>platform e-commerce</i> yang telah berdiri sejak tahun 2014. Tokokeren menjual berbagai barang, di antaranya berbagai peralatan rumah tangga, peralatan kantor, dan peralatan lainnya.</p>
              </div>
              <div class="col l3 s12">
                <h5 class="black-text strength">Links</h5>
                <ul>
                  <li><a class="black-text text-lighten-3" href="#!">Promo</a></li>
                  <li><a class="black-text text-lighten-3" href="#!">Sign In</a></li>
                  <li><a class="black-text text-lighten-3" href="#!">Register</a></li>
                </ul>
              </div>
              <div class="col l3 s12">
              	<h5 class="black-text strength">Connect</h5>
              	<ul>
              	  <li><a class="black-text" href="#"><span class="ion-social-twitter" style="margin-right: 20px;"></span>@tokokeren</a></li>
              	  <li><a class="black-text" href="#"><span class="ion-social-facebook" style="margin-right: 20px;"></span>Tokokeren</a></li>
              	  <li><a class="black-text" href="#"><span class="ion-social-linkedin" style="margin-right: 20px;"></span>Tokokeren</a></li>

              	</ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            	<span class="black-text text-center">© 2017 TOKOKEREN A12</span>	
            </div>
          </div>
        </footer>
		<script src="src/js/jquery-3.1.1.min.js"></script>
		<script src="materialize/js/materialize.js"></script>
		<script>
			$(".button-collapse").sideNav();
			$(".indicator").css("background-color: black;");
		</script>
	</body>
</html>