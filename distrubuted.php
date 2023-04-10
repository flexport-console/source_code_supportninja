<?php 
include 'connection/user_information.php';
if (!in_array("Queue",$_roles)) {
   header("location: 403.php");
}



    $select_distro = "SELECT q.q_id as ID, q.q_flex_id as FlexID, q.q_lineofbusiness as Linebusiness, q.q_workflow as Workflow, q.q_sop as SOP, concat(u.user_firstname,' ', u.user_lastname) as Name FROM queue q JOIN users u on q.user_employee_id=u.user_employee_id WHERE q.q_added_by='$userid' AND q.q_date='$date' AND q.q_status!='break'";
    $select_distro_res = mysqli_query($conn,$select_distro);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>supportninja</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/new_logo.png">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./vendor/chartist/css/chartist.min.css">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

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
                        <h2 class="text-black font-w600">Distribute Queue</h2>
                        <p class="mb-0">Today's distro are listed here.</p>
                    </div>
                    <div>
                        <form class="distro" method="post" action="#">
                            <input hidden type="text" name="delete_checkbox" value="delete_checkbox">
                            <button type="submit" class="btn btn-secondary btn-sm mr-3 text-white"> Delete</button>
                        </form>
                    </div>
                </div>
                <hr>
                <?php 
                if (isset($_GET['deleted']) && $_GET['deleted']=="success") { 
                ?>
                <div class="alert alert-primary solid alert-right-icon alert-dismissible fade show">
                    <span><i class="mdi mdi-account-plus"></i></span>
                     <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button> Success! Ticket has been deleted.
                </div>

                <?php
                }
                ?>

                <?php 
                if (isset($_GET['deleted']) && $_GET['deleted']=="error") { 
                ?>
                <div class="alert alert-danger solid alert-right-icon alert-dismissible fade show">
                    <span><i class="mdi mdi-account-plus"></i></span>
                     <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button> Error! Please report to Jerramy Calites.
                </div>

                <?php
                }
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive card-table">
                            <table id="example5" class="display dataTablesCard table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Flex-ID</th>
                                        <th>Name</th>
                                        <th>Line of Business</th>
                                        <th>Workflow</th>
                                        <th>SOP</th>
                                        <th>Distributed by</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($select_distro_res)>0) {
                                        while ($row = mysqli_fetch_assoc($select_distro_res)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox mx-2">
                                                <input type="checkbox" class="custom-control-input" id="<?php echo $row['ID']; ?>" onclick="validated(<?php echo $row['ID']; ?>)">
                                                <label class="custom-control-label" for="<?php echo $row['ID']; ?>"></label>
                                            </div>
                                        </td>
                                        <td><?php echo $row['FlexID']; ?></td>
                                        <td><?php echo $row['Name']; ?></td>
                                        <td><?php echo $row['Linebusiness']; ?></td>
                                        <td><?php echo $row['Workflow']; ?></td>
                                        <td><?php echo $row['SOP']; ?></td>
                                        <td><?php echo $userid; ?></td>
                                    </tr>

                                    <?php
                                        }
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
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


<!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script>
        (function($) {
            var table = $('#example5').DataTable({
                // searching: false,
                paging:true,
                select: false,
                pageLength: 50,
                //info: false,         
                lengthChange:false 
                
            });
            $('#example tbody').on('click', 'tr', function () {
                var data = table.row( this ).data();
                
            });
        })(jQuery);
    </script>

<script type="text/javascript">
    var toBeDelete = [];

    function validated(id){
        // to add in the array
        if (document.getElementById(id).checked) {
            toBeDelete.push(id);
        } else {
            // to remove from the array
            const index = toBeDelete.indexOf(id);
            if (index !== -1) {
                toBeDelete.splice(index, 1);
            }
        }
        console.log(toBeDelete)
    }


    $('.distro').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
              url: 'connection/delete_check.php',
              data: {myArray: toBeDelete},
              success: function(response) {
                if (response=="error") {
                    window.location.href = "distrubuted.php?deleted=error";
                    
                }else{
                     window.location.href = "distrubuted.php?deleted=success";
                    var toBeDelete = [];
                    console.log(response)
                    
                }
              }
            
        });
    });

</script>

</html>