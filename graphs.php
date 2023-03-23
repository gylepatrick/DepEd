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

    $sql_chart2 = "SELECT tree_type, COUNT(*) as count FROM tree GROUP BY tree_type DESC LIMIT 5";
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
            <b>By Type</b>
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
            <b>By School</b>
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
                }],

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


    <!-- by district -->

    <?php

    $sql_d = "SELECT district_name, COUNT(*) as count FROM tree GROUP BY district_name DESC LIMIT 5";
    $result_chart_d = $conn->query($sql_d);

    $labels_d = [];
    $data_d = [];

    while ($row_chart_d = $result_chart_d->fetch_assoc()) {
        array_push($labels_d, $row_chart_d['district_name']);
        array_push($data_d, $row_chart_d['count']);
    }
    ?>

    <div class="card col-11 mt-3 mx-auto">
        <div class="card-header">
            <b>By District</b>
        </div>
        <div class="card-body p-3">
            <canvas class="col-md-6" id="tree-chart_d"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('tree-chart_d').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels_d); ?>,
                datasets: [{
                    label: 'Tree Count By Type',
                    data: <?php echo json_encode($data_d); ?>,
                }],

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

    <!-- end by district -->

    <!-- by brgy -->

    <?php

    $sql_b = "SELECT brgy, COUNT(*) as count FROM tree GROUP BY brgy DESC LIMIT 5";
    $result_b = $conn->query($sql_b);

    $labels_b = [];
    $data_b = [];

    while ($row_b = $result_b->fetch_assoc()) {
        array_push($labels_b, $row_b['brgy']);
        array_push($data_b, $row_b['count']);
    }
    ?>

    <div class="card col-11 mt-3 mx-auto">
        <div class="card-header">
            <b>By Barangay</b>
        </div>
        <div class="card-body p-3">
            <canvas class="col-md-6" id="tree-chart_b"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('tree-chart_b').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels_b); ?>,
                datasets: [{
                    label: 'Brgy.',
                    data: <?php echo json_encode($data_b); ?>,
                }],

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

    <!-- end by brgy -->


    <!-- pie chart -->

    <?php

    $sql_pie = "SELECT tree_type, COUNT(*) as count FROM tree GROUP BY tree_type DESC LIMIT 5";
    $result_pie = $conn->query($sql_pie);

    $_pie = [];
    $data_pie = [];

    while ($row_pie = $result_pie->fetch_assoc()) {
        array_push($_pie, $row_pie['tree_type']);
        array_push($data_pie, $row_pie['count']);
    }
    ?>

    <div class="tree_pie card col-11 mt-3 mx-auto">
        <div class="card-body p-3">
            <canvas class="col-6" id="tree-pie"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('tree-pie').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($_pie); ?>,
                datasets: [{
                    label: 'COUNT',
                    data: <?php echo json_encode($data_pie); ?>,
                }],
                title: {
                    display: true,
                    text: 'Tree Type'
                }
            },
            scales: {
                y: {
                    min: 10,
                    max: 20,
                }
            },
            options: {
                responsive: true,
            }
        });
    </script>

    <!-- end pie -->

</section>
</div>

<?php include('include/footer.php') ?>