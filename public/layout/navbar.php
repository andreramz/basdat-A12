<header>
	<nav class="nav-extended">
		<div class="nav-wrapper yellow darken-2">
			<a href="./" class="brand-logo"><img src="src/resources/brand.png" alt="Tokokeren"></a>
			<a href="#" data-activates="mobile-demo" class="button-collapse black-text"><span class="ion-android-menu" style="font-size: 24pt;"></span></a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<?php
					if (!isset($_SESSION['logged'])) {
						echo '<li><a href="./login.php" class="black-text">SIGN IN</a></li><li><a href="./register.php" class="black-text">REGISTER</a></li>';
					}
					else {
						$loggedIn = $_SESSION['logged'];
						echo '<li class="black-text">Logged as <span style="font-weight: 500;">'.$loggedIn.'</span></li><li><a href="./config/config.php?action=logout" class="black-text">SIGN OUT</a></li>';
					}
				?>
			</ul>
			<ul class="side-nav yellow darken-2" id="mobile-demo">
				<li>
					<div class="background">
						<img src="src/resources/brand.png" alt="Tokokeren">
					</div>
				</li>
				<?php if (!isset($_SESSION['logged'])) { ?>
					<li><a href="./login.php" class="waves-effect black-text"><span class="ion-log-in iconic"></span> Sign In</a></li>
					<li><a href="./register.php" class="waves-effect black-text"><span class="ion-android-people iconic"></span> Register</a></li>	
				<?php } else { ?>
					<li><span class="black-text" style="font-size: 15pt; margin-left: 35px; font-weight: 500;"><?php echo $_SESSION['logged']; ?></span></li>
					<li><span class="black-text" style="margin-left: 35px;">Admin</span></li>
					<li><a href="./config/config.php?action=logout" class="waves-effect black-text"><span class="ion-log-out iconic"></span> Sign Out</a></li>
				<?php } ?>
			</ul>
		</div>
	</nav>
</header>