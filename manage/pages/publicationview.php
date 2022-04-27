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
                            <h4>CrunchEconometrix :: Article List</h4>
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
                                            <th>Article ID</th>
                                            <th>Article name</th>
                                            <th>Author(s)</th>
                                            <th>Year</th>
                                            <th>Article Link</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $tablename = 'publication_tbl';
                                        $articleview = $model->select_all($tablename);
                                        if (!empty($articleview)) {
                                            foreach ($articleview as $view) {


                                        ?>

                                                <tr>
                                                    <td> <?php echo $count++ ?></td>
                                                    <td> <?php echo $view['pub_key']; ?></td>
                                                    <td> <?php echo $view['pub_name']; ?></td>
                                                    <td> <?php echo $view['author']; ?></td>
                                                    <td> <?php echo $view['pub_year']; ?></td>
                                                    <td> <a href="<?php echo $view['pub_file']; ?>" class="btn btn-icon icon-left btn-dark"><i class="far fa-file"></i>View</a></td>
                                                    <td> <?php
                                                            if ($view['pub_status'] == 1) {
                                                                echo '<a href="#" class="btn btn-icon icon-left btn-success">Active</a>';
                                                            } else {
                                                                echo '<a href="#" class="btn btn-icon icon-left btn-danger">De-activated</a>';
                                                            }
                                                            ?></td>
                                                    <td> <a href="./publicationedit.php?id=<?php echo $view['pub_key']; ?>" class="btn btn-info">Manage Article</a></td>


                                                </tr>
                                        <?php
                                            }
                                        } else 'No Article Published Yet'
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