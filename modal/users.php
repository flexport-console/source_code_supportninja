<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="connection/add_user.php">
                <div class="modal-header">
                    <h5 class="modal-title">New User</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label class="text-dark">Employee ID</label>
                            <input type="text" id="numbers_only" name="employee_id" maxlength="7" class="form-control" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-dark">SN Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-dark">First Name</label>
                            <input type="text" name="first" class="form-control" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-dark">Last Name</label>
                            <input type="text" name="last" class="form-control" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-dark">Immediate Supervisor</label>
                            <select class="form-control form-control-lg default-select" name="team_manager" required>
                                <option selected disabled></option>
                                <?php
                                if (mysqli_num_rows($supervisor_select_res)>0) {
                                    while ($row = mysqli_fetch_assoc($supervisor_select_res)) { ?>
                                        <option value="<?php echo $row['user_employee_id']; ?>"> <?php echo $row['user_firstname']." ".$row['user_lastname']; ?> </option>
                                <?php
                                    }
                                }
                                 ?>
                            </select>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label class="text-dark">Position</label>
                            <select class="form-control form-control-lg default-select" name="position" required>
                                <option selected disabled></option>
                                <option>Data Entry I</option>
                                <option>Data Entry II</option>
                                <option>Data Entry III</option>
                                <option>Team Manager</option>
                                <option>Operations Manager</option>
                                <option>Director</option>
                            </select>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label class="text-dark">Line of Business</label>
                            <select class="form-control form-control-lg default-select" name="linebusiness" required>
                                <option selected disabled></option>
                                <?php
                                if (mysqli_num_rows($line_business)>0) {
                                     while ($row = mysqli_fetch_assoc($line_business)) {
                                ?>
                                    <option><?php echo $row['line_name']; ?></option>
                                <?php
                                     }
                                 } 
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm light" data-dismiss="modal">Close</button>
                    <button type="submit" name="add_user" class="btn btn-primary btn-sm">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>