<?php
include '../assets/php/header.php';
include '../assets/php/navbar.php';
?>
<section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-19 pt-md-14 pb-md-20 text-center">
        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <div class="post-header">
                    <h1 class="display-1 mb-5">Bosede Ngozi ADELEYE PhD.</h1>
                    <ul class="post-meta fs-17 mb-5">
                        <li><i class="uil uil-building"></i> Economics Lecturer </li>
                        <li><i class="uil uil-video"></i> Econometrics Content Creator </li>
                        <li><i class="uil uil-laptop"></i>Coursera-Certified Online Tutor </li>
                    </ul>
                    <!-- /.post-meta -->
                </div>
                <!-- /.post-header -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light">
    <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-10 col-md-10 mx-auto">
                <div class="blog single mt-n17">
                    <div class="card shadow-lg">


                        <div class="col-xl-10 mx-auto">
                            <h1 class="fs-20 text-uppercase text-primary mb-3" style="text-align: center;"> <br>Download Publications</h1>
                        </div>
                        <!-- /.row -->
                        <div class="row gy-6" style="align-items: center;">
                            <?php
                            $count = 1;
                            $tablename = 'publication_tbl';
                            $conditions = array(
                                'order_by' => 'pub_year DESC, rectime DESC',
                            );
                            $publication_view = $model->getRows($tablename, $conditions);

                            if (!empty($publication_view)) {
                                foreach ($publication_view as $view) {
                            ?>

                                    <div class="col-md-10 col-lg-10">
                                        <div class="card-body p-5 d-flex flex-row" class="col-md-10 col-lg-10">
                                            <div>
                                                <span class="avatar bg-red text-white w-11 h-11 fs-20 me-4"><?php echo $count++ ?></span>
                                            </div>
                                            <div>

                                                <span class="badge bg-pale-blue text-blue rounded py-1 mb-2">
                                                    <h6 class="mb-0 text-body"><?php echo  $view['author'] . " (" . $view['pub_year'] . ")" ?></h6>
                                                </span>
                                                <h6 class="mb-0 text-body"><?php echo  $view['pub_name'] ?></h6>

                                                <a href="./download.php?pubid=<?php echo  $view['pub_key']?>" class="btn btn-expand btn-primary rounded-pill" style="align-items: right;">
                                                    <i class="uil uil-arrow-down"></i>
                                                    <span>Download</span>
                                                </a>
                                                <a class="btn btn-primary btn-icon btn-icon-start rounded" onclick="copylink<?php echo  $view['pub_key']?>()">
                                                    <i class="uil uil-copy"></i> Copy Link
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function copylink<?php echo  $view['pub_key']?>() {
                                        var copyText = "https://cruncheconometrics.com.ng/view/download.php?pubid=<?php echo  $view['pub_key']?>";
                                        navigator.clipboard.writeText(copyText);
                                        alert("Link Copied : " + copyText);
                                        }
                                    </script>
                            <?php
                                }
                            } else {
                                echo 'No Publication Uploaded Yet';
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include '../assets/php/footer.php';
?>