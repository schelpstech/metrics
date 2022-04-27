<?php
include "../include/nav.php";

if (isset($_GET['sku'])) {
    $sku = $_GET['sku'];

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
        $prod_desc =  $product_details['prod_desc'];
        $prod_price =  $product_details['prod_price'];
        $prod_type =  $product_details['prod_type'];
        $prod_tag =  $product_details['prod_tag'];
        $prod_status =  $product_details['prod_status'];
    }
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
                            <h4>CrunchEconometrix :: Edit Product </h4><br>
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
                                    <label>SKU ID</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-anchor"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="product_sku" hidden value="<?php echo $sku ?>">
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
                                        <input type="text" class="form-control" name="product_name"  required="yes" value="<?php echo $prod_name ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-info-circle"></i>
                                            </div>
                                        </div>
                                        <textarea type="text" class="form-control"  required="yes" name="product_desc"><?php echo $prod_desc ?></textarea>
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
                                        <input type="text" class="form-control currency"  required="yes" name="product_price" value="<?php echo $prod_price ?>">
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
                                        <select type="text" class="form-control"  required="yes" name="product_type">
                                            <option value="<?php echo $prod_type ?>"><?php echo $prod_type ?></option>
                                            <option value="">Change Product Type</option>
                                            <option value="DoFile">DoFiles</option>
                                            <option value="Dataset">Datasets</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Product Tags</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="product_tag"  required="yes" class="form-control inputtags" value="<?php echo $prod_tag ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Product Status</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-retweet"></i>
                                            </div>
                                        </div>
                                        <select type="text" class="form-control"  required="yes" name="product_status">
                                            <option value="<?php echo $prod_status ?>"><?php echo $prod_status == 1 ? 'Active' : 'Inactive' ?></option>
                                            <option value="">Change Product Status</option>
                                            <option value="1">Activate</option>
                                            <option value="0">De-activate</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <input type="submit" name="edit_product" class="btn btn-primary btn-lg" value="Update Product Details" />
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include "../include/footer.php";
    ?>