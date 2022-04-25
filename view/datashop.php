<?php
include '../assets/php/header.php';
include '../assets/php/navbar.php';
require_once('../app/utility.php');
//check cart_token

if (isset($_SESSION['cart_token'])) {
    $cart_token = $_SESSION['cart_token'];
} else {
    $cart_token =  generateRandomText();
    $_SESSION['cart_token'] =  $cart_token;
}
//check user id 
if (isset($_SESSION['uniqueid'])) {
    $cart_user = $_SESSION['uniqueid'];
} elseif (isset($_SESSION['cart_user'])) {
    $cart_user = $_SESSION['cart_user'];
} else {
    $cart_user = 'guest_' . $cart_token;
    $_SESSION['cart_user'] = $cart_user;
}
?>

<!-- /section -->
<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row align-items-center mb-10 position-relative zindex-1">
            <div class="col-md-8 col-lg-9 col-xl-8 col-xxl-7 pe-xl-20">
                <h2 class="display-6">CrunchEconometrix Mart</h2>
                <nav class="d-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop :: Access all free and premium datasets and dofiles</li>
                    </ol>
                </nav>
                <!-- /nav -->
            </div>
            <!--/column -->
            <div class="col-md-4 col-lg-3 ms-md-auto text-md-end mt-5 mt-md-0">
                <div class="form-select-wrapper" id="cart_button">
                <button class="btn btn-outline-gradient gradient-1 rounded-pill me-1 mb-2 mb-md-0" onclick="window.location.replace('./mycart.php');"><i class="uil uil-shopping-cart"></i><span> <?php if (isset($_SESSION['cart_check'])) { echo $_SESSION['cart_check'];} else{echo 0;}?> item(s) in cart</span></button>
                </div>
                <!--/.form-select-wrapper -->
            </div>
            <!--/column -->
        </div>
        <?php

        if (isset($_SESSION['msg'])) {
            printf('<b>%s</b>', $_SESSION['msg']);
            unset($_SESSION['msg']);
        }
        ?>
        <!--/.row -->
        <div class="grid grid-view projects-masonry shop mb-13">
            <div class="row gx-md-8 gy-10 gy-md-13 isotope">
                <?php
                $count = 1;
                $tablename = 'prod_sku';
                $productview = $model->select_all($tablename);
                if (!empty($productview)) {
                    foreach ($productview as $view) {


                ?>
                        <div class="project item col-md-6 col-xl-4">
                            <figure class="rounded mb-6">
                                <img src=" <?php echo $view['prod_img']; ?>" srcset="<?php echo $view['prod_img']; ?>" alt="" />
                                <?php

                                $tblName = 'cart_log';
                                $conditions = array(
                                    'return_type' => 'single',
                                    'where' => array(
                                        'prod_sku' => $view['prod_sku'],
                                        'user_id' => $cart_user,
                                        'token' => $cart_token,
                                    )

                                );
                                $checkcart = $model->getRows($tblName, $conditions);
                                if (!empty($checkcart)) {
                                    if ($checkcart['item_status'] == 0) {
                                        echo '  <button  id="' . $view['prod_sku'] . '" onclick="' . $view['prod_sku'] . '()" class="item-cart"><i class="uil uil-shopping-bag"></i> Add to Cart</button>
                                            <button style="display:none;" id="' . $view['prod_sku'] . 'removed" onclick="' . $view['prod_sku'] . 'remove()" class="item-cart"><i class="uil uil-shopping-bag"></i> Remove from Cart</button>';
                                    } elseif ($checkcart['item_status'] == 1) {
                                        echo '  <button style="display:none;" id="' . $view['prod_sku'] . '" onclick="' . $view['prod_sku'] . '()" class="item-cart"><i class="uil uil-shopping-bag"></i> Add to Cart</button>
                                            <button  id="' . $view['prod_sku'] . 'removed" onclick="' . $view['prod_sku'] . 'remove()" class="item-cart"><i class="uil uil-shopping-bag"></i> Remove from Cart</button>';
                                    }
                                } else {
                                    echo '  <button  id="' . $view['prod_sku'] . '" onclick="' . $view['prod_sku'] . '()" class="item-cart"><i class="uil uil-shopping-bag"></i> Add to Cart</button>
                                        <button style="display:none;" id="' . $view['prod_sku'] . 'removed" onclick="' . $view['prod_sku'] . 'remove()" class="item-cart"><i class="uil uil-shopping-bag"></i> Remove from Cart</button>';
                                }

                                ?>


                            </figure>
                            <div class="post-header">
                                <div class="d-flex flex-row align-items-center justify-content-between mb-2">
                                    <div class="post-category text-ash mb-0"> 
                                        <h2 class="price"> <ins><span class="amount">&#8358;<?php echo $view['prod_price']; ?></span></ins></h2>
                                    </div>
                                    <span class="post-category text-ash mb-0"><?php echo $view['prod_type'] ?></span>
                                </div>
                                <h2 class="post-title h3 fs-22"><a href="./shop-product.html" class="link-dark"> <?php echo $view['prod_name']; ?></a></h2>
                               
                                <p class="price"><?php echo $view['prod_desc']; ?> </p>
                            </div>
                            <!-- /.post-header -->

                            <script>
                                // Addt Item to Cart
                                function <?php echo $view['prod_sku']; ?>() {

                                    var product_sku = '<?php echo $view['prod_sku']; ?>';
                                    var uniqueid = '<?php echo $cart_user; ?>';
                                    var token = '<?php echo $cart_token; ?>';
                                    var action = 'add_to_cart';
                                    $.ajax({
                                        url: '../app/managecart.php',
                                        method: 'POST',
                                        data: {
                                            product_sku: product_sku,
                                            token: token,
                                            uniqueid: uniqueid,
                                            action: action
                                        },
                                        success: function(data) {

                                            if (data >= 0) {
                                                var cartbutton = '<a href="./mycart.php" class="btn btn-outline-gradient gradient-1 rounded-pill me-1 mb-2 mb-md-0 " ><i class="uil uil-shopping-cart"></i><span>'+data+' item(s) in cart</span></a>';
                                                $("#cart_button").html(cartbutton);
                                                $("#cart_notify").html(data);
                                                $("#<?php echo $view['prod_sku']; ?>").hide();
                                                $("#<?php echo $view['prod_sku'] . 'removed'; ?>").show();
                                            } else {
                                                alert(data);

                                            }
                                        }
                                    });
                                }
                                //Remove Item from Cart
                                function <?php echo $view['prod_sku'] . 'remove'; ?>() {

                                    var product_sku = '<?php echo $view['prod_sku']; ?>';
                                    var uniqueid = '<?php echo $cart_user; ?>';
                                    var token = '<?php echo $cart_token; ?>';
                                    var action = 'delete_from_cart';
                                    $.ajax({
                                        url: '../app/managecart.php',
                                        method: 'POST',
                                        data: {
                                            product_sku: product_sku,
                                            token: token,
                                            uniqueid: uniqueid,
                                            action: action
                                        },
                                        success: function(data) {

                                            if (data >= 0) {
                                                var cartbutton = '<a href="./mycart.php" class="btn btn-outline-gradient gradient-1 rounded-pill me-1 mb-2 mb-md-0 " ><i class="uil uil-shopping-cart"></i><span>'+data+' item(s) in cart</span></a>';
                                                $("#cart_button").html(cartbutton);
                                                $("#cart_notify").html(data);
                                                $("#<?php echo $view['prod_sku']; ?>").show();
                                                $("#<?php echo $view['prod_sku'] . 'removed'; ?>").hide();
                                                                                                   
                                            } else {
                                                alert(data);
                                            }
                                        }
                                    });
                                }
                            </script>
                        </div>
                        <!-- /.item -->
                <?php
                    }
                } else {
                    echo ' No Product Found';
                }
                ?>



            </div>
            <!-- /.row -->
        </div>
        <!-- /.grid -->
        <nav class="d-flex justify-content-center" aria-label="pagination">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="uil uil-arrow-left"></i></span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="uil uil-arrow-right"></i></span>
                    </a>
                </li>
            </ul>
            <!-- /.pagination -->
        </nav>
        <!-- /nav -->

    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-gray">
    <div class="container py-12 py-md-14">
        <div class="row gx-lg-8 gx-xl-12 gy-8">

            <!--/column -->
            <div class="col-md-6 col-lg-4">
                <div class="d-flex flex-row">
                    <div>
                        <img src="../assets/img/icons/solid/verify.svg" class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
                    </div>
                    <div>
                        <h4 class="mb-1">Consistent Datasets</h4>
                        <p class="mb-0">Our datasets are uptodate and have been cleaned to suit your analysis</p>
                    </div>
                </div>
            </div>
            <!--/column -->
            <div class="col-md-6 col-lg-4">
                <div class="d-flex flex-row">
                    <div>
                        <img src="../assets/img/icons/lineal/tools.svg" class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
                    </div>
                    <div>
                        <h4 class="mb-1">Deployable Dofiles</h4>
                        <p class="mb-0">All dofiles are worthwhile templates for your analysis.</p>
                    </div>
                </div>
            </div>
            <!--/column -->
            <div class="col-md-6 col-lg-4">
                <div class="d-flex flex-row">
                    <div>
                        <img src="../assets/img/icons/lineal/download.svg" class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
                    </div>
                    <div>
                        <h4 class="mb-1">One Time Download</h4>
                        <p class="mb-0">All datasets and dofiles purchased have one time download access.</p>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->

<?php
include '../assets/php/footer.php';
?>