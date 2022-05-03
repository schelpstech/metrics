<?php
include "../include/nav.php";
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            
            
            <div class="row">
              <div class="col-xl-3 col-lg-6">
                <div class="card">
                  <div class="card-bg">
                    <div class="p-t-20 d-flex justify-content-between">
                      <div class="col">
                        <h6 class="mb-0">Total Userbase</h6>
                        <span class="font-weight-bold mb-0 font-20"><?php echo  $count_user ?> users</span>
                      </div>
                      <i class="fas fa-address-card card-icon col-orange font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart1" height="80"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card">
                  <div class="card-bg">
                    <div class="p-t-20 d-flex justify-content-between">
                      <div class="col">
                        <h6 class="mb-0">Online Today</h6>
                        <span class="font-weight-bold mb-0 font-20"><?php echo  $login_count_today ?> users</span>
                      </div>
                      <i class="fas fa-diagnoses card-icon col-green font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart2" height="80"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card">
                  <div class="card-bg">
                    <div class="p-t-20 d-flex justify-content-between">
                      <div class="col">
                        <h6 class="mb-0">Users with Item in Cart</h6>
                        <span class="font-weight-bold mb-0 font-20"><?php echo  $cart_users ?></span>
                      </div>
                      <i class="fas fa-cart-plus card-icon col-indigo font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart3" height="80"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                <div class="card">
                  <div class="card-bg">
                    <div class="p-t-20 d-flex justify-content-between">
                      <div class="col">
                        <h6 class="mb-0">Paying Users</h6>
                        <span class="font-weight-bold mb-0 font-20"><?php echo  $paying_users ?> users</span>
                      </div>
                      <i class="fas fa-hand-holding-usd card-icon col-cyan font-30 p-r-30"></i>
                    </div>
                    <canvas id="cardChart4" height="80"></canvas>
                  </div>
                </div>
              </div>
            </div>
           
           
            
           
            <div class="row">
              <div class="col-12 col-sm-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Who's Online?</h4>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                    <?php
                    if(!empty($login_view)){
                      foreach($login_view as $view){
                        $tbl = 'crunch_user';

                        $conditions = array(
                          'return_type' => 'single',
                          'where' => array(
                            'useremail' => $view['userid'],
                          ),
                        );
                        $online = $model->getRows($tbl, $conditions);
                        echo'
                        <li class="media">
                      <i class="fas fa-diagnoses card-icon col-green font-30 p-r-30" width="50"></i>
                        <div class="media-body">
                          <div class="mt-0 mb-1 font-weight-bold">'.$online['useremail'].' - '.$online['user_firstname'].' '.$online['user_surname'].'</div>
                          <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div>
                        </div>
                      </li>
                        ';
                      }
                    }else{
                      echo'
                      <li class="media">
                      <i class="fas fa-diagnoses card-icon col-green font-30 p-r-30" width="50"></i>
                        <div class="media-body">
                          <div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> No Active User</div>
                        </div>
                      </li>
                      ';
                    }
                    ?> 
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>New Users</h4>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                      
                    <?php
                    if(!empty($latest_user)){
                      foreach($latest_user as $view){
                      
                        echo'
                        <li class="media">
                        <i class="fas fa-address-card card-icon col-orange font-30 p-r-30"></i>
                        <div class="media-body">
                          <div class="mt-0 mb-1 font-weight-bold">'.$view['user_firstname'].' '.$view['user_surname'].'</div>
                          <div class="text-warning text-small font-600-bold"><i class="fas fa-envelope"></i> '.$view['useremail'].'</div>
                        </div>
                      </li>
                        ';
                      }
                    }else{
                      echo'
                      <li class="media">
                      <i class="fas fa-address-card card-icon col-orange font-30 p-r-30"></i>
                      <div class="media-body">
                        <div class="mt-0 mb-1 font-weight-bold">No User Yet</div>
                        <div class="text-muted text-small font-600-bold"><i class="fas fa-address-card"></i></div>
                      </div>
                    </li>
                      ';
                    }
                    ?>
                    </ul>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
        </section>
<?php
include "../include/footer.php";
?>