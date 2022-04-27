<?php
include "../include/nav.php";
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 offset-lg-2">
                    <div class="card">
                        <div class="card-header">
                            <h4>CrunchEconometrix :: Add New Product to Shelf</h4><br>
                            <?php

                            if (isset($_SESSION['msg'])) {
                                printf('<b>%s</b>', $_SESSION['msg']);
                                unset($_SESSION['msg']);
                            }
                            ?>
                        </div>
                        <form method="POST" action="../../app/productaction.php" enctype="multipart/form-data">
                        <div class="card-body">
                           

                                <div class="form-group">
                                    <label>SKU ID</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-anchor"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" disabled value="<?php
                                                                                                require_once('../../app/utility.php');
                                                                                                $sku =  generateRandomText();
                                                                                                $_SESSION['sku'] = $sku;
                                                                                                echo $sku ?>">
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
                                        <input type="text" class="form-control"  required="yes" name="product_name">
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
                                        <textarea type="text" class="form-control"  required="yes" name="product_desc"></textarea>
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
                                        <input type="text" class="form-control currency"  required="yes" name="product_price">
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
                                        <select type="text" class="form-control" name="product_type"  required="yes">
                                            <option value="">Select Product Type</option>
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
                                        <input type="text" name="product_tag"  required="yes" class="form-control inputtags">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Select Product</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-file-medical"></i>
                                            </div>
                                        </div>
                                        <input type="file" class="form-control"  required="yes" name="product_file">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <input type="submit" name="add_product" class="btn btn-primary btn-lg" value="Submit" />
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