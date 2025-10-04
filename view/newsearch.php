<?php
include '../assets/php/header.php';
include '../assets/php/navbar.php';
require_once('../app/utility.php');

// -------------------
// Cart token setup
// -------------------
if (isset($_SESSION['cart_token'])) {
    $cart_token = $_SESSION['cart_token'];
} else {
    $cart_token = generateRandomText();
    $_SESSION['cart_token'] = $cart_token;
}

if (isset($_SESSION['uniqueid'])) {
    $cart_user = $_SESSION['uniqueid'];
} elseif (isset($_SESSION['cart_user'])) {
    $cart_user = $_SESSION['cart_user'];
} else {
    $cart_user = 'guest_' . $cart_token;
    $_SESSION['cart_user'] = $cart_user;
}

// -------------------
// Pagination + Sort
// -------------------
$limit  = 20;
$page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page   = max($page, 1);
$offset = ($page - 1) * $limit;

$sort   = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// WHERE condition (only active products)
$where = array("prod_status" => 1);
$extra = "";

// Sorting
switch ($sort) {
    case 'name_asc':
        $orderBy = "prod_name ASC";
        break;
    case 'name_desc':
        $orderBy = "prod_name DESC";
        break;
    case 'price_low_high':
        $orderBy = "prod_price ASC";
        break;
    case 'price_high_low':
        $orderBy = "prod_price DESC";
        break;
    case 'dataset':
        $orderBy = "prod_type ASC";
        break;
    case 'dofile':
        $orderBy = "prod_type DESC";
        break;
    default:
        $orderBy = "prod_name ASC";
}

// Count total
$totalItems = $model->countRows("prod_sku", array(
    "where" => $where,
    "extra" => $extra
));
$totalPages = $totalItems ? ceil($totalItems / $limit) : 1;

// Fetch products
$productview = $model->getRows("prod_sku", array(
    "where"    => $where,
    "extra"    => $extra,
    "order_by" => $orderBy,
    "limit"    => $limit,
    "start"    => $offset
));
?>

<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <!-- Header -->
        <div class="row align-items-center mb-10 position-relative zindex-1">
            <div class="col-md-8 col-lg-9 col-xl-8 col-xxl-7 pe-xl-20">
                <h2 class="display-6">CrunchEconometrix Mart</h2>
                <nav class="d-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop :: Access all free and premium datasets and dofiles</li>
                    </ol>
                </nav>
            </div>
            <!-- Cart button -->
            <div class="col-md-4 col-lg-3 ms-md-auto text-md-end mt-5 mt-md-0">
                <div id="cart_button">
                    <button class="btn btn-outline-gradient gradient-1 rounded-pill me-1 mb-2 mb-md-0"
                        onclick="window.location.replace('./mycart.php');">
                        <i class="uil uil-shopping-cart"></i>
                        <span id="cart_count"><?php echo isset($_SESSION['cart_check']) ? (int)$_SESSION['cart_check'] : 0; ?></span> item(s) in cart
                    </button>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($_SESSION['msg']);
                                            unset($_SESSION['msg']); ?></div>
        <?php endif; ?>



        <!-- Search + Sort on the same line -->
       <div class="row align-items-center mb-4" style="position: relative; z-index: 9999;">

    <!-- Search Form -->
    <div class="col-md-6 mb-3 mb-md-0">
        <form method="get" action="prodsearch.php" class="w-100">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="uil uil-search"></i>
                </span>
                <input type="text"
                       name="search"
                       class="form-control border-start-0"
                       placeholder="Search products..."
                       autocomplete="off">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>

    <!-- Sort Form -->
    <div class="col-md-6 text-md-end">
        <form method="get" action="datashop.php" id="sortForm" class="d-inline-block">
            <div class="input-group shadow-sm">
                <select name="sort" class="form-select"
                        onchange="document.getElementById('pageInput').value=1; this.form.submit();">
                    <option value="default" <?php if ($sort == 'default') echo 'selected'; ?>>Sort by</option>
                    <option value="name_asc" <?php if ($sort == 'name_asc') echo 'selected'; ?>>Name (A–Z)</option>
                    <option value="name_desc" <?php if ($sort == 'name_desc') echo 'selected'; ?>>Name (Z–A)</option>
                    <option value="price_low_high" <?php if ($sort == 'price_low_high') echo 'selected'; ?>>Price (Low → High)</option>
                    <option value="price_high_low" <?php if ($sort == 'price_high_low') echo 'selected'; ?>>Price (High → Low)</option>
                    <option value="dofile" <?php if ($sort == 'dofile') echo 'selected'; ?>>DoFiles</option>
                    <option value="dataset" <?php if ($sort == 'dataset') echo 'selected'; ?>>Datasets</option>
                </select>
                <input type="hidden" name="page" id="pageInput" value="<?php echo $page; ?>">
            </div>
        </form>
    </div>

