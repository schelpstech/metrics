<nav class="navbar navbar-expand-lg classic transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
          <div class="navbar-brand w-100">
            <a href="../../view/index.php">
              <img src="../assets/img/web/weblogo.png" srcset="../assets/img/web/weblogo.png 2x" alt="" />
            </a>
          </div>
          <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
            <div class="offcanvas-header d-lg-none">
              <h3 class="text-white fs-30 mb-0">CrunchEconometrix</h3>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
              <ul class="navbar-nav">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php" >Home</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">About</a>
                  <ul class="dropdown-menu">
                    <li class="nav-item"><a class="dropdown-item" href="./aboutus.php">CrunchEconometrix</a></li>
                    <li class="nav-item"><a class="dropdown-item" href="./ngoziadeleye.php">Founder - Ngozi Adeleye</a></li>
                    <li class="nav-item"><a class="dropdown-item" href="../assets/img/web/NgADELEYE_PhD Economics -Crunch.pdf">Download CV - Ngozi Adeleye</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Resources</a>
                  <ul class="dropdown-menu">
                  <li class="nav-item"><a class="dropdown-item" href="./publication.php">Publications</a></li>
                  <li class="nav-item"><a class="dropdown-item" href="https://www.youtube.com/c/CrunchEconometrix">YouTube Videos</a></li>
                    <li class="nav-item"><a class="dropdown-item" href="https://cruncheconometrix.teachable.com/">Teachable Videos</a></li>
                    <li class="nav-item"><a class="dropdown-item" href="https://www.researchgate.net/profile/Ngozi-Adeleye">ResearchGate</a></li>
                    <li class="nav-item"><a class="dropdown-item" href="https://publons.com/researcher/2971644/bosede-ngozi-adeleye/">Publon</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://blog.cruncheconometrix.com" >Blog</a>
                </li>
               
                 <li class="nav-item ">
                  <a class="nav-link" href="datashop.php" >Shop</a>
                 </li>
                 <li class="nav-item ">
                  <a class="nav-link" href="./contact.php" >Contact</a>
                 </li>
                 <?php echo $access_account;?>
                 
    
              </ul>
              <!-- /.navbar-nav -->
              <div class="offcanvas-footer d-lg-none">
                <div>
                <a href="mailto:cruncheconometrix@gmail.com" class="link-body">cruncheconometrix@gmail.com</a>
           <br />
                  <nav class="nav social social-white mt-4">
                    <a href="https://twitter.com/crunchmetrix"><i class="uil uil-twitter"></i></a>
                    <a href="https://www.facebook.com/CrunchEconometrix"><i class="uil uil-facebook-f"></i></a>
                    <a href="https://www.youtube.com/c/CrunchEconometrix"><i class="uil uil-youtube"></i></a>
                  </nav>
                  <!-- /.social -->
                </div>
              </div>
              <!-- /.offcanvas-footer -->
            </div>
            <!-- /.offcanvas-body -->
          </div>
          <!-- /.navbar-collapse -->
          <div class="navbar-other w-100 d-flex ms-auto">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <?php echo $access_button;?>  
           </ul>
            <!-- /.navbar-nav -->
          </div>
          <div class="navbar-other w-100 d-flex ms-auto"  >
            <ul class="navbar-nav flex-row align-items-center ms-auto">
           
              <li class="nav-item">
                <a class="nav-link position-relative d-flex flex-row align-items-center" onclick="window.location.replace('./mycart.php');">
                  <i class="uil uil-shopping-cart"></i>
                    <span class="badge badge-cart bg-primary"><div id="cart_notify">
                       >> 
                        </div>
                    </span>
                </a>
              </li>
            </ul>
            <!-- /.navbar-nav -->
          </div>
          <div class="navbar-other w-100 d-flex ms-auto">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <li class="nav-item d-lg-none">
                <button class="hamburger offcanvas-nav-btn"><span></span></button>
              </li>
            </ul>
            <!-- /.navbar-nav -->
          </div>

          
          
          <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
      </nav>
      <!-- /.navbar -->
      <div class="modal fade" id="modal-signin" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content text-center">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <h2 class="mb-3 text-start">Welcome Back</h2>
              <p class="lead mb-6 text-start">Fill your email and password to sign in.</p>
              <form class="text-start mb-3" method="post" action="../app/accessuser.php">
                <div class="form-floating mb-4">
                  <input type="email" class="form-control" placeholder="Email" required="yes" id="loginEmail" name="user_name_email">
                  <label for="loginEmail">Email</label>
                </div>
                <div class="form-floating password-field mb-4">
                  <input type="password" class="form-control" placeholder="Password" required="yes" id="loginPassword" name="user_password">
                  <span class="password-toggle"><i class="uil uil-eye"></i></span>
                  <label for="loginPassword">Password</label>
                </div>
                <input type="submit" value="Sign in" name="log_in" class="btn btn-primary rounded-pill btn-login w-100 mb-2"/>
              </form>
              <!-- /form -->
              <p class="mb-1"><a href="#" class="hover">Forgot Password?</a></p>
              <p class="mb-0">Don't have an account? <a href="#" data-bs-target="#modal-signup" data-bs-toggle="modal" data-bs-dismiss="modal" class="hover">Sign up</a></p>
              <div class="divider-icon my-4">or</div>
              <nav class="nav social justify-content-center text-center">
                <a href="#" class="btn btn-circle btn-sm btn-google"><i class="uil uil-google"></i></a>
                <a href="#" class="btn btn-circle btn-sm btn-facebook-f"><i class="uil uil-facebook-f"></i></a>
                <a href="#" class="btn btn-circle btn-sm btn-twitter"><i class="uil uil-twitter"></i></a>
              </nav>
              <!--/.social -->
            </div>
            <!--/.modal-content -->
          </div>
          <!--/.modal-body -->
        </div>
        <!--/.modal-dialog -->
      </div>
      <!--/.modal -->
      <div class="modal fade" id="modal-signup" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content text-center">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <h2 class="mb-3 text-start">Sign up to CrunchEconometrix</h2>
              <p class="lead mb-6 text-start">Registration takes less than a minute.</p>
              <form class="text-start mb-3" method="post" action="../app/accessuser.php">
                <div class="form-floating mb-4">
                  <input type="text" class="form-control" placeholder="Name" id="SignupName" name="first_name">
                  <label for="loginName">First name</label>
                </div>
                <div class="form-floating mb-4">
                  <input type="text" class="form-control" placeholder="Name" id="SignuplName" name="last_name">
                  <label for="loginName">Last name</label>
                </div>
                <div class="form-floating mb-4">
                  <input type="email" class="form-control" placeholder="Email" id="SignupEmail" name="user_email">
                  <label for="loginEmail">Email</label>
                </div>
                <div class="form-floating password-field mb-4">
                  <input type="password" class="form-control" placeholder="Password" onchange="deleteconfirm()" id="SignupPassword" name="user_password">
                  <span class="password-toggle"><i class="uil uil-eye"></i></span>
                  <label for="loginPassword">Password</label>
                </div>
                <div class="form-floating password-field mb-4">
                  <input type="password" class="form-control" placeholder="Confirm Password" onchange="checkpin()" id="loginPasswordConfirm">
                  <span class="password-toggle"><i class="uil uil-eye"></i></span>
                  <label for="loginPasswordConfirm">Confirm Password</label>
                </div>
                <input type="submit" value="Register" name="register" class="btn btn-primary rounded-pill btn-login w-100 mb-2"/>
              </form>
              <!-- /form -->
              <p class="mb-0">Already have an account? <a href="#" data-bs-target="#modal-signin" data-bs-toggle="modal" data-bs-dismiss="modal" class="hover">Sign in</a></p>
              <div class="divider-icon my-4">or</div>
              <nav class="nav social justify-content-center text-center">
                <a href="#" class="btn btn-circle btn-sm btn-google"><i class="uil uil-google"></i></a>
                <a href="#" class="btn btn-circle btn-sm btn-facebook-f"><i class="uil uil-facebook-f"></i></a>
                <a href="#" class="btn btn-circle btn-sm btn-twitter"><i class="uil uil-twitter"></i></a>
              </nav>
              <!--/.social -->
            </div>
            <!--/.modal-content -->
          </div>
          <!--/.modal-body -->
        </div>
        <!--/.modal-dialog -->
      </div>
      <!--/.modal -->
      <!--/. Log out modal -->
      <div class="modal fade" id="modal-signout" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content text-center">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <h2 class="mb-3 text-start">Log Out</h2>
              <p class="lead mb-6 text-start">Are you sure you want to sign out?.</p>
              <form class="text-start mb-3" method="post" action="../app/accessuser.php">
                
                <input type="submit" value="Log Out" name="log_out" class="btn btn-primary rounded-pill btn-login w-100 mb-2"/>
              </form>
              <!-- /form -->
           
              <!--/.social -->
            </div>
            <!--/.modal-content -->
          </div>
          <!--/.modal-body -->
        </div>
        <!--/.modal-dialog -->
      </div>
      <!--/.modal -->
      </header>
    <!-- /header -->

    <script>
      function checkpin() {
var pina = document.getElementById("SignupPassword").value;
var pinb = document.getElementById("loginPasswordConfirm").value;

if (pina!==pinb){
    alert("Password do not match");
    $("#SignupPassword").val("");
}
}
    </script>

<script>
      function deleteconfirm() {
    $("#loginPasswordConfirm").val("");
  }
    </script>