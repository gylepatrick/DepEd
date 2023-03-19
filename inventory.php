<?php
include('include/header.php');
?>

<?php include 'include/sidebar.php'; ?>
<section class="home-section bg-white">

    <div class="card col-11 mt-3 mx-auto">
        <?php
        include 'include/db.php';
        ?>
        <div class="card-header" style="background: #22418B; color: #FFF;">
            <b>Inventory Bank</b>
        </div>

        <div class="card-body">
            <?php


            // Retrieve data for each tree in the inv_bank table
            $sql = "SELECT user_id, school, tree_id, tree, tree_type, tree_status, location, latitude, longitude, month FROM inv_bank ORDER BY tree ASC";
            $result = mysqli_query($conn, $sql);

            ?>
            <table class="table table-responsive table-bordered" id="table-inv">
                <thead>
                    <tr>
                        <th>School</th>
                        <th>Tree</th>
                        <th>Tree Type</th>
                        <?php
                        $months = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $month = $row['month'];
                            if (!in_array($month, $months)) {
                                // himoang header ang month
                                $months[] = $month;
                                echo "<th>" . $month . "</th>";
                            }
                        }
                        ?>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $trees = array();
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $trees[] = $row;
                    }

                    foreach ($trees as $tree) {
                        $tree_id = $tree['tree_id'];
                        $school = $tree['school'];
                        $tree_status = $tree['tree_status'];
                        $tree_month = $tree['month'];

                        if (!isset($tree_data[$tree_id])) {
                            // new row para sa kahoy
                            $tree_data[$tree_id] = array(
                                "user_id" => $tree['user_id'],
                                "school" => $tree['school'],
                                "tree" => $tree['tree'],
                                "tree_type" => $tree['tree_type'],
                                "status" => array()
                            );
                        }

                        if (!isset($tree_data[$tree_id]["status"][$tree_month])) {
                            // new col for month
                            $tree_data[$tree_id]["status"][$tree_month] = $tree_status;
                        }

                        // Update the status for the current month
                        $tree_data[$tree_id]["status"][$tree_month] = $tree_status;
                    }

                    // tree data
                    foreach ($tree_data as $tree_id => $tree) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $tree['school'] ?>
                            </td>
                            <td>
                                <?php echo $tree['tree_type'] ?>
                            </td>
                            <td>
                                <?php echo $tree['tree'] ?>
                            </td>

                            <?php
                            foreach ($months as $month) {
                                // Check if the current month has a status for the current tree
                                if (isset($tree['status'][$month])) {
                                    echo "<td>" . $tree['status'][$month] . "</td>";
                                } else {
                                    echo "<td>-</td>";
                                }
                            }
                            ?>

                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
</div>

<script>
    $(document).ready(function () {
        $('#table-inv').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
<?php include('include/footer.php') ?>