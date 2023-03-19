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
                <table class="table table-bordered" id="example">

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