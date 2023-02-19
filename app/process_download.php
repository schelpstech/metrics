<?php
  $tblName = 'publication_tbl';
  $conditions = array(
      'return_type' => 'single',
      'where' => array(
          'pub_key' => $pubid,
      )
  );
  $fetch_article = $model->getRows($tblName, $conditions);

  if (!empty($fetch_article) && ($fetch_article['pub_status'] == 1)) {
      $pub_name =  $fetch_article['pub_name'];
      $author =  $fetch_article['author'];
      $pub_year =  $fetch_article['pub_year'];
      $pub_file =  $fetch_article['pub_file'];

      $tbl = 'downloads_monitor';
      $data = array(
            'pub_key' => $pubid,
            'userid' => $_SESSION['token'],
        );
        $insert = $model->insert_data($tbl, $data);
echo'<!-- /section -->
<section class="wrapper image-wrapper bg-auto no-overlay bg-image text-center py-14 py-md-16 bg-map" data-image-src="../assets/img/web/map.png">
  <div class="container py-0 py-md-18">
    <div class="row">
      <div class="col-lg-6 col-xl-8 mx-auto">
        <p class="display-4 mb-3 text-center">Here is your file</p>
        <p class="lead mb-5 px-md-16 px-lg-3"><strong>'.$author.' ('.$pub_year.')</strong></p>
        <p class="lead mb-5 px-md-16 px-lg-3">'.$pub_name.'</p>
        <button onclick="downloadURI()" class="btn btn-primary rounded-pill">Download</button>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
<script>
function downloadURI() 
{
    var link = document.createElement("a");
    var file_ref = "'.$pub_file.'";
    var extension = file_ref.substring(file_ref.lastIndexOf('.') + 1);
    var name = "'.str_replace( array( '\'', '"',',' , ';', '<', '>' ), ' ', $pub_name).'"+extension;
    link.setAttribute("download", name);
    link.href = file_ref;
    document.body.appendChild(link);
    link.click();
    link.remove();
}
</script>
';
  }elseif(empty($fetch_article)){
    echo '<section class="wrapper bg-light">
    <div class="container pb-13 pb-md-15">
      <div class="card image-wrapper bg-full bg-image bg-overlay bg-overlay-300 mb-14" data-image-src="../assets/img/web/bg16.png">
        <div class="card-body p-10 p-xl-12">
          <div class="row text-center">
            <div class="col-xl-11 col-xxl-9 mx-auto">
              <h2 class="fs-16 text-uppercase text-white mb-3">Ooooppps!!</h2>
              <h3 class="display-3 mb-8 px-lg-8 text-white">We cannot find the file you are requesting.</h3>
            </div>
            <!-- /column -->
          </div>
          <!-- /.row -->
          <div class="d-flex justify-content-center">
            <span><a href="./publication.php" class="btn btn-white rounded">Go to Publications</a></span>
          </div>
        </div>
        <!--/.card-body -->
      </div>
      <!--/.card -->
    </div>
    <!-- /.container -->
  </section>
  <!-- /section -->';

  }