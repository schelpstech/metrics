<?php
include "../include/nav.php";

?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body" >
          <?php
							
              if (isset($_SESSION['msg']) )
              {
                printf('<b>%s</b>', $_SESSION['msg']);
                unset($_SESSION['msg']);
              }
            ?>
            <!-- add content here -->
          </div>
        </section>
        <section class="section">
          <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">User Accounts Created</h5>
                          <h2 class="mb-3 font-18"><?php echo  $count_user ?> users</h2>
                          
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">  Website Visitors</h5>
                          <h2 class="mb-3 font-18">0</h2>
                        
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Ordered Items</h5>
                          <h2 class="mb-3 font-18"><?php echo  $count_order ?> orders</h2>
                         
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15"> Sales Revenue</h5>
                          <h2 class="mb-3 font-18">&#8358; <?php echo  $sum_order['total_revenue'] ?></h2>
                          
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
              <div class="card ">
                <div class="card-header">
                  <h4>Today's Performance Report</h4>
                 
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div id="chart1"></div>
                      <div class="row mb-0">
                      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
                          <div class="list-inline text-center">
                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                class="col-green"></i>
                              <h5 class="m-b-0">109.59 users</h5>
                              <h5 class="m-b-0">0.11%</h5>
                              <p class="text-muted font-14 m-b-0">Website Visitors</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
                          <div class="list-inline text-center">
                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                class="col-green"></i>
                                <h5 class="m-b-0"><?php echo  $login_count_today?></h5>
                              <h5 class="m-b-0"><?php echo round((( $login_count_today / $login_count) * 100),2) ?>%</h5>
                              <p class="text-muted font-14 m-b-0"><small> Login Activity Today</small> </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
                          <div class="list-inline text-center">
                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                class="col-green"></i>
                              <h5 class="m-b-0"><?php echo  $count_user_today ?></h5>
                              <h5 class="m-b-0"><?php echo round((($count_user_today / $count_user) * 100),2) ?>%</h5>
                              <p class="text-muted font-14 m-b-0"><small> User Account Created Today</small> </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
                          <div class="list-inline text-center">
                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                 class="col-green"></i>
                              <h5 class="m-b-0">&#8358;<?php echo  $sum_order_today['total_revenue'] ?></h5>
                              <h5 class="m-b-0"><?php echo round((( $sum_order_today['total_revenue'] / $sum_order['total_revenue']) * 100),2) ?>%</h5>
                              <p class="text-muted font-14 m-b-0"><small> Revenue Today</small> </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
         
        </section>
 <?php
include "../include/footer.php";
?>