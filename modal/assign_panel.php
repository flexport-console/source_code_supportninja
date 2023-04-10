<div class="modal fade bd-example-modal-lg-assign_panel" id="linebusiness_panel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="connection/add_user.php">
                <div class="modal-header">
                    <h5 class="modal-title">Add Line of Business</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label class="text-dark">Line of Business</label>
                            <input hidden type="text" name="employee_id" value="<?php echo $user_employeeid_look; ?>">
                            <select class="js-example-basic-single" name="line_business">
                                <option selected disabled></option>
                                <?php 
                                if (mysqli_num_rows($select_lob_modal)>0) {
                                    while ($row = mysqli_fetch_assoc($select_lob_modal)) {
                                ?>
                                    <option><?php echo $row['line_name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Line of Business</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($user_list_lob_res)>0) {
                                        $numCol = 1;
                                        while ($row = mysqli_fetch_assoc($user_list_lob_res)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $numCol; ?></td>
                                            <td><?php echo $row['ul_linebusiness']; ?></td>
                                            <td>
                                                <a href="connection/delete_assign.php?delete=linebusiness&q=<?php echo $row['ul_linebusiness']; ?>&employee_id=<?php echo $user_employeeid_look; ?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                    <?php
                                        $numCol+=1;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm light" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_lob" class="btn btn-primary btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg-assign_panel" id="workflow_panel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="connection/add_user.php">
                <div class="modal-header">
                    <h5 class="modal-title">Add Workflow</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label class="text-dark">Workflow</label>
                            <input hidden type="text" name="employee_id" value="<?php echo $user_employeeid_look; ?>">
                            <select class="js-example-basic-single" name="workflow">
                                <option selected disabled></option>
                                <?php 
                                if (mysqli_num_rows($select_wf_modal)>0) {
                                    while ($row = mysqli_fetch_assoc($select_wf_modal)) {
                                        $optgroup = $row['line_name'];
                                        $wf = mysqli_query($conn, "SELECT * FROM r_workflow WHERE w_linebusiness='$optgroup'");
                                ?>
                                    <optgroup label="<?php echo $optgroup; ?>">
                                        <?php 
                                        if (mysqli_num_rows($wf)>0) {
                                            while ($row = mysqli_fetch_assoc($wf)) { 
                                        ?>
                                            <option><?php echo $row['w_name']; ?></option>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </optgroup>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Workflow</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($user_list_wf_res_main)>0) {
                                        $numCol = 1;
                                        while ($row = mysqli_fetch_assoc($user_list_wf_res_main)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $numCol; ?></td>
                                            <td><?php echo $row['wl_name']; ?></td>
                                            <td>
                                                <a href="connection/delete_assign.php?delete=workflow&q=<?php echo $row['wl_name']; ?>&employee_id=<?php echo $user_employeeid_look; ?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                    <?php
                                        $numCol+=1;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm light" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_workflow" class="btn btn-primary btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg-assign_panel" id="sop_panel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="connection/add_user.php">
                <div class="modal-header">
                    <h5 class="modal-title">Add SOP</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label class="text-dark">SOP</label>
                            <input hidden type="text" name="employee_id" value="<?php echo $user_employeeid_look; ?>">
                            <select class="js-example-basic-single" name="sop">
                                <option selected disabled></option>
                                <?php 
                                if (mysqli_num_rows($select_sop_modal)>0) {
                                    while ($row = mysqli_fetch_assoc($select_sop_modal)) {
                                        $optgroup = $row['line_name'];
                                        $sop = mysqli_query($conn, "SELECT * FROM r_sop WHERE s_linebusiness='$optgroup' ORDER BY s_workflow ASC");
                                ?>
                                    <optgroup label="<?php echo $optgroup; ?>">
                                        <?php 
                                        if (mysqli_num_rows($sop)>0) {
                                            while ($row = mysqli_fetch_assoc($sop)) { 
                                        ?>
                                            <option value="<?php echo $row['s_name']; ?>"><?php echo $row['s_workflow']." - ".$row['s_name']; ?></option>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </optgroup>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>SOP</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($user_list_sop_res_main)>0) {
                                        $numCol = 1;
                                        while ($row = mysqli_fetch_assoc($user_list_sop_res_main)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $numCol; ?></td>
                                            <td><?php echo $row['sop_name']; ?></td>
                                            <td>
                                                <a href="connection/delete_assign.php?delete=sop&q=<?php echo $row['sop_name']; ?>&employee_id=<?php echo $user_employeeid_look; ?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                    <?php
                                        $numCol+=1;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm light" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_sop" class="btn btn-primary btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>