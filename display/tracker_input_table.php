<?php
include '../connection/function.php';

$select_distro = "SELECT * FROM queue WHERE user_employee_id='$user_id' AND q_submitted='pending' ORDER BY q_id DESC";
$select_distro_res = mysqli_query($conn, $select_distro);

?>

<table class="table header-border table-responsive-sm fixed">
    <thead>
        <tr>
            <th>Flex-ID</th>
            <th>Workflow</th>
            <th>SOP</th>
            <th>Handle Time</th>
            <th>Status</th>
            <th>Remarks</th>
            <th># of Shipment</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if (mysqli_num_rows($select_distro_res)>0) {
            while ($row = mysqli_fetch_assoc($select_distro_res)) {
        ?>
        <tr>
            <td>
                <?php echo $row['q_flex_id']; ?>
            </td>
            <td><span
            class="
            <?php 
             if ($row['q_status']=="Unprocessed") {
                echo "badge badge-rounded badge-secondary text-white";
            }elseif ($row['q_status']=="Processed") {
                echo "badge badge-rounded badge-success";
            }elseif ($row['q_status']=="Untouched") {
                echo "badge badge-rounded badge-primary text-white";
            }
            ?>

            ">
            <?php echo $row['q_workflow']; ?></span>
            </td>
            <td>
                <?php echo $row['q_sop']; ?>
            </td>
            <td>
                <?php timeDiff($row['q_start_time'],$row['q_end_time']) ?>
            </td>
            <td>
                <?php echo $row['q_status']; ?>
            </td>
            <td>
                <?php echo $row['q_remarks']; ?>
            </td>
            <td>
                <?php echo $row['q_shipment']; ?>
            </td>
            <td>
                <a onclick="return confirmWithSweetAlert(<?php echo $row['q_id']; ?>)" class="btn btn-rounded btn-outline-secondary btn-xxs myButton">Delete</a>
            </td>
        </tr>

        <?php 
            }
        }
        ?>
    </tbody>
</table>