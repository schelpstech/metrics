<?php
include '../assets/php/header.php';
include '../assets/php/navbar.php';
?>

<section class="wrapper bg-light">
  <div class="container">
    <div class="card bg-soft-primary rounded-4 mt-2 mb-13 mb-md-17">
      <div class="card-body p-md-10 py-xl-11 px-xl-15">
        <div class="row gx-lg-8 gx-xl-0 gy-10 align-items-center">
          <?php

          if (isset($_SESSION['msg']) ) {
            printf('<b>%s</b>', $_SESSION['msg']);
            unset($_SESSION['msg']);
          }
          ?>
          <div class="col-lg-6 order-lg-2 d-flex position-relative">
            <img class="img-fluid ms-auto mx-auto me-lg-8" src="../assets/img/web/mrsadeleye.png" srcset="../assets/img/web/mrsadeleye.png" alt="" data-cue="fadeIn">
            <div data-cue="slideInRight" data-delay="300">
              <div class="card shadow-lg position-absolute" style="bottom: -30%; right: -30%;">
                <div class="card-body py-4 px-5">
                  <div class="d-flex flex-row align-items-center">
                    <div>
                      <div class="icon btn btn-circle btn-md btn-soft-primary disabled mx-auto me-3"> <i class="uil uil-users-alt"></i> </div>
                    </div>
                    <div>
                      <h3 class="counter mb-0 text-nowrap">Dr. Bosede Ngozi ADELEYE</h3>
                      <small class="fs-14 lh-sm mb-0 text-nowrap">Founder, CrunchEconometrix</small>
                    </div>
                  </div>
                </div>
                <!--/.card-body -->
              </div>
              <!--/.card -->
            </div>
            <!--/div -->
          </div>
          <!--/column -->
          <div class="col-lg-6 text-center text-lg-start" data-cues="slideInDown" data-group="page-title" data-delay="600">
            <h1 class="display-2 mb-5"></br></br>Econometrics and Data Analysis Resources</h1>
            <p class="lead fs-lg lh-sm mb-7 pe-xl-10">CrunchEconometrix is tailored for beginners
              and for those who want to improve their understanding
              of econometrics and data analysis</p>
            <div class="d-flex justify-content-center justify-content-lg-start" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">
              <span><a href="./aboutus.php" class="btn btn-lg btn-primary rounded-pill me-2">Explore Now</a></span>
              <span><a href="./contact.php" class="btn btn-lg btn-outline-primary rounded-pill">Contact Us</a></span>
            </div>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!--/.card-body -->
    </div>
    <!--/.card -->
    <div class="row gx-lg-8 gx-xl-12 gy-10 gy-lg-0 mb-13 mb-md-17">
      <div class="col-lg-4">
        <h2 class="display-4 mb-3 pe-xxl-5">Trusted by over 25,000+ subscribers</h2>
        <cite class="lead fs-lg mb-0 pe-xxl-5"> <span class="underline">CrunchEconometrix</span> teaches salient econometrics and data analysis tools across online educational platforms</cite>
      </div>
      <!-- /column -->
      <div class="col-lg-8">
        <div class="row row-cols-2 row-cols-md-4 gx-0 gx-md-8 gx-xl-12 gy-11 mt-n10">
          <div class="col">
            <figure class="px-4 px-lg-3 px-xxl-5"><img src="../assets/img/tools/eview.png" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col">
            <figure class="px-4 px-lg-3 px-xxl-5"><img src="../assets/img/tools/stata.png" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col">
            <figure class="px-4 px-lg-3 px-xxl-5"><img src="../assets/img/tools/spss.png" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col">
            <figure class="px-4 px-lg-3 px-xxl-5"><img src="../assets/img/tools/excel.png" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col">
            <figure class="px-4 px-lg-3 px-xxl-5"><img src="../assets/img/tools/rlogo.png" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col">
            <figure class="px-4 px-lg-3 px-xxl-5"><img src="../assets/img/tools/teachable.png" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col">
            <figure class="px-4 px-lg-3 px-xxl-5"><img src="../assets/img/tools/ui2.png" alt="" /></figure>
          </div>
          <!--/column -->
          <div class="col">
            <figure class="px-4 px-lg-3 px-xxl-5"><img src="../assets/img/tools/youtube.png" alt="" /></figure>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->



    <!-- /.row -->
    <div class="row gy-10 gy-sm-13 gx-lg-3 align-items-center mb-14 mb-md-18">
      <div class="col-md-8 col-lg-6 position-relative">
        <a href="https://www.youtube.com/watch?v=Htay1iz4S4Y" class="btn btn-circle btn-primary btn-play ripple mx-auto mb-5 position-absolute" style="top:50%; left: 50%; transform: translate(-50%,-50%); z-index:3;" data-glightbox><i class="icn-caret-right"></i></a>
        <div class="shape rounded bg-soft-primary rellax d-md-block" data-rellax-speed="0" style="bottom: -1.8rem; right: -1.5rem; width: 85%; height: 90%; "></div>
        <figure class="rounded"><img src="../assets/img/web/selfpaced.png" srcset="../assets/img/web/selfpaced.png" alt=""></figure>
      </div>
      <!--/column -->
      <div class="col-lg-5 col-xl-4 offset-lg-1">
        <h3 class="display-4 mb-3">CrunchEconometrix</h3>
        <p class="lead fs-lg mb-6"> a global self-paced learning platform for the study of applied <span class="underline"> Econometrics </span> .</p>
        <ul class="progress-list">
          <li>
            <p>Tutorials and Trainings</p>
            <div class="progressbar line primary" data-value="100"></div>
          </li>
          <li>
            <p>Research and Publications</p>
            <div class="progressbar line primary" data-value="99"></div>
          </li>
          <li>
            <p>Datasets & Dofiles</p>
            <div class="progressbar line primary" data-value="99"></div>
          </li>
          <li>
        </ul>
        <!-- /.progress-list -->
      </div>
      <!--/column -->
    </div>


    <!--/.row -->
    <div class="row gy-6 align-items-center mb-14 mb-md-18">
      <div class="col-lg-4">
        <h3 class="display-4 mb-5">Online Courses</h3>
        <small class="lead fs-lg mb-5">Buy comprehensive courses on Econometrics using Stata, Excel and EViews analytical software</small>

      </div>
      <!--/column -->
      <div class="col-lg-6 offset-lg-2 pricing-wrapper">

        <div class="row gy-6 mt-5">
        <!--
        <div class="col-md-6">
            <div class="pricing card shadow-lg">
              <div class="card-body pb-12">
                <div class="prices text-dark">
                  <div class="price price-show"><span class="price-currency">$</span><span class="price-value">200</span> <span class="price-duration">life time access</span></div>
                </div>
                
                <h4 class="card-title mt-2">Hands-on Econometrics for Beginners and Advanced Users (H.E.B.A)</h4>
                <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
                  <li><i class="uil uil-check"></i><span> 14 hours on-demand video </span></li>
                  <li><i class="uil uil-check"></i><span>90 downloadable resources</span></li>
                  <li><i class="uil uil-check"></i><span>Full lifetime access</span></li>
                  <li><i class="uil uil-check"></i><span>Access on mobile and TV</span></li>
                  <li><i class="uil uil-check"></i><span>Certificate of completion</span></li>
                </ul>
                <a href="#" disabled class="btn btn-primary rounded-pill">Buy on CrunchEconometrix </a>
              </div>
            </div>
          </div> -->
          <div class="col-md-8 popular">
            <div class="pricing card shadow-lg">
              <div class="card-body pb-12">
                <div class="prices text-dark">
                  <div class="price price-show"><span class="price-currency">$</span><span class="price-value">200</span> <span class="price-duration">lifetime access</span></div>
                </div>
                <!--/.prices -->
                <h4 class="card-title mt-2">Practical Econometrics for Researchers, Beginners and Advanced-Level Users (P.E.R.B.A)</h4>
                <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
                  <li><i class="uil uil-check"></i><span> 10 hours on-demand video </span></li>
                  <li><i class="uil uil-check"></i><span>80+ downloadable resources</span></li>
                  <li><i class="uil uil-check"></i><span>Full lifetime access</span></li>
                  <li><i class="uil uil-check"></i><span>Access on mobile and TV</span></li>
                  <li><i class="uil uil-check"></i><span>Certificate of completion</span></li>
                </ul>
                <a href="https://cruncheconometrix.teachable.com/p/practical-econometrics-for-researchers-beginners-and-advanced-level-users-perba" class="btn btn-primary rounded-pill">Buy on Teachable</a>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.pricing -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!--/column -->
    </div>
    <!--/.row -->
    <div class="card bg-soft-primary rounded-4">
      <div class="card-body p-md-10 p-xl-11">
        <div class="row gx-lg-8 gx-xl-12 gy-10">
          <div class="col-lg-6">
            <h3 class="display-4 mb-4">Frequently Asked Questions</h3>
            <p class="lead fs-lg mb-0">If you don't see an answer to your question, you can send us an email using our contact form.</p>
          </div>
          <!--/column -->
          <div class="col-lg-6">
            <div class="accordion accordion-wrapper" id="accordionExample">
              <div class="card plain accordion-item">
                <div class="card-header" id="headingOne">
                  <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Do you have free tutorials on Econometrics?</button>
                </div>
                <!--/.card-header -->
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="card-body">
                    <p>Yes! Excited? You can access over 150 free Econometrics tutorials on our Youtube channel by clicking this button <a href="https://www.youtube.com/c/CrunchEconometrix" class="btn btn-primary rounded-pill mt-2">CrunchEconometrix</a>. Kindly subscribe to get updates from the channel.</p>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.accordion-collapse -->
              </div>
              <!--/.accordion-item -->
              <div class="card plain accordion-item">
                <div class="card-header" id="headingTwo">
                  <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How long do I have access to paid courses?</button>
                </div>
                <!--/.card-header -->
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="card-body">
                    <p>How does lifetime access sound? After enrolling, you have unlimited access to this course for as long as you like - across any and all devices you own.</p>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.accordion-collapse -->
              </div>
              <!--/.accordion-item -->
              <div class="card plain accordion-item">
                <div class="card-header" id="headingThree">
                  <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">When does the online course start and finish?</button>
                </div>
                <!--/.card-header -->
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="card-body">
                    <p>Our online courses start now and never end! It is a completely self-paced online course - you decide when you start and when you finish.</p>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.accordion-collapse -->
              </div>
              <!--/.accordion-item -->
              <div class="card plain accordion-item">
                <div class="card-header" id="headingFour">
                  <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">How do I access datasets and dofiles ?</button>
                </div>
                <!--/.card-header -->
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                  <div class="card-body">
                    <p>All Stata do-files attract payment of a token fee. All Crunch Datasets attract payment of a token fee. Datasets from Gujarati & Porter, JM Wooldridge and Lahoti et al (2016) are free. Before you purchase any of them, you will be required to create an account which will used to access your purchased datasets and dofiles.</p>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.accordion-collapse -->
              </div>
              <!--/.accordion-item -->
            </div>
            <!--/.accordion -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!--/.card-body -->
    </div>
    <!--/.card -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->

<?php
include '../assets/php/footer.php';
?>