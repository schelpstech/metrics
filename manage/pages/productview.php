<?php
include "../include/nav.php";
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>CrunchEconometrix :: Product Shelf</h4>
                            <?php

                            if (isset($_SESSION['msg'])) {
                                printf('<b>%s</b>', $_SESSION['msg']);
                                unset($_SESSION['msg']);
                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>SKU</th>
                                            <th>Product name</th>
                                            <th>Product Type</th>
                                            <th>Price</th>
                                            <th>Product Link</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $tablename = 'prod_sku';
                                        $productview = $model->select_all($tablename);
                                        if (!empty($productview)) {
                                            foreach ($productview as $view) {


                                        ?>

                                                <tr>
                                                    <td> <?php echo $count++ ?></td>
                                                    <td> <?php echo $view['prod_sku']; ?></td>
                                                    <td> <?php echo $view['prod_name']; ?></td>
                                                    <td> <?php echo $view['prod_type']; ?></td>
                                                    <td> <?php echo $view['prod_price']; ?></td>
                                                    <td> <a href="<?php echo $view['prod_path']; ?>" class="btn btn-icon icon-left btn-info"><i class="far fa-file"></i>Download</a></td>
                                                    <td> <?php
                                                            if ($view['prod_status'] == 1) {
                                                                echo '<a href="#" class="btn btn-icon icon-left btn-success"><i class="far fa-check"></i>On Sale</a>';
                                                            } else {
                                                                echo '<a href="#" class="btn btn-icon icon-left btn-danger"><i class="far fa-exclamation-triangle"></i>Off Shelf</a>';
                                                            }
                                                            ?></td>
                                                    <td> <a href="./productedit.php?sku=<?php echo $view['prod_sku']; ?>" class="btn btn-primary">Manage Product</a></td>


                                                </tr>
                                        <?php
                                            }
                                        } else 'No Product Added'
                                        ?>

                                    </tbody>
                                </table>
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