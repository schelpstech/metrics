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
                            <h4>CrunchEconometrix :: Add New Publication / Article</h4><br>
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
                                    <label>Publication ID</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-anchor"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="c"  value="<?php
                                                                                                require_once('../../app/utility.php');
                                                                                                $pub_id =  generateRandomText();
                                                                                                $_SESSION['pub_id'] = $pub_id;
                                                                                                echo $pub_id ?>">
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
                                        <input type="text" class="form-control" name="pub_name" required="yes">
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
                                        <input type="text" class="form-control" name="author" required="yes">
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
                                        <input type="text" class="form-control currency" required="yes" name="pub_year" maxlength="4" minlength="4">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Select Publication File</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-file-medical"></i>
                                            </div>
                                        </div>
                                        <input type="file" class="form-control" name="pub_file" required="yes" accept=".pdf">
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <input type="submit" name="add_publication" class="btn btn-primary btn-lg" value="Publish" />
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