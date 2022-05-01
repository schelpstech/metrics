<?php
require_once('../controller/start.inc.php');
if (isset($_SESSION['msg'])) {
  printf('<b>%s</b>', $_SESSION['msg']);
  unset($_SESSION['msg']);
}
?>

<section id="my_files" class="wrapper bg-light">
  <div class="container">
    <div class="card bg-soft-primary rounded-4 mt-2 mb-13 mb-md-17">
      <div class="card-body p-md-10 py-xl-11 px-xl-15">
        <div class="row gx-lg-8 gx-xl-0 gy-10 align-items-center">
          <h2 class="mb-5">Purchased Resources</h2>
          <div class="accordion accordion-wrapper" id="accordionIconExample">
           
          <?php
          if(!isset($_SESSION['uniqueid'])){
            $owner = $_POST['owner'];
          }else{
            $owner = $_SESSION['uniqueid'];
          }
           $tblName = 'permission_tbl';
           $conditions = array(
                  'order_by'=> 'rectime DESC',
                  'where' => array(
                  'user_id' => $owner,
                  )
                );
                $get_item = $model->getRows($tblName, $conditions);
                if(!empty ($get_item)){

                
                foreach($get_item as $item){
                  $perm_ref = $item['perm_id'];
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
                    ?>
                    <div class="card accordion-item icon">
                    <div class="card-header" id="headingIconOne">
                      <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseIconOne<?php echo $product_details['prod_sku'].$cart_ref.$trans_ref?>" aria-expanded="false" aria-controls="collapseIconOne<?php echo $product_details['prod_sku'].$cart_ref.$trans_ref?>"><span><i class="uil uil-play-circle"></i></span><?php echo $product_details['prod_name']?></button>
                    </div>
                    <!--/.card-header -->
                    <div id="collapseIconOne<?php echo $product_details['prod_sku'].$cart_ref.$trans_ref?>" class="accordion-collapse collapse" aria-labelledby="headingIconOne" data-bs-parent="#accordionIconExample">
                      <div class="card-body">
                        
                        <p> <strong>Resource Type :</strong>  <?php echo $product_details['prod_type']?></p>
                        <p> <strong> Description :</strong>  <?php echo $product_details['prod_desc']?></p>
                        <p> <strong>Amount Paid : </strong>  <?php echo $product_details['prod_price']?></p>
                        <?php
                          if($permission >= 1){
                        ?>
                        <p> <strong>Remaining Download Access : </strong>  <?php echo $permission?></p>
                        
                        <p> <strong> Date Purchased : </strong> <?php echo $date?></p>
                        <a class="btn btn-primary btn-icon btn-icon-start rounded" onclick="link<?php echo $product_details['prod_sku'].$cart_ref.$trans_ref?>()">
                              <i class="uil uil-money-withdraw"></i> Download <?php echo $product_details['prod_type']?>
                        </a>  
                      </div>
                      <!--/.card-body -->
                    </div>
                    <!--/.accordion-collapse -->
                  </div>
                    <script>
                        function link<?php echo $product_details['prod_sku'].$cart_ref.$trans_ref?>() 
                        {

                            var link = document.createElement("a");
                            var file_ref = '<?php echo $product_details['prod_path'] ?>';
                            var count = file_ref.length;
                            var extension = file_ref.substring((count - 6), count);
                            var name =  "<?php echo str_replace( array( '\'', '"',',' , ';', '<', '>' ), ' ', $product_details['prod_name'])?>.'"+extension;
                            
                                    var perm_ref = '<?php echo $perm_ref;?>';
                                    var owner = '<?php echo $owner;?>';
                                    $.ajax({
                                        url: '../app/record_download.php',
                                        method: 'POST',
                                        data: {                                            
                                          perm_ref: perm_ref
                                        },
                                        success: function(data) {
                                          if(data == 11){
                                            link.setAttribute("download", name);
                                            link.href = file_ref;
                                            document.body.appendChild(link);
                                            link.click();
                                            link.remove();
                                            $(document).ready(function(){
		
                                            $.ajax({
                                              url: '../app/process_src.php',
                                              method: 'POST',
                                              data: {                                            
                                                owner: owner
                                              },
                                              success: function(data){
                                                $("#my_files").html(data);
                                              }
                                            })
                                          });
                                          }
                                        }
                                      })
                        };
                    </script>
                <?php
                          }else{
                ?>
                           <p> <strong>Remaining Download Access : </strong>  <?php echo $permission?></p>
                           <p style="color:red;"> <strong> File already downloaded on   <?php echo $date?></strong></p>
                <?php
                          }
                ?>
                <?php
                  }
                  }else{
                      echo 'No purchases made ';
                      }
                ?>
       
            

</section>