<?php
include '../assets/php/header.php';
include '../assets/php/navbar.php';
?>

<section class="wrapper bg-light">
  <div class="container py-14 py-md-16 text-center">
    <div class="row">
      <div class="col-md-9 col-lg-7 col-xl-7 mx-auto text-center">
        <img src="../assets/img/icons/lineal/email-3.svg" class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
        <h2 class="display-4 mb-3">Signup for our newsletter</h2>
        <p class="lead fs-lg mb-6 px-xl-10 px-xxl-15">Join our 25,000+ learning community of econometrics enthusiast. Get updates on publications, tutorials and trainings</p>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-md-6 col-lg-5 col-xl-4 mx-auto">
        <div class="newsletter-wrapper">
          <!-- Begin Mailchimp Signup Form -->
          <div id="mc_embed_signup2">
            <form action="https://cruncheconometrix.us14.list-manage.com/subscribe/post?u=91f747811beb97439d6a30c50&amp;id=f2cdd23f70" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
              <div id="mc_embed_signup_scroll2">
                <div class="mc-field-group input-group form-floating">
                  <input type="email" value="" name="EMAIL" class="required email form-control" placeholder="Email Address" id="mce-EMAIL">
                  <label for="mce-EMAIL2">Email Address</label>
                  <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-primary">
                </div>
                <div id="mce-responses2" class="clear">
                  <div class="response" id="mce-error-response2" style="display:none"></div>
                  <div class="response" id="mce-success-response2" style="display:none"></div>
                </div> <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" value="Subscribe" name="subscribe" id="mc-embedded-subscribe"></div>
                <div class="clear"></div>
              </div>
            </form>
          </div>
          <!--End mc_embed_signup-->
        </div>
        <!-- /.newsletter-wrapper -->
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>

<section class="wrapper bg-light angled upper-end">
  <div class="container pb-11">

    <!-- /.row -->
    <div class="row">
      <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">

        <h2 class="display-4 mb-3 text-center">Drop Us a Line</h2>
        <p class="lead text-center mb-10">Reach out to us from our contact form and we will get back to you shortly.</p>
        <form id="contact-form" class="contact-form needs-validation" method="post" action="../assets/php/contact.php" role='form' novalidate>
          <div class="messages"></div>
          <div class="row gx-4">
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="form_name" type="text" name="name" class="form-control" placeholder="Jane" required>
                <label for="form_name">First Name *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your first name. </div>
              </div>
            </div>
            <!-- /column -->
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Doe" required>
                <label for="form_lastname">Last Name *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your last name. </div>
              </div>
            </div>
            <!-- /column -->
            <div class="col-md-6">
              <div class="form-floating mb-4">
                <input id="form_email" type="email" name="email" class="form-control" placeholder="jane.doe@example.com" required>
                <label for="form_email">Email *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please provide a valid email address. </div>
              </div>
            </div>
            <!-- /column -->
            <div class="col-md-6">
              <div class="form-select-wrapper mb-4">
                <select class="form-select" id="form-select" name="feedback" required>
                  <option selected disabled value="">Select Feedback Type </option>
                  <option value="Publications">Publications</option>
                  <option value="Tutorials">Tutorials</option>
                  <option value="Questions">Questions</option>
                  <option value="Consultancy">Consultancy</option>
                  <option value="Sales">Sales</option>
                  <option value="Others">Others</option>
                </select>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please select a Feedback Type. </div>
              </div>
            </div>
            <!-- /column -->
            <div class="col-12">
              <div class="form-floating mb-4">
                <textarea id="form_message" name="message" class="form-control" placeholder="Your message" style="height: 150px" required></textarea>
                <label for="form_message">Message *</label>
                <div class="valid-feedback"> Looks good! </div>
                <div class="invalid-feedback"> Please enter your messsage. </div>
              </div>
            </div>
            <!-- /column -->
            <div class="col-12 text-center">
              <input type="submit" class="btn btn-primary rounded-pill btn-send mb-3" value="Send message">
              <p class="text-muted"><strong>*</strong> These fields are required.</p>
            </div>
            <!-- /column -->
          </div>
          <!-- /.row -->
        </form>
        <!-- /form -->
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light">
  <div class="container py-14 py-md-16">
    <div class="row">
      <div class="col-xl-10 mx-auto">
        <div class="card">
          <div class="row gx-0">
            <div class="col-lg-6 align-self-stretch">

              <div class="map map-full rounded-top rounded-lg-start">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15851.193601019742!2d3.1605873!3d6.6718842!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3891fe7b5521a9cd!2sCrunchEconometrix!5e0!3m2!1sen!2sng!4v1648635094634!5m2!1sen!2sng" style="width:100%; height: 100%; border:0" allowfullscreen></iframe>
              </div>
              <!-- /.map -->
            </div>
            <!--/column -->
            <div class="col-lg-6">
              <div class="p-10 p-md-11 p-lg-14">
                <div class="d-flex flex-row">
                  <div>
                    <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
                  </div>

                  <div class="align-self-start justify-content-start">
                    <h5 class="mb-1">Address</h5>
                    <address>CBSS Building, Covenant University, Idiroko Rd, Ota, Ogun state, Nigeria</address>
                  </div>
                </div>
                <!--/div -->


                <div class="d-flex flex-row">
                  <div>
                    <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-envelope"></i> </div>
                  </div>

                  <div>
                    <h5 class="mb-1">E-mail</h5>
                    <p class="mb-0"><a href="mailto:cruncheconometrix@gmail.com" class="link-body">cruncheconometrix@gmail.com</a></p>
                    <p class="mb-0"><a href="mailto:info@cruncheconometrix.com.ng" class="link-body">info@cruncheconometrix.com.ng</a></p>
                  </div>
                </div>
                <!--/div -->
              </div>
              <!--/div -->
            </div>
            <!--/column -->
          </div>
          <!--/.row -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->
<?php
include '../assets/php/footer.php';
?>
