<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>TREE</title>
</head>

<body>

    <?php include 'include/sidebar.html'; ?>
    <section class="home-section bg-white">
        <?php $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

        if (mysqli_num_rows($query) > 0) {
            $row2 = mysqli_fetch_assoc($query);

            $name = $row2['name'];
        } ?>


        <div class="col bg-white mt-3">
            <b class="text-lg text-uppercase text-primary">Welcome <?php echo $name ?> </b>
        </div>


        <div class="card mt-3 bg-white">
            <div class="card-header bg-dark text-white
            ">
                <b>TREE MONITORING</b>
                <a href="treeform.php" class="btn btn-sm btn-success float-rigth">Add New Entry</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="example">

                    <thead class="text-center">
                        <tr>
                            <th>Tree</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        include('include/db.php');
                        // SQL query to retrieve all users
                        $sql = "SELECT * FROM tree WHERE user_id = '$name'";
                        $result = $conn->query($sql);

                        // Close database connection
                        $conn->close();
                        ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row["tree"]; ?></td>
                                <td><?php echo $row["tree_type"]; ?></td>
                                <td><?php echo $row["tree_status"]; ?></td>
                                <td><?php echo $row["longitude"]; ?></td>
                                <td><?php echo $row["latitude"]; ?></td>
                                <td><?php echo $row["location"]; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</body>

</html>