<?php
include "../include/nav.php";
?>
<div class="main-content">
    <section class="section">
        <div class="section-body">

            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body card-type-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-info mb-0">Total Transactions</h6>
                                    <span class="font-weight-bold mb-0"><?php echo $count_order ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="card-circle l-bg-cyan text-white">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> <?php echo $sum_order ?></span>
                                <span class="text-nowrap">worth</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body card-type-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-success mb-0">Successful Transactions</h6>
                                    <span class="font-weight-bold mb-0"><?php echo $count_success_order ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="card-circle l-bg-green text-white">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i><?php echo $sum_success_order['total_revenue'] ?></span>
                                <span class="text-nowrap">worth</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body card-type-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-danger mb-0">Failed Transaction</h6>
                                    <span class="font-weight-bold mb-0"><?php echo $count_failed_order ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="card-circle l-bg-orange text-white">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> <?php echo $sum_failed_order['total_revenue'] ?></span>
                                <span class="text-nowrap">worth</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card">
                        <div class="card-body card-type-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-muted mb-0">Fulfilled Orders</h6>
                                    <span class="font-weight-bold mb-0"><?php echo !empty($count_fulfilled_order) ?? $count_fulfilled_order, 0; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="card-circle l-bg-purple text-white">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> </span>
                                <span class="text-nowrap">Since last month</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>CrunchEconometrix :: Transaction Log</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Date</th>
                                            <th>Ref Num</th>
                                            <th>User</th>
                                            <th>Email Address</th>
                                            <th>Number of Items</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $tablename = 'trans_tbl';
                                        $transview = $model->getRows($tablename);
                                        foreach($transview as $view){
                                            $tablename = 'crunch_user';
                                            $conditions = array(
                                                'return_type' => 'single',
                                                'where' => array(
                                                  'useremail' => $view['trans_user'],
                                                ),
                                              );
                                              $userdetails = $model->getRows($tablename, $conditions);   
                                        ?>
                                        
                                        <tr>
                                            <td> <?php echo $count++ ?></td>
                                            <td> <?php echo ucwords($view['trans_time']); ?></td>
                                            <td> <?php echo ucwords($view['trans_ref']); ?></td>
                                            <td> <?php echo ucwords($userdetails['user_firstname']." ".$userdetails['user_surname']); ?></td>
                                            <td> <?php echo ucwords($view['trans_user']); ?></td>
                                            <td> <?php echo strtolower($view['trans_qty']); ?></td>
                                            <td> <?php echo strtolower($view['trans_amount']); ?></td>
                                            <td> <?php
                                                            if ($view['trans_status'] == 1) {
                                                                echo '<a href="#" class="btn btn-icon icon-left btn-success">Success</a>';
                                                            } else {
                                                                echo '<a href="#" class="btn btn-icon icon-left btn-danger">Incomplete</a>';
                                                            }
                                                            ?>
                                            </td>
                                            <td> <a href="./translog.php?trans_ref=<?php echo $view['trans_ref']; ?>" class="btn btn-info">View</a></td>
                                                    
                                            
                                        </tr>
                                       <?php 
                                        }
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
</div>
<?php
include "../include/footer.php";
?>