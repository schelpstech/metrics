<?php
$tblName = 'trans_tbl';
$conditions = array(
    'return_type' => 'count',
    'where' => array(
        'trans_ref' => $trans_ref,
    )

);
$trans = $model->getRows($tblName, $conditions);
if ($trans >= 1) {

    $tblName = 'trans_tbl';
    $conditions = array(
        'return_type' => 'single',
        'where' => array(
            'trans_ref' => $trans_ref,
        )

    );
    $trans_details = $model->getRows($tblName, $conditions);
    $trans_time =  $trans_details['trans_time'];
    $trans_user =  $trans_details['trans_user'];
    $trans_cart =  $trans_details['trans_cart'];
    $trans_amount =  $trans_details['trans_amount'];
    $trans_status =  $trans_details['trans_status'];

    $tablename = 'crunch_user';
    $conditions = array(
        'return_type' => 'single',
        'where' => array(
            'useremail' => $trans_user,
        ),
    );
    $userdetails = $model->getRows($tablename, $conditions);




?>
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Transaction Overview</h2>
                                    <div class="invoice-number"><?php if ($trans_status == 1) {
                                                                    echo '<h1 style="color: green;text-align: center;"><strong> PAID </strong></h1>';
                                                                } else {
                                                                    echo '<h1 style="color: red;text-align: center;"><strong> UNPAID </strong></h1>';
                                                                } ?></div>
                                    <br>
                                    <div class="invoice-number"><br>Order #<?php echo $trans_ref ?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Billed To:</strong><br>
                                            <?php echo ucwords($userdetails['user_firstname'] . " " . $userdetails['user_surname']); ?><br>
                                            <?php echo $trans_user ?>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Order Date:</strong><br>
                                            <?php echo $trans_time ?><br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="section-title">Order Summary</div>
                                <p class="section-lead">All items here cannot be deleted.</p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <tr>
                                            <th data-width="40">#</th>
                                            <th>Item</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Totals</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            $count = 1;
                                            $tablename = 'cart_log';
                                            $conditions = array(
                                                'where' => array(
                                                    'token' => $trans_cart,
                                                    'item_status' => 1,
                                                    'user_id' =>  $trans_user,
                                                ),
                                            );
                                            $cartview = $model->getRows($tablename, $conditions);

                                            foreach ($cartview as $view) {

                                                $tbl = 'prod_sku';
                                                $condition = array(
                                                    'return_type' => 'single',
                                                    'where' => array(
                                                        'prod_sku' => $view['prod_sku'],
                                                    ),
                                                );
                                                $product_details = $model->getRows($tbl, $condition);
                                            ?>

                                        <tr>
                                            <td> <?php echo $count++ ?></td>
                                            <td><?php echo $product_details['prod_name'] . ' - ' . $product_details['prod_type'] ?></td>
                                            <td class="text-center"><?php echo $product_details['prod_price'] ?></td>
                                            <td class="text-center">1</td>
                                            <td class="text-center"><?php echo $product_details['prod_price'] ?></td>
                                        </tr>
                                    <?php
                                            }
                                    ?>
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-8">

                                    </div>
                                    <div class="col-lg-4 text-right">

                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total Amount</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg"><?php echo $trans_amount ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                        <div class="float-lg-left mb-lg-0 mb-3">

                        </div>
                        <button onclick="window.print()" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
} else {
?>
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Transaction Overview</h2>
                                    <div class="invoice-number">
                                        <h1 style="color: red;text-align: center;"><strong> Invalid Transaction Reference </strong></h1>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
}
?>