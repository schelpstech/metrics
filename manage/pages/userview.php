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
                            <h4>CrunchEconometrix :: User List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>First name</th>
                                            <th>Last Name</th>
                                            <th>Email Address</th>
                                            <th>Last Access Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $tablename = 'crunch_user';
                                        $userview = $model->select_all($tablename);
                                        foreach($userview as $view){
                                            $whrtablename = 'user_log';
                                            $columna = 'userid';
                                            $columnb = 'login_status';
                                            $conditiona = $view['useremail'];
                                            $conditionb = 1;
                                            $nextview = $model->select_where($whrtablename, $columna, $conditiona,  $columnb, $conditionb);
 
                                           
                                        ?>
                                        
                                        <tr>
                                            <td> <?php echo $count++ ?></td>
                                            <td> <?php echo $view['user_firstname']; ?></td>
                                            <td> <?php echo $view['user_surname']; ?></td>
                                            <td> <?php echo $view['useremail']; ?></td>
                                            <td> <?php 
                                            if (!empty($nextview['login_date'])){
                                                echo $nextview['login_date'];
                                            }else{
                                                echo 'not logged in yet';
                                            }
                                             ?></td>
                                            
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
    <?php
    include "../include/footer.php";
    ?>