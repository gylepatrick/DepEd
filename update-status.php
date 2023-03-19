<?php include('include/header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <title>UPDATE TREE STATUS</title>
</head>

<body>

    <?php include 'include/sidebar.php'; ?>
    <section class="home-section bg-white">
        <?php $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

        if (mysqli_num_rows($query) > 0) {
            $row2 = mysqli_fetch_assoc($query);
            $name = $row2['name'];
            $type = $row2['status'];
        } ?>


        <div class="container-fluid">
            <?php

            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
            }
            ?>

            <!-- Page Heading -->
            <div class="d-sm-flex justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Purchase Request</h1>
            </div>
            <!-- Content Row -->
            <div class="row">
                <div class="col-xl-12 col-lg-7">
                    <div class="card col-12 mx-auto mt-3">
                        <div class="card-header bg-dark text-white">
                            <b>UPDATE</b>
                        </div>
                        <div class="card-body mb-3 border col-12 mx-auto">
                            <form class="col-12 mx-auto" method="post" action="include/update-status.php">
                                <input type="hidden" name="pr_no" value="<?php echo $pr_no; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <table class="col-12 mx-auto">
                                    <tr>
                                        <th>By: </th>
                                        <th>School</th>
                                        <th>Tree</th>
                                        <th>Type</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                    </tr>
                                    <?php
                                    // Retrieve the data for the specified pr_no
                                    $query2 = "SELECT * FROM tree WHERE user_id = '$name'";
                                    $result2 = mysqli_query($conn, $query2);

                                    if (mysqli_num_rows($result2) > 0) {
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            $id = $row2['id'];
                                            $tree = $row2['tree'];
                                            $status = $row2['tree_status'];
                                            $location = $row2['location']
                                                ?>

                                            <tr>
                                                <input type='hidden' class="form-control" name='id[]' value='<?php echo $id ?>'>
                                                <td>
                                                    <input type="text" class="form-control" name="user_id[]"
                                                        value="<?php echo $row2['user_id'] ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="school[]"
                                                        value="<?php echo $row2['school_name'] ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="tree[]"
                                                        value="<?php echo $tree ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="tree_type[]"
                                                        value="<?php echo $row2['tree_type'] ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="latitude[]"
                                                        value="<?php echo $row2['latitude'] ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="longitude[]"
                                                        value="<?php echo $row2['longitude'] ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="location[]"
                                                        value="<?php echo $location ?>">
                                                </td>
                                                <td>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <select name="tree_status[]" id="status" class="form-control">
                                                                <?php
                                                                if ($row2['tree_status'] == "alive") {
                                                                    ?>
                                                                    <option class="selected" value="alive">Alive</option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option class="selected" value="dead">Dead</option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <option value="alive">Alive</option>
                                                                <option value="dead">Dead</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </table>
                                <button class="btn btn-success" type="submit">Update</button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
<?php include('include/footer.php'); ?>