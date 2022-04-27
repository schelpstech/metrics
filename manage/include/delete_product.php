<?php

$tblName = 'prod_sku';
$conditions = array(
    'return_type' => 'single',
    'where' => array(
        'prod_sku' => $sku,
    )

);
$product_details = $model->getRows($tblName, $conditions);

if (!empty($product_details)) {
    $prod_name =  $product_details['prod_name'];
    $prod_price =  $product_details['prod_price'];
    $prod_type =  $product_details['prod_type'];
    $_SESSION['prod_path'] =  $product_details['prod_path'];
}
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 offset-lg-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>CrunchEconometrix :: Delete This Product </h4><br>
                            <?php

                            if (isset($_SESSION['msg'])) {
                                printf('<b>%s</b>', $_SESSION['msg']);
                                unset($_SESSION['msg']);
                            }
                            ?>
                        </div>
                        <form method="POST" action="../../app/productaction.php" enctype="multipart/form-data">
                            <div class="card-body">


                                <div class="form-group" style="display: none;">
                                    <label>Product SKU</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-anchor"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="prod_id" hidden value="<?php echo $sku ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-cart-plus"></i>
                                            </div>
                                        </div>
                                        <input type="text" disabled class="form-control" required="yes" value="<?php echo $prod_name ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Product Type</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-retweet"></i>
                                            </div>
                                        </div>
                                        <input type="text" disabled class="form-control currency" required="yes" value="<?php echo $prod_type ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Product Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-fas fa-donate"></i>
                                            </div>
                                        </div>
                                        <input type="text" disabled class="form-control currency" required="yes" maxlength="4" minlength="4" value="<?php echo $prod_price ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="color: red;"><strong> Type "delete" to authenticate delete </strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-fas fa-anchor"></i>
                                            </div>
                                        </div>
                                        <input type="text" id="control" class="form-control currency" required="yes" onchange="control_button()">
                                    </div>
                                </div>


                                <div class="card-footer text-right" id="ctrl_button" style="display: none;">
                                    <input type="submit" name="delete_product" class="btn btn-danger btn-lg" value="Delete This Product" />
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function control_button() {
            var expected = 'delete';
            var actual = document.getElementById("control").value;
            if (expected === actual) {
                $("#ctrl_button").show();
            } else if (expected != actual) {
                $("#ctrl_button").hide();
                alert('Enter delete to authorise delete.');
                document.getElementById("control").value = "";

            }
        }
    </script>