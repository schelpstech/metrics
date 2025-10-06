<?php
include '../assets/php/header.php';
include '../assets/php/navbar.php';

// Capture filters
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'year_desc';

// Build query conditions
$tablename = 'publication_tbl';

$where = ["pub_status" => 1];
$extra = "";
$orderBy = "pub_name ASC";

// Search
if ($searchTerm !== '') {
    $extra .= " AND (pub_name LIKE '%{$searchTerm}%' OR author LIKE '%{$searchTerm}%' OR pub_year LIKE '%{$searchTerm}%')";
}

// Sorting
switch ($sortOption) {
    case 'year_asc':
        $conditions['order_by'] = 'pub_year ASC';
        break;
    case 'title_asc':
        $conditions['order_by'] = 'pub_name ASC';
        break;
    case 'title_desc':
        $conditions['order_by'] = 'pub_name DESC';
        break;
    default: // year_desc
        $conditions['order_by'] = 'pub_year DESC, rectime DESC';
        break;
}

$publication_view = $model->getRows(
    $tablename,
    [
        "where" => $where,
        "extra" => $extra,
        "order_by" => $orderBy
    ]
);
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
                        <li><i class="uil uil-laptop"></i> Coursera-Certified Online Tutor </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wrapper bg-light">
    <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-10 col-md-10 mx-auto">
                <div class="blog single mt-n17">
                    <div class="card shadow-lg">

                        <div class="col-xl-10 mx-auto">
                            <h1 class="fs-20 text-uppercase text-primary mb-3 text-center">
                                <br>Download Publications
                            </h1>
                        </div>

                        <!-- Search & Sort Form -->
                        <form method="get" class="row mb-4 px-4">
                            <div class="col-md-6 mb-2">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by publication name"
                                    value="<?php echo htmlspecialchars($searchTerm); ?>">
                            </div>
                            <div class="col-md-4 mb-2">
                                <select name="sort" class="form-control">
                                    <option value="year_desc" <?php if ($sortOption == 'year_desc') echo 'selected'; ?>>Year (Newest First)</option>
                                    <option value="year_asc" <?php if ($sortOption == 'year_asc') echo 'selected'; ?>>Year (Oldest First)</option>
                                    <option value="title_asc" <?php if ($sortOption == 'title_asc') echo 'selected'; ?>>Title (A–Z)</option>
                                    <option value="title_desc" <?php if ($sortOption == 'title_desc') echo 'selected'; ?>>Title (Z–A)</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <button type="submit" class="btn btn-primary w-100">Apply</button>
                            </div>
                        </form>

                        <!-- Publications List -->
                        <div class="row gy-6" style="align-items: center;">
                            <?php
                            $count = 1;
                            if (!empty($publication_view)) {
                                foreach ($publication_view as $view) {
                            ?>
                                    <div class="col-md-10 col-lg-10">
                                        <div class="card-body p-5 d-flex flex-row">
                                            <div>
                                                <span class="avatar bg-red text-white w-11 h-11 fs-20 me-4"><?php echo $count++ ?></span>
                                            </div>
                                            <div>
                                                <span class="badge bg-pale-blue text-blue rounded py-1 mb-2">
                                                    <h6 class="mb-0 text-body"><?php echo $view['author'] . " (" . $view['pub_year'] . ")" ?></h6>
                                                </span>
                                                <h6 class="mb-0 text-body"><?php echo $view['pub_name'] ?></h6>

                                                <a href="./download.php?pubid=<?php echo $view['pub_key'] ?>" class="btn btn-expand btn-primary rounded-pill">
                                                    <i class="uil uil-arrow-down"></i>
                                                    <span>Download</span>
                                                </a>

                                                <input type="text" hidden
                                                    value="https://cruncheconometrix.com/view/download.php?pubid=<?php echo $view['pub_key'] ?>"
                                                    id="linkput<?php echo $view['pub_key'] ?>">

                                                <a class="btn btn-primary btn-icon btn-icon-start rounded"
                                                    onclick="copylink('<?php echo $view['pub_key'] ?>')">
                                                    <i class="uil uil-copy"></i> Copy Link
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo '<div class="col-12 text-center"><em>No Publication Uploaded Yet</em></div>';
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function copylink(pubid) {
        var copyText = document.getElementById("linkput" + pubid);
        copyText.type = "text"; // temporarily make visible
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value).then(() => {
            alert("Link Copied: " + copyText.value);
        });
        copyText.type = "hidden";
    }
</script>

<?php
include '../assets/php/footer.php';
?>