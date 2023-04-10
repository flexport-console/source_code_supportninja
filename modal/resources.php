<div class="modal fade" id="linebusiness">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="connection/resources_add.php">
                <div class="modal-header">
                    <h5 class="modal-title">Add Line of business</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    
                        <div>
                            <label><strong>Name</strong></label>
                            <input type="text" name="linebusiness" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark light btn-xxs" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_line" class="btn btn-primary btn-xxs">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="workflow_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="connection/resources_add.php">
                <div class="modal-header">
                    <h5 class="modal-title">Add Workflow</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div>
                            <label><strong>Name</strong></label>
                            <input type="text" name="workflow" class="form-control" required>
                        </div>
                        <div>
                            <label><strong>Line of Business</strong></label>
                            <select class="js-example-basic-single" name="linebusiness" required>
                                <option selected disabled></option>
                                <?php 
                                if (mysqli_num_rows($workflow_select)>0) {
                                    while ($row = mysqli_fetch_assoc($workflow_select)) { ?>

                                        <option><?php echo $row['line_name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark light btn-xxs" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_workflow" class="btn btn-primary btn-xxs">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="sop_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="connection/resources_add.php">
                <div class="modal-header">
                    <h5 class="modal-title">Add SOP</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div>
                            <label><strong>Name</strong></label>
                            <input type="text" name="sop" class="form-control" required>
                        </div>
                        <div>
                            <label><strong>Line of Business</strong></label>
                            <select class="js-example-basic-single" name="linebusiness" required>
                                <option selected disabled></option>
                                <?php 
                                if (mysqli_num_rows($sop_linebusiness_select)>0) {
                                    while($row = mysqli_fetch_assoc($sop_linebusiness_select)){ ?>
                                        <option><?php echo $row['line_name']; ?></option>

                                <?php
                                    }
                                }
                                 ?>
                            </select>
                        </div>
                        <div>
                            <label><strong>Workflow</strong></label>
                            <select class="js-example-basic-single" name="workflow" required>
                                <option selected disabled></option>
                                <?php 
                                if (mysqli_num_rows($sop_linebusiness_select_nested)>0) {
                                    while($row_select = mysqli_fetch_assoc($sop_linebusiness_select_nested)){ 
                                        $linebusiness_name = $row_select['line_name'];
                                        $sop_workflow_select = mysqli_query($conn, "SELECT * FROM r_workflow WHERE w_linebusiness='$linebusiness_name'");
                                        ?>
                                        <optgroup label="<?php echo $linebusiness_name; ?>">
                                            <?php 
                                            if (mysqli_num_rows($sop_workflow_select)>0) {
                                                while ($row_nested = mysqli_fetch_assoc($sop_workflow_select)) { ?>
                                                    <option><?php echo $row_nested['w_name']; ?></option>

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
                        
                    


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark light btn-xxs" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_sop" class="btn btn-primary btn-xxs">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="remarks_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="connection/resources_add.php">
                <div class="modal-header">
                    <h5 class="modal-title">Add Remarks</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div>
                            <label><strong>Name</strong></label>
                            <input type="text" name="remarks" class="form-control" required>
                        </div>
                        <div>
                            <label><strong>Workflow</strong></label>
                            <select class="js-example-basic-single" name="workflow" required>
                                <option selected disabled></option>
                                <?php 
                                if (mysqli_num_rows($remarks_linebusiness_select_nested)>0) {
                                    while($row_select = mysqli_fetch_assoc($remarks_linebusiness_select_nested)){ 
                                        $linebusiness_name = $row_select['line_name'];
                                        $r_workflow_select = mysqli_query($conn, "SELECT * FROM r_workflow WHERE w_linebusiness='$linebusiness_name'");
                                        ?>
                                        <optgroup label="<?php echo $linebusiness_name; ?>">
                                            <?php 
                                            if (mysqli_num_rows($r_workflow_select)>0) {
                                                while ($row_nested = mysqli_fetch_assoc($r_workflow_select)) { ?>
                                                    <option><?php echo $row_nested['w_name']; ?></option>

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
                        <div>
                            <label><strong>Status</strong></label>
                            <select class="js-example-basic-single" name="status" required>
                                <option selected disabled></option>
                                <?php 
                                if (mysqli_num_rows($remarks_status_select)>0) {
                                    while ($row = mysqli_fetch_assoc($remarks_status_select)) { ?>
                                        <option> <?php echo $row['st_name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>                     
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark light btn-xxs" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_remarks" class="btn btn-primary btn-xxs">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="status_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="connection/resources_add.php">
                <div class="modal-header">
                    <h5 class="modal-title">Add Status</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    
                        <div>
                            <label><strong>Name</strong></label>
                            <input type="text" name="status" class="form-control" required>
                            
                        </div>
                        <div>
                            <label><strong>Workflow</strong></label>
                            <select class="js-example-basic-single" name="workflow" required>
                                <option selected disabled></option>
                                <?php 
                                if (mysqli_num_rows($remarks_status_workflow_select)>0) {
                                    while($row_select = mysqli_fetch_assoc($remarks_status_workflow_select)){ 
                                        $linebusiness_name = $row_select['line_name'];
                                        $r_workflow_select = mysqli_query($conn, "SELECT * FROM r_workflow WHERE w_linebusiness='$linebusiness_name'");
                                        ?>
                                        <optgroup label="<?php echo $linebusiness_name; ?>">
                                            <?php 
                                            if (mysqli_num_rows($r_workflow_select)>0) {
                                                while ($row_nested = mysqli_fetch_assoc($r_workflow_select)) { ?>
                                                    <option><?php echo $row_nested['w_name']; ?></option>

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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark light btn-xxs" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_status" class="btn btn-primary btn-xxs">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>