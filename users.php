<?php include('include/header.php') ?>

<?php

include 'config.php';
$msg = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);
    $school = mysqli_real_escape_string($conn, $_POST['school']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);

    // check if there is already an administrator
    $result = mysqli_query($conn, "SELECT * FROM users WHERE status='administrator'");
    if (mysqli_num_rows($result) > 0 && $status === 'administrator') {
        $msg = "<div class='alert alert-danger'>An administrator user already exists.</div>";
    } else {
        // if no admin account it will save
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>The email address already exists.</div>";
        } else {
            if ($password === $confirm_password) {
                $sql = "INSERT INTO users (name, email, status, password, school, district) VALUES ('{$name}', '{$email}', '{$status}', '{$password}', '{$school}', '{$district}')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $_SESSION['success'] = "User added";

                    header('Location: users.php');
                    exit();
                } else {
                    $msg = "<div class='alert alert-danger'>Failed to register. Please try again.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
            }
        }
    }
}

?>

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
    if (isset($_SESSION['error'])) {
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
            <?php if ($type == "coordinator"): ?>
                <a href="treeform.php" class="btn btn-sm float-end ml-2" style="background: #22418B; color: #FFF;">Add New
                    Entry</a> <span> </span>
                <a href="update-status.php?user_id=<?php echo $id; ?>" class="btn btn-sm float-end ml-2"
                    style="background: #22418B; color: #FFF;">Update
                    Status</a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php if ($type == "administrator"): ?>
                <div class="row">
                    <div class="col">
                        <form action="" method="post">
                            <input type="text" class="name form-control mb-2" name="name" placeholder="Enter Your Name"
                                value="<?php if (isset($_POST['submit'])) {
                                    echo $name;
                                } ?>" required>
                            <input type="email" class="email form-control mb-2" name="email" placeholder="Enter Your Email"
                                value="<?php if (isset($_POST['submit'])) {
                                    echo $email;
                                } ?>" required>
                            <div class="form-group mb-3">
                                <label for="">User Type</label>
                                <select class="form-select form-control" name="status">
                                    <option value="coordinator">Coordinator</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <?php
                                $sql = "SELECT * FROM school";
                                $result = mysqli_query($conn, $sql);
                                $schools = array();
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $schools[] = $row;
                                }
                                ?>
                                <label for="validationServer01">School</label>
                                <select class="form-select form-control" name="school">
                                    <?php foreach ($schools as $school): ?>
                                        <option value="<?php echo $school['name']; ?>">
                                            <?php echo $school['name']; ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="">District</label>
                                <div class="form-group mb-2">
                                    <?php
                                    $sql_d = "SELECT * FROM district";
                                    $result_d = mysqli_query($conn, $sql_d);
                                    $district_d = array();
                                    while ($row_d = mysqli_fetch_assoc($result_d)) {
                                        $district_d[] = $row_d;
                                    }
                                    mysqli_close($conn);
                                    ?>
                                    <select class="form-select form-control" name="district">
                                        <?php foreach ($district_d as $district) : ?>
                                            <option value="<?php echo $district['name']; ?>">
                                                <?php echo $district['name']; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <input type="password" class="password form-control mb-2" name="password"
                                placeholder="Enter Your Password" required>
                            <input type="password" class="confirm-password form-control mb-2" name="confirm-password"
                                placeholder="Confirm your Password" required>
                            <button name="submit" class="btn btn-success" type="submit">Add User</button>
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
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Password</th>
                                            <th>School - District</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">


                                        <?php
                                        include('include/db.php');
                                        $sql_user = "SELECT * FROM users WHERE status = 'coordinator' ORDER BY name ASC";
                                        $res = $conn->query($sql_user);

                                        $conn->close();
                                        ?>
                                        <?php while ($row = $res->fetch_assoc()): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row["email"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["name"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["password"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['school'] ?> - <?php echo $row['district'] ?> 
                                                </td>
                                                <td>
                                                    <a href="update_user.php?id=<?php echo $row['id'] ?>"  class="btn btn-sm btn-warning mb-3">Update</a>

                                                    <form action="include/delete_user.php" method="post">
                                                        <input type="hidden" name="id" id="id" value="<?php echo $row['id'] ?>">
                                                        <button class="btn btn-danger text-white btn-sm" name="submit"
                                                            type="submit">Delete</button>
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