</div>



        <!-- Products -->
        <div class="grid grid-view projects-masonry shop mb-13">
            <div class="row gx-md-8 gy-10 gy-md-13 isotope" id="productGrid">
                <?php if ($productview): ?>
                    <?php foreach ($productview as $view): ?>
                        <?php
                        // create safe id fragment from sku for use in HTML ids
                        $sku_raw   = (string)$view['prod_sku'];
                        $safeSkuId = preg_replace('/[^a-zA-Z0-9\-_]/', '_', $sku_raw);
                        $htmlSku   = htmlspecialchars($sku_raw, ENT_QUOTES);
                        $htmlImg   = htmlspecialchars($view['prod_img'] ?? '', ENT_QUOTES);
                        $htmlPath  = htmlspecialchars($view['prod_path'] ?? '', ENT_QUOTES);
                        $htmlName  = htmlspecialchars($view['prod_name'] ?? '', ENT_QUOTES);
                        $htmlType  = htmlspecialchars($view['prod_type'] ?? '', ENT_QUOTES);
                        $htmlDesc  = htmlspecialchars($view['prod_desc'] ?? '', ENT_QUOTES);
                        ?>
                        <div class="project item col-md-6 col-xl-4 product-card">
                            <figure class="rounded mb-6 text-center">
                                <img style="width: 50%; height: 50%;" src="<?php echo $htmlImg; ?>" alt="<?php echo $htmlName; ?>" />
                                <?php if ($view['prod_price'] != 0): ?>
                                    <?php
                                    $tblName = 'cart_log';
                                    $conditions = array(
                                        'return_type' => 'single',
                                        'where' => array(
                                            'prod_sku' => $view['prod_sku'],
                                            'user_id' => $cart_user,
                                            'token' => $cart_token,
                                        )
                                    );
                                    $checkcart = $model->getRows($tblName, $conditions);
                                    $inCart = (!empty($checkcart) && $checkcart['item_status'] == 1);
                                    ?>
                                    <button
                                        id="add_<?php echo $safeSkuId; ?>"
                                        class="item-cart btn-add"
                                        data-sku="<?php echo $htmlSku; ?>"
                                        data-id="<?php echo $safeSkuId; ?>"
                                        <?php if ($inCart) echo 'style="display:none;"'; ?>>
                                        <i class="uil uil-shopping-bag"></i> Add to Cart
                                    </button>

                                    <button
                                        id="remove_<?php echo $safeSkuId; ?>"
                                        class="item-cart btn-remove"
                                        data-sku="<?php echo $htmlSku; ?>"
                                        data-id="<?php echo $safeSkuId; ?>"
                                        <?php if (!$inCart) echo 'style="display:none;"'; ?>>
                                        <i class="uil uil-shopping-bag"></i> Remove from Cart
                                    </button>

                                <?php else: ?>
                                    <button
                                        class="item-cart btn-download"
                                        data-sku="<?php echo $htmlSku; ?>"
                                        data-path="<?php echo $htmlPath; ?>"
                                        data-name="<?php echo $htmlName; ?>">
                                        <i class="uil uil-download"></i> Download
                                    </button>
                                <?php endif; ?>
                            </figure>
                            <div class="post-header text-center">
                                <h2 class="post-title h5"><?php echo $htmlName; ?></h2>
                                <p class="price mb-1">₦<?php echo number_format($view['prod_price']); ?>.00</p>
                                <span class="text-muted small"><?php echo $htmlType; ?></span>
                                <p class="mt-2"><?php echo $htmlDesc; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <nav class="d-flex justify-content-center" aria-label="pagination">
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1 ?>&sort=<?php echo urlencode($sort); ?>"><i class="uil uil-arrow-left"></i></a></li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i ?>&sort=<?php echo urlencode($sort); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1 ?>&sort=<?php echo urlencode($sort); ?>"><i class="uil uil-arrow-right"></i></a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>

