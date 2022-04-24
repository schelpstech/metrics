<?php
include '../assets/php/header.php';
include '../assets/php/navbar.php';
require_once('../app/utility.php');
//check cart_token

if (isset($_SESSION['cart_token'])) {
  $cart_token = $_SESSION['cart_token'];
}
//check user id 
if (isset($_SESSION['uniqueid']) && isset($_SESSION['cart_token']) && isset($_SESSION['cart_check']) && !empty($_SESSION['cart_check'] >= 1)) {
  $cart_user = $_SESSION['uniqueid'];

  $action = '
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <button onclick="makePayment()" class="btn btn-success rounded w-100 mt-4">Proceed to Checkout</button>';
} elseif (isset($_SESSION['cart_user']) && isset($_SESSION['cart_token']) && isset($_SESSION['cart_check']) && !empty($_SESSION['cart_check'] >= 1)) {
  $cart_user = $_SESSION['cart_user'];
  $action = '<a href="#" class="btn btn-primary rounded w-100 mt-4" data-bs-toggle="modal" data-bs-target="#modal-signin"><small>Sign In / Register</small></a>';
} else {
  $user->redirect('../view/index.php');
}

 //Get public key
 $tblName = 'payment';
 $conditions = array(
   'return_type' => 'single',
   'where' => array(
     'payerid' => 1,
   )

 );
 $payment_gateway = $model->getRows($tblName, $conditions);
?>


<section class="wrapper bg-gray">
  <div class="container py-3 py-md-5">
    <nav class="d-inline-block" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="./datashop.php">CrunchEconometrix Mart</a></li>
        <li class="breadcrumb-item active text-muted" aria-current="page">Cart</li>
      </ol>
    </nav>
    <!-- /nav -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->

<section class="wrapper bg-light">
  <div class="container pt-12 pt-md-14 pb-14 pb-md-16">
    <div class="row gx-md-8 gx-xl-12 gy-12">
    <?php

