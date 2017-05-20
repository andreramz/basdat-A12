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
          <li><a class="black-text text-lighten-3" href="./">Home</a></li>
          <?php if (!isset($_SESSION['logged'])) { ?>
            <li><a class="black-text text-lighten-3" href="./login.php">Sign In</a></li>
            <li><a class="black-text text-lighten-3" href="./register.php">Register</a></li>
          <?php } else { ?>
            <li><a class="black-text text-lighten-3" href="./config.php?action=logout">Sign Out</a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="col l3 s12">
      	<h5 class="black-text strength">Connect</h5>
      	<table>
         <tr>
           <td><span class="soc-logo ion-social-twitter"></span></td>
           <td><a class="black-text" href="#">@tokokeren</a></td>
         </tr>
         <tr>
           <td><span class="soc-logo ion-social-facebook"></span></td>
           <td><a class="black-text" href="#">Tokokeren</a></td>
         </tr> 
         <tr>
           <td><span class="soc-logo ion-social-linkedin"></span></td>
           <td><a class="black-text" href="#">Tokokeren</a></td>
         </tr> 
        </table>
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