<!-- Features -->
<!-- /section -->
<section class="wrapper bg-gray">
    <div class="container py-12 py-md-14">
        <div class="row gx-lg-8 gx-xl-12 gy-8">

            <!--/column -->
            <div class="col-md-6 col-lg-4">
                <div class="d-flex flex-row">
                    <div>
                        <img src="../assets/img/icons/solid/verify.svg" class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
                    </div>
                    <div>
                        <h4 class="mb-1">Consistent Datasets</h4>
                        <p class="mb-0">Our datasets are uptodate and have been cleaned to suit your analysis</p>
                    </div>
                </div>
            </div>
            <!--/column -->
            <div class="col-md-6 col-lg-4">
                <div class="d-flex flex-row">
                    <div>
                        <img src="../assets/img/icons/lineal/tools.svg" class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
                    </div>
                    <div>
                        <h4 class="mb-1">Deployable Dofiles</h4>
                        <p class="mb-0">All dofiles are worthwhile templates for your analysis.</p>
                    </div>
                </div>
            </div>
            <!--/column -->
            <div class="col-md-6 col-lg-4">
                <div class="d-flex flex-row">
                    <div>
                        <img src="../assets/img/icons/lineal/download.svg" class="svg-inject icon-svg icon-svg-sm solid-mono text-navy me-4" alt="" />
                    </div>
                    <div>
                        <h4 class="mb-1">One Time Download</h4>
                        <p class="mb-0">All datasets and dofiles purchased have one time download access.</p>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<?php include '../assets/php/footer.php'; ?>

<script>
    // expose server-side tokens to JS safely
    const CART_TOKEN = <?php echo json_encode($cart_token); ?>;
    const CART_USER = <?php echo json_encode($cart_user); ?>;

    // delegated click handlers - works for every product button
    $(document).ready(function() {
        // Add to cart
        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const sku = $btn.data('sku');
            const id = $btn.data('id');

            $.post('../app/managecart.php', {
                product_sku: sku,
                token: CART_TOKEN,
                uniqueid: CART_USER,
                action: 'add_to_cart'
            }).done(function(data) {
                // try parse as integer number-of-items
                const count = parseInt(String(data).replace(/\D/g, ''), 10);
                if (!isNaN(count)) {
                    $('#cart_button').html('<a href="./mycart.php" class="btn btn-outline-gradient gradient-1 rounded-pill me-1 mb-2 mb-md-0"><i class="uil uil-shopping-cart"></i><span>' + count + ' item(s) in cart</span></a>');
                    $('#add_' + id).hide();
                    $('#remove_' + id).show();
                } else {
                    alert(data);
                }
            }).fail(function() {
                alert('Could not add to cart. Please try again.');
            });
        });

        // Remove from cart
        $(document).on('click', '.btn-remove', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const sku = $btn.data('sku');
            const id = $btn.data('id');

            $.post('../app/managecart.php', {
                product_sku: sku,
                token: CART_TOKEN,
                uniqueid: CART_USER,
                action: 'delete_from_cart'
            }).done(function(data) {
                const count = parseInt(String(data).replace(/\D/g, ''), 10);
                if (!isNaN(count)) {
                    $('#cart_button').html('<a href="./mycart.php" class="btn btn-outline-gradient gradient-1 rounded-pill me-1 mb-2 mb-md-0"><i class="uil uil-shopping-cart"></i><span>' + count + ' item(s) in cart</span></a>');
                    $('#add_' + id).show();
                    $('#remove_' + id).hide();
                } else {
                    alert(data);
                }
            }).fail(function() {
                alert('Could not remove from cart. Please try again.');
            });
        });

        // Download
        $(document).on('click', '.btn-download', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const path = $btn.data('path') || '';
            const name = $btn.data('name') || $btn.data('sku') || 'download';
            if (!path) {
                alert('Download file not available.');
                return;
            }
            const link = document.createElement('a');
            link.href = path;
            link.download = name;
            document.body.appendChild(link);
            link.click();
            link.remove();
        });
    });
</script>