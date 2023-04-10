<div class="modal fade" id="backlogs">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="connection/queue_distro.php">
                <div class="modal-header">
                    <h5 class="modal-title">Backlogs</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <label><strong>SOP</strong></label>
                            <select class="form-control" required name="sop">
                                <option selected disabled></option>
                                <?php 
                                if (mysqli_num_rows($user_sop_modal)>0) {
                                    while ($row = mysqli_fetch_assoc($user_sop_modal)) { 
                                ?>
                                    <option><?php echo $row['sop_name']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <label><strong>Flex-ID</strong></label>
                            <textarea class="form-control" name="d_queue" id="QueueBox" placeholder="Input the Flex ID...." rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark light btn-xxs" data-dismiss="modal">Close</button>
                    <button type="submit" name="btn_bl" class="btn btn-primary btn-xxs">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    var box = document.getElementById('QueueBox');
    var charlimit = 7; // char limit per line
    box.onkeyup = function() {
        var lines = box.value.split('\n');
        for (var i = 0; i < lines.length; i++) {
            if (lines[i].length <= charlimit) continue;
            var j = 0;
            space = charlimit;
            while (j++ <= charlimit) {
                if (lines[i].charAt(j) === ' ') space = j;
            }
            lines[i + 1] = lines[i].substring(space + 1) + (lines[i + 1] || "");
            lines[i] = lines[i].substring(0, space);
        }
        box.value = lines.slice(0, 5).join('\n');
    };
</script>

<script type="text/javascript">
    $('#QueueBox').keypress(function(e) {
        var a = [];
        var k = e.which;

        for (i = 48; i < 58; i++)
            a.push(i);

        if (!(a.indexOf(k) >= 0))
            e.preventDefault();
    });
</script>