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

    <?php
    if (isset($_SESSION['success'])) {
    ?>
        <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
            <strong></strong>
            <?php echo $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION['error']);
    }
    ?>
    <div class="card col-11 mx-auto mt-3 bg-white">

        <div class="card-header text-white
            " style="background: #22418B;">
            <b>SCHOOL MANAGEMENT</b>
            <?php if ($type == "coordinator") : ?>
                <a href="treeform.php" class="btn btn-sm float-end ml-2" style="background: #22418B; color: #FFF;">Add New
                    Entry</a> <span> </span>
                <a href="update-status.php?user_id=<?php echo $id; ?>" class="btn btn-sm float-end ml-2" style="background: #22418B; color: #FFF;">Update
                    Status</a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php if ($type == "administrator") : ?>
                <div class="row">
                    <div class="col">
                        <form action="include/school.php" method="post">
                            <div class="mb-3">
                                <label for="">School</label>
                                <input type="text" name="school_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">District</label>
                                <div class="form-group mb-2">
                                    <?php
                                    $sql = "SELECT * FROM district";
                                    $result = mysqli_query($conn, $sql);
                                    $schools = array();
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $schools[] = $row;
                                    }
                                    mysqli_close($conn);
                                    ?>
                                    <select class="form-select form-control" name="district_id">
                                        <?php foreach ($schools as $school) : ?>
                                            <option value="<?php echo $school['name']; ?>">
                                                <?php echo $school['name']; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-success col-6 mx-auto" name="submit">Save</button>
                        </form>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <b>Schools</b>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="example">

                                    <thead class="text-center">
                                        <tr>
                                            <th>School Name</th>
                                            <th>District</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">


                                        <?php
                                        include('include/db.php');
                                        $sql_school = "SELECT * FROM school ORDER BY name ASC";
                                        $res = $conn->query($sql_school);

                                        $conn->close();
                                        ?>
                                        <?php while ($row_school = $res->fetch_assoc()) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row_school["name"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row_school["district_id"]; ?>
                                                </td>
                                                <td>
                                                    <form action="include/delete_school.php" method="post">
                                                        <input type="hidden" name="id" id="id" value="<?php echo $row_school['id'] ?>">
                                                        <button class="btn btn-danger text-white btn-sm" name="submit" type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>


    <div class="card col-11 mx-auto mt-3 bg-white">

        <div class="card-header text-white
            " style="background: #22418B;">
            <b>DISTRICT MANAGEMENT</b>
            <?php if ($type == "coordinator") : ?>
                <a href="treeform.php" class="btn btn-sm float-end ml-2" style="background: #22418B; color: #FFF;">Add New
                    Entry</a> <span> </span>
                <a href="update-status.php?user_id=<?php echo $id; ?>" class="btn btn-sm float-end ml-2" style="background: #22418B; color: #FFF;">Update
                    Status</a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php if ($type == "administrator") : ?>
                <div class="row">
                    <div class="col">
                        <form action="include/district.php" method="post">
                            <div class="mb-3">
                                <label for="">District</label>
                                <input type="text" name="district" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-sm btn-success col-6 mx-auto" name="submit">Save</button>
                        </form>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <b>Schools</b>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="example">

                                    <thead class="text-center">
                                        <tr>
                                            <th>District</th>
                                            <th>-</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">


                                        <?php
                                        include('include/db.php');
                                        $sql_district = "SELECT * FROM district ORDER BY name ASC";
                                        $res_d = $conn->query($sql_district);

                                        $conn->close();
                                        ?>
                                        <?php while ($row_d = $res_d->fetch_assoc()) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row_d["name"]; ?>
                                                </td>
                                                <td>
                                                    <form action="include/delete_district.php" method="post">
                                                        <input type="text" name="name" id="name" value="<?php echo $row_d['name'] ?>">
                                                        <input type="hidden" name="id" id="id" value="<?php echo $row_d['id'] ?>">
                                                        <button class="btn btn-danger text-white btn-sm" name="submit" type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>


    <script>
        $(document).ready(function() {
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