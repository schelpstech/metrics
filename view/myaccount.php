<?php
include '../assets/php/header.php';
include '../assets/php/navbar.php';
?>
<?php

if (isset($_SESSION['msg'])) {
  printf('<b>%s</b>', $_SESSION['msg']);
  unset($_SESSION['msg']);
}
?>

<section class="wrapper bg-light">
  <div class="container">
    <div class="card bg-soft-primary rounded-4 mt-2 mb-13 mb-md-17">
      <div class="card-body p-md-10 py-xl-11 px-xl-15">
        <div class="row gx-lg-8 gx-xl-0 gy-10 align-items-center">
          <h2 class="mb-5">Purchased Resources</h2>
          <div class="accordion accordion-wrapper" id="accordionIconExample">
           
          <?php
           $tblName = 'permission_tbl';
           $conditions = array(
                  'order_by'=> 'rectime DESC',
                  'where' => array(
                  'user_id' => $_SESSION['uniqueid'],
                  )
                );
                $get_item = $model->getRows($tblName, $conditions);
                if(!empty ($get_item)){

                
                foreach($get_item as $item){
                  $permission = $item['dwn_count'];
                  $trans_ref = $item['trans_ref'];
                  $cart_ref = $item['cart_ref'];
                  $date = $item['rectime'];
                  $tablename = 'prod_sku';
                  $conditions = array(
                    'return_type' => 'single',
                    'where' => array(
                        'prod_sku' => $item['prod_sku'],
                    )
                    );
                    $product_details = $model->getRows($tablename, $conditions);
                    

                    echo '
                    <div class="card accordion-item icon">
                    <div class="card-header" id="headingIconOne">
                      <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseIconOne'.$product_details['prod_sku'].$cart_ref.$trans_ref.'" aria-expanded="false" aria-controls="collapseIconOne'.$product_details['prod_sku'].$cart_ref.$trans_ref.'"><span><i class="uil uil-play-circle"></i></span>'.$product_details['prod_name'].'</button>
                    </div>
                    <!--/.card-header -->
                    <div id="collapseIconOne'.$product_details['prod_sku'].$cart_ref.$trans_ref.'" class="accordion-collapse collapse" aria-labelledby="headingIconOne" data-bs-parent="#accordionIconExample">
                      <div class="card-body">
                        
                        <p> <strong>Resource Type :</strong> '.$product_details['prod_type'].'</p>
                        <p> <strong> Description :</strong> '.$product_details['prod_desc'].'</p>
                        <p> <strong>Amount Paid : </strong> '.$product_details['prod_price'].'</p>
                        <p> <strong>Remaining Download Access : </strong> '.$permission.'</p>
                        <p> <strong> Date Purchased : </strong>'.$date.'</p>
                        <a class="btn btn-primary btn-icon btn-icon-start rounded">
                              <i class="uil uil-money-withdraw"></i> Download Resources
                            </a>  
                      </div>
                      <!--/.card-body -->
                    </div>
                    <!--/.accordion-collapse -->
                  </div>
                    ';

                }
              }else{
                echo 'No purchases made ';
              }


          ?>
       
            

</section>
<?php
include '../assets/php/footer.php';
?>