if (isset($_SESSION['msg'])) {
  printf('<b>%s</b>', $_SESSION['msg']);
  unset($_SESSION['msg']);
}
?>
      <div class="col-lg-8">
        <div class="table-responsive">
          <table class="table text-center shopping-cart">
            <thead>
              <tr>
                <th>
                  <div class="h4 mb-0">S/N</div>
                </th>
                <th class="ps-0 w-25">
                  <div class="h4 mb-0 text-start">Item</div>
                </th>
                <th>
                  <div class="h4 mb-0">Price</div>
                </th>

              </tr>
            </thead>
            <tbody>

              <!-- Get Items in Cart  -->
              <?php
              $count_product = 0;
              $sum_prod = 0;
              $count = 1;
              $tblName = 'cart_log';
              $conditions = array(
                'where' => array(
                  'user_id' => !empty($cart_user) ? $cart_user : 0,
                  'token' => !empty($cart_token) ? $cart_token : 0,
                  'item_status' => 1,
                )

              );
              $checkcart = $model->getRows($tblName, $conditions);

              if (!empty($checkcart)) {
                foreach ($checkcart as $view) {
                  $prod_sku =  $view['prod_sku'];

                  //Get Product Details
                  $tblName = 'prod_sku';
                  $conditions = array(
                    'return_type' => 'single',
                    'where' => array(
                      'prod_sku' => $prod_sku,
                    )
                  );
                  $condition = array(
                    'return_type' => 'count',
                    'where' => array(
                      'prod_sku' => $prod_sku,
                    )
                  );
                  $sum_condition = array(
                    'return_type' => 'single',
                    'select' => 'SUM(prod_price) as sum_price',
                    'where' => array(
                      'prod_sku' => $prod_sku,
                    )
                  );
                  $check_product = $model->getRows($tblName, $conditions);
                  $count_prod = $model->getRows($tblName, $condition);
                  $count_product += $count_prod;
                  $sum_product = $model->getRows($tblName, $sum_condition);
                  $sum_prod += $sum_product['sum_price'];
              ?>
                  <tr>
                    <td>
                      <?php echo $count++; ?>
                    </td>
                    <td class="option text-start d-flex flex-row align-items-center ps-0">
                      <figure class="rounded w-17"><a href="#"><img src="<?php echo $check_product['prod_img']; ?>" srcset="<?php echo $check_product['prod_img']; ?>" alt="<?php echo $check_product['prod_type']; ?>" /></a></figure>
                      <div class="w-100 ms-4">
                        <h3 class="post-title h6 lh-xs mb-1"><a href="#" class="link-dark"> <?php echo $check_product['prod_name']; ?></a></h3>
                        <div class="small"> <?php echo $check_product['prod_type']; ?></div>
                        <div class="small"> One time download access</div>

                      </div>
                    </td>
                    <td>
                      <p class="price"> <ins><span class="amount">&#8358;<?php echo !empty($check_product['prod_price']) ? $check_product['prod_price'] : 0; ?></span></ins></p>
                    </td>

                  </tr>
              <?php
                }
              } else {
                echo 'no item in Cart';
              }
              ?>

            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
        <div class="row mt-0 gy-4">
          <div class="col-md-8 col-lg-7">
            <div class="form-floating input-group">
              <input type="url" class="form-control" placeholder="Enter promo code" id="seo-check">
              <label for="seo-check">Enter promo code</label>
              <button class="btn btn-primary" type="button">Apply</button>
            </div>
            <!-- /.input-group -->
          </div>
          <!-- /column -->

        </div>
        <!-- /.row -->
      </div>
      <!-- /column -->
      <div class="col-lg-4">
        <h3 class="mb-4">Order Summary</h3>
        <div class="table-responsive">
          <table class="table table-order">
            <tbody>
              <tr>
                <td class="ps-0"><strong class="text-dark">Subtotal</strong></td>
                <td class="pe-0 text-end">
                  <p class="price">&#8358;<?php echo !empty($sum_prod) ? $sum_prod : 0; ?></p>
                </td>
              </tr>

              <tr>
                <td class="ps-0"><strong class="text-dark">Number of Item</strong></td>
                <td class="pe-0 text-end">
                  <p class="price"><?php echo !empty($count_product) ? $count_product : 0; ?></p>
                </td>
              </tr>
              <tr>
                <td class="ps-0"><strong class="text-dark">Grand Total</strong></td>
                <td class="pe-0 text-end">
                  <p class="price text-dark fw-bold">&#8358;<?php echo !empty($sum_prod) ? $sum_prod : 0; ?></p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php echo !empty($action) ? $action : ''; ?>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>

<?php
include '../assets/php/footer.php';
?>
<script>
  function makePayment() {

    var payable = <?php echo $sum_prod ?>;
    var user = '<?php echo $cart_user ?>';
    var cart = '<?php echo $cart_token ?>';
    var qty = <?php echo $count_product ?>;
    var ref = '<?php echo generateRandomText(); ?>';
    var action = ' Record Tran.saction';
    if (qty === 0) {
      alert("No Item has been added to Cart, Visit CrunchEconometrix Mart ");
      window.location.replace('./datashop.php');
    }
    $.ajax({
      url: '../app/managecart.php',
      method: 'POST',
      data: {

        payable: payable,
        user: user,
        cart: cart,
        qty: qty,
        ref: ref,
        action: action
      },

      success: function(data) {
        if (data === '11') {

          var handler = PaystackPop.setup({
            key: '<?php echo $payment_gateway['public'] ?>',
            email: user,
            amount: payable * 100,
            currency: 'NGN',
            ref: ref,
            callback: function(response) {

              var reference = response.reference;

              $.ajax({
                url: '../app/transaction.php',
                method: 'POST',
                data: {

                  tx_reference: reference
                },

                success: function(data) {
                  if (data == 100) {
                    window.location.replace('./myaccount.php')
                  } else {
                    alert(data);
                  }

                }
              });

              // Make an AJAX call to your server with the reference to verify the transaction
            },
            meta: {
              consumer_id: user,
              consumer_mac: cart,
            },
            customer: {
              email: user,
              phone_number: "",
              name: "",
            },
            onClose: function() {
              alert('Transaction was not completed, window closed.');
            },
          });
          handler.openIframe();

        } else {
          alert("Error occured. Kindly refresh and try again ");
        }
      }
    });
  }
</script>