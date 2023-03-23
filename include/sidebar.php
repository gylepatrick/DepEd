<?php
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

include 'db.php';
?>

<?php $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row2 = mysqli_fetch_assoc($query);
    $name = $row2['name'];
    $id = $row2['id'];
    $type = $row2['status'];
} ?>

<div class="sidebar">
    <div class="logo-details">
        <!-- logo link -->
        <img src="assets/img/logo.png" style="width: 80px;" alt="logo">
        <!-- css link -->
        <link rel="stylesheet" href="assets/css/sidebar.css" type="text/css" media="all" />
        <!-- box icon link -->
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <span class="logo_name">DepEd Malaybalay</span>
    </div>
    <ul class="nav-links">
        <br>
        <br>
        <!-- home/index page -->
        <li>
            <a href="welcome.php">
                <i class='bx bx-home-alt icon'></i>
                <span class="link_name">Home</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="inventory.php">Home</a></li>
            </ul>
        </li>

        <?php if ($type == "coordinator"):?>
        <!-- tree inventory page -->
        <li>
            <a href="treeform.php">
                <i class='bx bxs-tree icon'></i>
                <span class="link_name">Tree Locator Form</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="treeform.php">Tree Locator Form</a></li>
            </ul>
        </li>
        <?php endif; ?>

        <?php if ($type == "administrator"):?>
        <li>
            <a href="inventory.php">
                <i class='bx bxs-bank icon'></i>
                <span class="link_name">Inventory Bank</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="inventory.php">Inventory Bank</a></li>
            </ul>
        </li>

        <li>
            <a href="graphs.php">
                <i class='bx bxl-graphql'></i>
                <span class="link_name">Graphs</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="graphs.php">Graphs</a></li>
            </ul>
        </li>

        <li>
            <a href="school.php">
                <i class='bx bxs-school icon'></i>
                <span class="link_name">School/District</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="school.php">School/District</a></li>
            </ul>
        </li>
        
        <!-- about page -->
        <li>
            <a href="users.php">
                <i class='bx bx-user'></i>
                <span class="link_name">Users</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="users.php">Users</a></li>
            </ul>
        </li>
        <?php endif; ?>
        <br>
        <br>
        <!-- logout -->
        <li>
            <a href="logout.php">
                <i class='bx bx-log-out'></i>
                <span class="link_name">Logout</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>
<script src="assets/js/sidebar.js"></script>