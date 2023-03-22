<!-- script for chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- start -->
<?php include('include/header.php') ?>
<?php include 'include/sidebar.php'; ?>
<section class="home-section bg-white">




    <?php $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

    if (mysqli_num_rows($query) > 0) {
        $row2 = mysqli_fetch_assoc($query);
        $name = $row2['name'];
        $id = $row2['id'];
        $type = $row2['status'];
    } ?>

    <?php
    if (isset($_SESSION['success'])) {
        ?>
        <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
            <strong></strong>
            <?php echo $_SESSION['success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION['success']);
    }
    ?>





    <!-- bar chart type-->

    <?php

    $sql_chart2 = "SELECT tree_type, COUNT(*) as count FROM tree GROUP BY tree_type DESC LIMIT 2";
    $result_chart2 = $conn->query($sql_chart2);

    $labels2 = [];
    $data2 = [];

    while ($row_chart2 = $result_chart2->fetch_assoc()) {
        array_push($labels2, $row_chart2['tree_type']);
        array_push($data2, $row_chart2['count']);
    }
    ?>

    <div class="card col-11 mt-3 mx-auto">
        <div class="card-header">
            <b>Top 5 By School</b>
        </div>
        <div class="card-body p-3">
        <canvas class="col-md-6" id="tree-chart2"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('tree-chart2').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels2); ?>,
                datasets: [{
                    label: 'Tree Count By Type',
                    data: <?php echo json_encode($data2); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- end barchar -->


    <!-- bar chart school-->

    <?php

    $sql_chart = "SELECT school_name, COUNT(*) as count FROM tree GROUP BY school_name DESC LIMIT 5";
    $result_chart = $conn->query($sql_chart);

    $labels = [];
    $data = [];

    while ($row_chart = $result_chart->fetch_assoc()) {
        array_push($labels, $row_chart['school_name']);
        array_push($data, $row_chart['count']);
    }
    ?>

    <div class="card col-11 mt-3 mx-auto">
        <div class="card-header">
            <b>Top 5 By School</b>
        </div>
        <div class="card-body p-3">
        <canvas class="col-md-6" id="tree-chart"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('tree-chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Tree Count By Type',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- end barchar -->


    <!-- tree monitoring table -->
    <div class="card col-11 mx-auto mt-3 bg-white">

        <div class="card-header text-white
            " style="background: #22418B;">
            <b>TREE MONITORING TABLE</b>
            <?php if ($type == "coordinator"): ?>
                <a href="treeform.php" class="btn btn-sm float-end ml-2" style="background: #22418B; color: #FFF;">Add New
                    Entry</a> <span> </span>
                <a href="update-status.php?user_id=<?php echo $id; ?>" class="btn btn-sm float-end ml-2"
                    style="background: #22418B; color: #FFF;">Update
                    Status</a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php if ($type == "coordinator"): ?>
                <table class="table table-bordered table-responsive" id="example">

                    <thead class="text-center">
                        <tr>
                            <th>Tree</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>Location</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                        <!-- if not admin it will only display the current user logged in data -->

                        <?php
                        include('include/db.php');
                        // SQL query to retrieve all users
                        $sql = "SELECT * FROM tree WHERE user_id = '$name'";
                        $result = $conn->query($sql);

                        // Close database connection
                        $conn->close();
                        ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php echo $row["tree"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["tree_type"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["tree_status"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["longitude"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["latitude"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["location"]; ?>
                                </td>
                                <td>
                                    <form action="include/delete_tree.php" method="post">
                                        <input type="hidden" name="id" id="id" value="<?php echo $row['id'] ?>">
                                        <button class="btn btn-danger text-white btn-sm" name="submit"
                                            type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <!-- if admin it will display all the data -->
            <?php if ($type == "administrator"): ?>
                <table class="table table-bordered table-responsive" id="table_admin">

                    <thead class="text-center">
                        <tr>
                            <th>School</th>
                            <th>Tree</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    </tr>
                    <tbody class="text-center">

                        <!-- if not admin it will only display the current user logged in data -->

                        <?php
                        // SQL query to retrieve all users
                        $sql3 = "SELECT * FROM tree ORDER BY tree ASC";
                        $result3 = $conn->query($sql3);

                        // Close database connection
                        $conn->close();
                        ?>
                        <?php while ($row3 = $result3->fetch_assoc()): ?>

                            <tr>
                                <td>
                                    <?php echo $row3['school_name'] ?>
                                </td>
                                <td>
                                    <?php echo $row3["tree"]; ?>
                                </td>
                                <td>
                                    <?php echo $row3["tree_type"]; ?>
                                </td>
                                <td>
                                    <?php echo $row3["tree_status"]; ?>
                                </td>
                                <td>
                                    <?php echo $row3["longitude"]; ?>
                                </td>
                                <td>
                                    <?php echo $row3["latitude"]; ?>
                                </td>
                                <td>
                                    <?php echo $row3["location"]; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>


                    </tbody>
                </table>
            <?php endif; ?>

        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('#table_admin').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</section>
</div>
<?php include('include/footer.php') ?>