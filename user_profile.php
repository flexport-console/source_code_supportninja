<?php 
include 'connection/user_information.php';
if (!in_array("Users",$_roles)) {
   header("location: 403.php");
}


if (isset($_GET['user']) && !empty($_GET['user']) && isset($_GET['view'])) {
    $user_employeeid_look = mysqli_real_escape_string($conn, $_GET['user']);
    $view = mysqli_real_escape_string($conn, $_GET['view']);

    $view_selected_user = "SELECT e.user_id as v_user_id, e.user_firstname as v_firstname, e.user_lastname as v_lastname,e.user_email as v_email, e.user_position as v_position, e.user_status as v_status, concat(m.user_firstname,' ',m.user_lastname) as v_team_manager, m.user_position as v_team_manager_pos, m.user_employee_id as v_team_manager_id FROM users e JOIN users m on e.user_supervisor_id=m.user_employee_id WHERE e.user_employee_id=$user_employeeid_look";
    
    $view_selected_user_res = mysqli_query($conn,$view_selected_user);
    if (mysqli_num_rows($view_selected_user_res)>0) {
        $view_row = mysqli_fetch_assoc($view_selected_user_res);

        $view_user_line = mysqli_query($conn, "SELECT * FROM users_linebusiness WHERE user_employee_id='$user_employeeid_look'");
        $view_user_workflow = mysqli_query($conn, "SELECT * FROM users_workflow WHERE user_employee_id='$user_employeeid_look'");
        if (empty($view_row['v_firstname'])) {
            header("location: users.php");
        }
    }


    // FOR SELECTION
    $select_lead_id = "SELECT * FROM users WHERE user_position NOT IN ('Data Entry I','Data Entry II','Data Entry III')";
    $select_lead_id_res = mysqli_query($conn, $select_lead_id);

    // Modal LOB
    $select_lob_modal = mysqli_query($conn, "SELECT * FROM r_linebusiness");

    $select_wf_modal = mysqli_query($conn, "SELECT * FROM r_linebusiness");

    $select_sop_modal = mysqli_query($conn, "SELECT * FROM r_linebusiness");

    // user lob
    $user_list_lob = "SELECT * FROM users_linebusiness WHERE user_employee_id='$user_employeeid_look'";
    $user_list_lob_res = mysqli_query($conn, $user_list_lob);
    $user_list_lob_res_main = mysqli_query($conn, $user_list_lob);


    // user workflow
    $user_list_wf = "SELECT * FROM users_workflow WHERE user_employee_id='$user_employeeid_look'";
    $user_list_wf_res = mysqli_query($conn, $user_list_wf);
    $user_list_wf_res_main = mysqli_query($conn, $user_list_wf);

    //SOP
    $user_list_sop = "SELECT * FROM users_sop WHERE user_employee_id='$user_employeeid_look'";
    $user_list_sop_res = mysqli_query($conn, $user_list_sop);
    $user_list_sop_res_main = mysqli_query($conn, $user_list_sop);


    //SOP
    $user_list_role = "SELECT * FROM user_role WHERE user_employee_id='$user_employeeid_look'";
    $user_list_role_res = mysqli_query($conn, $user_list_role);

    //SOP
    $user_list_tracker = "SELECT * FROM user_tracker WHERE user_employee_id='$user_employeeid_look'";
    $user_list_tracker_res = mysqli_query($conn, $user_list_tracker);


}else{
    header("location: users.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'pages/header.php'; ?>
<link href="./vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
	table.fixed { table-layout:fixed!important; }
	table.fixed td { overflow: hidden!important; }
</style>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.php" class="brand-logo">
                <img class="logo-abbr" src="./images/new_branding.png" alt="">
                <img class="logo-compact" src="./images/long_logo.png" alt="">
                <img class="brand-title" src="./images/long_logo.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->


        <!--**********************************
            Header start
        ***********************************-->
        <?php include 'pages/navbar_header.php' ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include 'pages/sidebar.php' ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="form-head d-flex align-items-center mb-sm-4 mb-3">
                    <div class="mr-auto">
                        <h2 class="text-black font-w600">User Profile of <?php echo $view_row['v_firstname']." ".$view_row['v_lastname']; ?></h2>
                        <p class="mb-0">You may see the information of selected user.</p>

                    </div>

                        
                    <?php 
                    if (isset($_GET['view']) && $_GET['view']=="view") { ?>
                        <div class="text-right">
                            <a href="user_profile.php?user=<?php echo $user_employeeid_look; ?>&view=edit" class="btn btn-primary btn-sm mr-3">Edit User</a>
                        </div>
                    <?php
                    }else{ ?>
                        <div class="text-right">
                            <a href="user_profile.php?user=<?php echo $user_employeeid_look; ?>&view=view" class="btn btn-primary btn-sm mr-3">View Mode</a>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="text-right">
                            <a href="users.php" class="btn btn-primary btn-sm mr-3">Back</a>
                        </div>
                </div>
                
                <div class="row">
                    <div class="col-xl-9 col-xxl-12">

                        <?php 
                        if (isset($_GET['update']) && $_GET['update']=="success") { ?>
                        <div class="alert alert-success solid alert-dismissible fade show">
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                            <strong>Well done!</strong>Your action has been successfully performed..
                        </div>

                        <?php 
                        }
                        ?>
                        


                        <?php 
                        if (isset($_GET['update']) && $_GET['update']=="already") { ?>
                        <div class="alert alert-warning solid alert-dismissible fade show">
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                            <strong>Warning!</strong>Already been pushed to user.
                        </div>
                        <?php 
                        }
                        ?>
                        


                        <div class="row">

                            <?php if ($view=="view") { ?>
                            
                            
                            <div class="col-xl-12">
                                <div class="card details-card">
                                    <img src="images/flexport-banner.png" alt="" class="bg-img">
                                    <div class="card-body">
                                        <div class="d-sm-flex mb-3">
                                            <div class="img-card mb-sm-0 mb-3"> 
                                                <img src="images/profile/2.png" alt=""> 
                                                <div class="info d-flex align-items-center p-md-3 p-2 bg-primary">
                                                    <div>
                                                        <!-- <p class="fs-14 text-white op5 mb-1">Disease</p> -->
                                                        <span class="badge badge-rounded 
                                                        <?php 
                                                        if ($view_row['v_status'] == 'active') {
                                                            echo 'badge-outline-success';
                                                        }else{
                                                            echo 'badge-outline-secondary';
                                                        }

                                                        ?> fs-18 text-white"><?php echo ucfirst($view_row['v_status']); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-info d-flex align-items-start">
                                                <div class="mr-auto pr-3">
                                                    <h2 class="font-w600 mb-2 text-black">
                                                        <?php echo $view_row['v_firstname']." ".$view_row['v_lastname']; ?>
                                                    </h2>
                                                    <p class="mb-2"><?php echo $view_row['v_position']; ?></p>
                                                    <span class="date">
                                                    <i class="las la-clock"></i>
                                                    Join on 21 August 2020, 12:45 AM</span>
                                                </div>
                                                <!-- <span class="mr-ico bg-primary">
                                                    <i class="las la-mars"></i>
                                                </span> -->
                                            </div>
                                        </div>
                                        <!-- <h4 class="fs-20 text-black font-w600">Story About Disease</h4>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                                        </p>
                                        <p>
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi
                                        </p> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 mb-sm-0 mb-3">
                                                <div class="d-flex">
                                                    <i class="lab la-buffer text-primary fs-34 mr-3"></i>
                                                    <div>
                                                        <span class="d-block mb-1 fs-17"><strong>SN Email</strong></span>
                                                        <p class="fs-16 mb-0 text-black">795 Folsom Ave, Suite 600 San Francisco</p>

                                                        <span class="d-block mb-1 fs-17"><strong>Flexport Email</strong></span>
                                                        <p class="fs-16 mb-0 text-black">795 Folsom Ave, Suite 600 San Francisco</p>

                                                        <span class="d-block mb-1 fs-17"><strong>Contact Number</strong></span>
                                                        <p class="fs-16 mb-0 text-black">795 Folsom Ave, Suite 600 San Francisco</p>

                                                        <span class="d-block mb-1 fs-17"><strong>Address</strong></span>
                                                        <p class="fs-16 mb-0 text-black">795 Folsom Ave, Suite 600 San Francisco</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-5">
                                                <div class="map-bx">
                                                    <img src="images/map.jpg" alt="">
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary p-1 fs-12">View in Fullscreen</a>
                                                    <i class="las la-map-marker"></i>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media align-items-center">
                                                    <i class="las la-user-friends fs-30 text-primary mr-3"></i>
                                                    <div class="media-body">
                                                        <span class="d-block mb-1">Line of Business</span>

                                                        <?php 
                                                        if (mysqli_num_rows($view_user_line)>0) {
                                                            while ($row1 = mysqli_fetch_assoc($view_user_line)) {
                                                        ?>
                                                            <p class="badge badge-rounded badge-outline-primary"><?php echo $row1['ul_linebusiness']; ?></p>
                                                        <?php
                                                            }
                                                        }else{ ?>
                                                            <p class="badge badge-rounded badge-outline-secondary">No assigned Line of Business</p>
                                                        <?php
                                                        }
                                                        ?>

                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media align-items-center">
                                                    <i class="las la-user-friends fs-30 text-primary mr-3"></i>
                                                    <div class="media-body">
                                                        <span class="d-block mb-1">Workflow</span>
                                                        <?php 
                                                        if (mysqli_num_rows($view_user_workflow)>0) {
                                                            while ($row1 = mysqli_fetch_assoc($view_user_workflow)) {
                                                        ?>
                                                            <p class="badge badge-rounded badge-outline-primary"><?php echo $row1['wl_name']; ?></p>
                                                        <?php
                                                            }
                                                        }else{ ?>


                                                            <p class="badge badge-rounded badge-outline-secondary">No assigned workflow</p>

                                                        <?php

                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>

                            <?php if ($view=="edit") { ?>

                            <div class="col-xl-12 col-xxl-12">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media align-items-center">
                                                    
                                                    <div class="media-body">
                                                    <span class="d-block mb-1 fs-22"><strong>Edit User</strong></span>
                                                    <hr>
                                                     <form method="post" action="connection/add_user.php">
                                                            <div class="form-row">
                                                                <div class="col-sm-6 form-group">
                                                                    <label><strong>Employee ID</strong></label>
                                                                    <input hidden type="text" class="form-control" name="user_id" value="<?php echo $view_row['v_user_id']; ?>" readonly>
                                                                    <input type="text" class="form-control" name="employee_id" value="<?php echo $user_employeeid_look; ?>">
                                                                </div>
                                                                <div class="col-sm-6 form-group">
                                                                    <label><strong>SN Email</strong></label>
                                                                    <input type="text" class="form-control" name="email" value="<?php echo $view_row['v_email']; ?>" required>
                                                                </div>
                                                                <div class="col-sm-6 form-group">
                                                                    <label> <strong>First Name</strong> </label>
                                                                    <input type="text" class="form-control" name="firstname" value="<?php echo $view_row['v_firstname']; ?>" required>
                                                                </div>
                                                                <div class="col-sm-6 form-group">
                                                                    <label> <strong>Last Name</strong> </label>
                                                                    <input type="text" class="form-control" name="lastname" value="<?php echo $view_row['v_lastname']; ?>" required>
                                                                </div>

                                                                <div class="col-sm-6 form-group">
                                                                    <label> <strong>Immediate Supervisor</strong> </label>
                                                                    <select class="form-control" name="team_manager" required>
                                                                        <option value="<?php echo $view_row['v_team_manager_id']; ?>"><?php echo $view_row['v_team_manager']; ?></option>

                                                                        <?php 
                                                                        if (mysqli_num_rows($select_lead_id_res)>0) {
                                                                            while ($rowM = mysqli_fetch_assoc($select_lead_id_res)) {
                                                                        ?>

                                                                            <option value="<?php echo $rowM['user_employee_id']; ?>"><?php echo $rowM['user_firstname']." ".$rowM['user_lastname']; ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6 form-group">
                                                                    <label> <strong>Position</strong> </label>
                                                                    <select class="form-control" name="position" required>
                                                                        <option selected><?php echo $view_row['v_position']; ?></option>
                                                                        <option>Data Entry I</option>
                                                                        <option>Data Entry II</option>
                                                                        <option>Data Entry III</option>
                                                                        <option>Team Manager</option>
                                                                        <option>Operations Manager</option>
                                                                        <option>Director</option>

                                                                        
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6 form-group">
                                                                    <label> <strong>Status</strong> </label>
                                                                    <select class="form-control" name="status" required>
                                                                        <option selected><?php echo $view_row['v_status']; ?></option>
                                                                        <option>active</option>
                                                                        <option>locked</option>

                                                                        
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-12 mt-2">
                                                                    <button id="button" name="btn_edit" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-location-arrow"></i> Save</button>
                                                                    <a class="btn btn-secondary btn-sm text-white" href="users.php">Cancel</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                       
                                                    

                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-xl-12 col-xxl-12">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="media align-items-center">
                                                    
                                                    <div class="media-body">
                                                    <span class="d-block mb-1 fs-22"><strong>Assign Panel</strong></span>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-6 mb-3 row">
                                                            <div class="col-sm-6">
                                                                <span class="d-block mb-1 fs-16"><strong>Line of Business</strong></span>
                                                            </div>
                                                            <div class="col-sm-6 text-right">
                                                                <button type="button" class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#linebusiness_panel">Add<span class="btn-icon-right"><i class="fa fa-plus" aria-hidden="true"></i></span></button>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <?php 
                                                                if (mysqli_num_rows($user_list_lob_res_main)>0) {
                                                                    while ($row = mysqli_fetch_assoc($user_list_lob_res_main)) {
                                                                ?>
                                                                    <span class="badge badge-rounded badge-outline-primary mt-2"><?php echo $row['ul_linebusiness']; ?></span>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                                
                                                               
                                                            </div>
                                                            

                                                        </div>
                                                        <div class="col-sm-6 mb-3 row">
                                                             <div class="col-sm-6">
                                                                <span class="d-block mb-1 fs-16"><strong>Workflow</strong></span>
                                                            </div>
                                                            <div class="col-sm-6 text-right">
                                                                <button type="button" class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#workflow_panel">Add<span class="btn-icon-right"><i class="fa fa-plus" aria-hidden="true"></i></span></button>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <?php 
                                                                if (mysqli_num_rows($user_list_wf_res)>0) {
                                                                    while ($row1 = mysqli_fetch_assoc($user_list_wf_res)) {
                                                                ?>
                                                                    <span class="badge badge-rounded badge-outline-secondary mt-2"><?php echo $row1['wl_name']; ?></span>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                                
                                                               
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="col-sm-6 mb-3 row">
                                                             <div class="col-sm-6">
                                                                <span class="d-block mb-1 fs-16"><strong>SOP</strong></span>
                                                            </div>
                                                            <div class="col-sm-6 text-right">
                                                                <button type="button" class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#sop_panel">Add<span class="btn-icon-right"><i class="fa fa-plus" aria-hidden="true"></i></span></button>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <?php 
                                                                if (mysqli_num_rows($user_list_sop_res)>0) {
                                                                    while ($row = mysqli_fetch_assoc($user_list_sop_res)) {
                                                                ?>
                                                                    <span class="badge badge-rounded badge-outline-success mt-2"><?php echo $row['sop_name']; ?></span>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                                
                                                               
                                                            </div>
                                                            
                                                        </div>


                                                        <div class="col-sm-6 mb-3 row">
                                                             <div class="col-sm-6">
                                                                <span class="d-block mb-1 fs-16"><strong>Role</strong></span>
                                                            </div>
                                                            <!-- <div class="col-sm-6 text-right">
                                                                <button type="button" class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#sop_panel">Add<span class="btn-icon-right"><i class="fa fa-plus" aria-hidden="true"></i></span></button>
                                                            </div> -->
                                                            <div class="col-sm-12">
                                                                <?php 
                                                                if (mysqli_num_rows($user_list_role_res)>0) {
                                                                    while ($row = mysqli_fetch_assoc($user_list_role_res)) {
                                                                ?>
                                                                    <span class="badge badge-rounded badge-outline-info mt-2"><?php echo $row['role_name']; ?> 

                                                                    <?php if (in_array("Administrator",$_roles)) { ?>
                                                                    <a href="connection/delete_assign.php?roleid=<?php echo $row['role_id']; ?>&employee_id=<?php echo $row['user_employee_id']; ?>" class="text-secondary"><i class="las la-times-circle scale5"></i></a>
                                                                    <?php } ?>

                                                                    </span>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            
                                                        </div>


                                                        <div class="col-sm-6 mb-3 row">
                                                             <div class="col-sm-6">
                                                                <span class="d-block mb-1 fs-16"><strong>Tracker</strong></span>
                                                            </div>
                                                            <!-- <div class="col-sm-6 text-right">
                                                                <button type="button" class="btn btn-primary btn-xxs" data-toggle="modal" data-target="#sop_panel">Add<span class="btn-icon-right"><i class="fa fa-plus" aria-hidden="true"></i></span></button>
                                                            </div> -->
                                                            <div class="col-sm-12">
                                                                <?php 
                                                                if (mysqli_num_rows($user_list_tracker_res)>0) {
                                                                    while ($row = mysqli_fetch_assoc($user_list_tracker_res)) {
                                                                ?>
                                                                    <span class="badge badge-rounded badge-outline-warning mt-2"><?php echo $row['tr_name']; ?> 

                                                                    <?php if (in_array("Administrator",$_roles)) { ?>
                                                                    <a href="connection/delete_assign.php?trackerid=<?php echo $row['tr_id']; ?>&employee_id=<?php echo $row['user_employee_id']; ?>" class="text-secondary"><i class="las la-times-circle scale5"></i></a>
                                                                    <?php } ?>

                                                                    </span>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                       
                                                    

                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <?php } ?>





                        </div>
                    </div>

                    <?php if ($view=="view") { ?>
                    <div class="col-xl-3 col-xxl-12">
                        <div class="row">
                            <div class="col-xl-12 col-xxl-4 col-lg-5">
                                <div class="card">
                                    <div class="card-header border-0 pb-0">
                                        <h4 class="fs-20 text-black mb-0">Immediate Supervisor</h4>
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="media mb-4 align-items-center">
                                            <img src="images/users/12.jpg" alt="" width="85" class="mr-3">
                                            <div class="media-body">
                                                <h3 class="fs-18 font-w600 mb-1"><a href="javascript:void(0)" class="text-black">
                                                <?php echo $view_row['v_team_manager']; ?>
                                                </a></h3>
                                                <span class="fs-14"><?php echo $view_row['v_team_manager_pos']; ?></span>
                                                <!-- <ul class="stars">
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star"></i></li>
                                                    <li><i class="las la-star text-dark"></i></li>
                                                </ul> -->
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-6">
                                                <a href="javascript:void(0)" class="btn btn-outline-dark mb-2 btn-sm d-block">Unassign</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="javascript:void(0)" class="btn btn-primary light mb-2 btn-sm d-block">Check</a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-12 col-xxl-8 col-lg-7">
                                <div class="card">
                                    <div class="card-header border-0 pb-0">
                                        <div>
                                            <h4 class="fs-20 text-black mb-1">User Statistic</h4>
                                            <span class="fs-12">Lorem ipsum dolor sit amet, consectetur</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-xl-12 col-xxl-6 col-sm-6">
                                                <div id="pieChart"></div>
                                            </div>
                                            <div class="mt-4 col-xl-12 col-xxl-6 col-sm-6">
                                                <div class="d-flex mb-3 align-items-center">
                                                    <span class="fs-12 col-6 p-0 text-black">
                                                        <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="19" height="19" fill="#5F74BF"/>
                                                        </svg>
                                                        Immunities
                                                    </span>
                                                    <div class="progress rounded-0 col-6 p-0">
                                                        <div class="progress-bar rounded-0 progress-animated" style="width: 80%; height:6px;background:#5F74BF;" role="progressbar">
                                                            <span class="sr-only">60% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-3 align-items-center">
                                                    <span class="fs-12 col-6 p-0 text-black">
                                                        <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="19" height="19" fill="#FFD439"/>
                                                        </svg>
                                                        Stamina
                                                    </span>
                                                    <div class="progress rounded-0 col-6 p-0">
                                                        <div class="progress-bar rounded-0 progress-animated" style="width: 40%; height:6px;background:#FFD439;" role="progressbar">
                                                            <span class="sr-only">60% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-3 align-items-center">
                                                    <span class="fs-12 col-6 p-0 text-black">
                                                        <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="19" height="19" fill="#FF6E5A"/>
                                                        </svg>
                                                        Heart Beat
                                                    </span>
                                                    <div class="progress rounded-0 col-6 p-0">
                                                        <div class="progress-bar rounded-0 progress-animated" style="width: 90%; height:6px;background:#FF6E5A;" role="progressbar">
                                                            <span class="sr-only">60% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="fs-12 col-6 p-0 text-black">
                                                        <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="19" height="19" fill="#5FBF91"/>
                                                        </svg>
                                                        Colestrol
                                                    </span>
                                                    <div class="progress rounded-0 col-6 p-0">
                                                        <div class="progress-bar rounded-0 progress-animated" style="width: 80%; height:6px;background:#5FBF91;" role="progressbar">
                                                            <span class="sr-only">60% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header border-0 pb-0">
                                        <h4 class="fs-20 text-black mb-0">Note for patient</h4>
                                        <a href="javascript:void(0)">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8684 8.09625C20.9527 8.25375 21 8.43375 21 8.625V18.75C21 21.2351 18.9862 23.25 16.5 23.25H4.125C3.504 23.25 3 22.746 3 22.125V1.875C3 1.254 3.504 0.75 4.125 0.75H13.125C13.3162 0.75 13.4963 0.797251 13.6538 0.881626L13.6571 0.883874C13.7449 0.929999 13.827 0.989626 13.9013 1.0605L13.9204 1.07962L20.6704 7.82962L20.6895 7.84875C20.7615 7.92413 20.82 8.00625 20.8673 8.09287L20.8684 8.09625ZM12 3H5.25V21H16.5C17.7431 21 18.75 19.9931 18.75 18.75V9.75H13.125C12.504 9.75 12 9.246 12 8.625V3ZM9.75 18.75H14.25C14.871 18.75 15.375 18.246 15.375 17.625C15.375 17.004 14.871 16.5 14.25 16.5H9.75C9.129 16.5 8.625 17.004 8.625 17.625C8.625 18.246 9.129 18.75 9.75 18.75ZM8.625 14.25H15.375C15.996 14.25 16.5 13.746 16.5 13.125C16.5 12.504 15.996 12 15.375 12H8.625C8.004 12 7.5 12.504 7.5 13.125C7.5 13.746 8.004 14.25 8.625 14.25ZM17.1592 7.5L14.25 4.59075V7.5H17.1592Z" fill="black"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="card-body pt-3">
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequa</p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
                
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <?php include 'pages/footer.php'; ?>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>

    <!-- sweetalert -->
    <script src="./vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- <script src="./js/plugins-init/sweetalert.init.js"></script> -->


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="./js/plugins-init/select2-init.js"></script> -->
</body>
<script type="text/javascript">
	$(document).ready(function() {
	    $('.js-example-basic-single').select2();
	});
</script>

<script type="text/javascript">

    $('.distro').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: '#',
            data: $(this).serialize(),
            beforeSend: function() {
                document.getElementById("button").disabled = true;
            },
            success: function(result) {
                
            }
        });
    });

</script>
<?php 
include 'modal/assign_panel.php';
?>
</html>