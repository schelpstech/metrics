<?php
    $tblName = 'publication_tbl';
    $conditions = array(
        'return_type' => 'single',
        'where' => array(
            'pub_key' => $_session['id'],
        )

    );
    $pub_details = $model->getRows($tblName, $conditions);

    if (!empty($pub_details)) {
        $pub_name =  $pub_details['pub_name'];
        $author =  $pub_details['author'];
        $pub_year =  $pub_details['pub_year'];
        $pub_status =  $pub_details['pub_status'];
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
                                <h4>CrunchEconometrix :: Edit Article Details </h4><br>
                                <?php

                                if (isset($_SESSION['msg'])) {
                                    printf('<b>%s</b>', $_SESSION['msg']);
                                    unset($_SESSION['msg']);
                                }
                                ?>
                            </div>
                            <form method="POST" action="../../app/pub_action.php" enctype="multipart/form-data">
                                <div class="card-body">


                                    <div class="form-group" style="display: none;">
                                        <label>Article ID</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-anchor"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="pub_id" hidden value="<?php echo $_session['id']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Article Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-fas fa-book"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="pub_name"  required="yes" value="<?php echo $pub_name ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Author(s)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-fas fa-user"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control currency"  required="yes" name="author" value="<?php echo $author ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Publication Year</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                <i class="fas fa-fas fa-calendar"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control currency"  required="yes"  name="pub_year" maxlength="4" minlength="4" value="<?php echo $pub_year ?>">
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
                                            <select type="text" class="form-control"  required="yes" name="pub_status">
                                                <option value="<?php echo $pub_status ?>"><?php echo $pub_status == 1 ? 'Active' : 'Inactive' ?></option>
                                                <option value="">Change Product Status</option>
                                                <option value="1">Activate</option>
                                                <option value="0">De-activate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <input type="submit" name="edit_article" class="btn btn-primary btn-lg" value="Update Article Details" />
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>