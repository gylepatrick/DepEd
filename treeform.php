<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

include 'config.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Form</title>
</head>

<body>

    <?php include 'include/sidebar.php'; ?>
    <section class="home-section">
        <div class="container_form">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">

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

                        <div class="card mt-4 mb-3">
                            <div class="card-header" style="background: #22418B;">
                                <h4>
                                    <a id="add-row" class="add-more-form float-end btn btn-sm text-white">ADD
                                        MORE</a>
                                </h4>
                            </div>
                            <div class="card-body">

                                <div class="card mt-0">
                                    <div class="card-header">
                                        <b>Tree Form</b>
                                    </div>
                                    <div class="card-body">
                                        <!-- query the name -->
                                        <?php

                                        $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

                                        if (mysqli_num_rows($query) > 0) {
                                            $row = mysqli_fetch_assoc($query);

                                            $name = $row['name'];
                                            $school = $row['school'];
                                            $district = $row['district'];
                                        }
                                        ?>
                                        <form action="include/treeForm.php" method="POST">

                                            <div class="row">
                                                <div class="form-group mb-2 col-2">
                                                    <label for="" class="text-sm">Name(Uneditable)</label>
                                                    <input type="text" name="user_id" readonly="readonly"
                                                        class="form-control" value="<?php echo $name; ?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group mb-4">
                                                        <label for="">School(Uneditable)</label>
                                                        <input type="text" name="school_name" readonly="readonly"
                                                            class="form-control" value="<?php echo $school; ?> - <?php echo $district ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group mb-2">
                                                        <label for="">Date</label>
                                                        <input type="date" name="date" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group mb-2">
                                                        <label for="">Location</label>
                                                        <select name="locations" id="location" class="form-control">
                                                            <option>--Select--</option>
                                                            <option value="inside">Inside School</option>
                                                            <option value="outside">Outside School</option>
                                                        </select>
                                                        <input type="text" name="location" class="form-control" required
                                                            placeholder="Please Specify">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-row">
                                                <div class="main-form mt-3 border-bottom">
                                                    <div class="row form-row">
                                                        <div class="col-md-2">
                                                            <div class="form-group mb-2">
                                                                <label for="">Tree</label>
                                                                <input type="text" name="tree[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group mb-2">
                                                                <label for="">Type</label>
                                                                <select name="tree_type[]" id="type"
                                                                    class="form-control">
                                                                    <option>--Select Type--</option>
                                                                    <option value="foriegn">Foriegn</option>
                                                                    <option value="native">Native</option>
                                                                    <option value="fruit">Fruit</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group mb-2">
                                                                <label for="">Status</label>
                                                                <select name="tree_status[]" id="status"
                                                                    class="form-control">
                                                                    <option>--Select Status--</option>
                                                                    <option value="alive">Alive</option>
                                                                    <option value="dead">Dead</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group mb-2">
                                                                <label for="">Longitude</label>
                                                                <input type="text" name="longitude[]"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group mb-2">
                                                                <label for="">Latitude</label>
                                                                <input type="text" name="latitude[]"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group mb-2">
                                                                <br>
                                                                <button type="button"
                                                                    class="remove-btn btn btn-danger">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="form-rows" class="form-row"></div>

                                            <input class="btn btn-success" type="submit" name="save" id="save"
                                                value="Save Data">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="assets/js/sidebar.js"></script>
    <script src="assets/js/treeform.js"></script>
    <script>
        $(document).ready(function () {
            var formRow = $('.form-row:first');

            $('#add-row').click(function () {
                var newRow = $('<div class="form-row mt-3">' + formRow.html() + '</div>');
                newRow.find('.remove-row').click(function () {
                    $(this).parent().remove();
                });
                $('#form-rows').append(newRow);
            });
        });
    </script>


</body>

</html>