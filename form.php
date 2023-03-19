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

    <?php include 'include/sidebar.html';?>
    <section class="home-section">
        <div class="container_form">
<div class="m-3 dropdown">
    <button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        VIEW PURCHASE REQUESTS
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    </div>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Add New</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <form action="handlers/save-pr.php" method="POST" id="my-form">
            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;"
                class="form-row col-12 text-dark border border-white border-radius align-items-center justify-center">
                <div class="row">
                    <div class="form-row col-11 mx-auto">
                        <div class="col-md-1 mb-3">
                            <label for="validationServer01">Stock No.</label>
                            <input type="text" class="form-control" name="stock_no[]" required>
                        </div>

                        <div class="col-md-1 mb-3">
                            <label for="validationServer01">Unit</label>
                            <input type="text" class="form-control" name="unit[]" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="validationServer01">Item Description</label>
                            <input type="text" class="form-control" name="item_description[]" required>
                        </div>

                        <div class="col-md-1 mb-3">
                            <label for="validationServer01">Quantity</label>
                            <input type="text" class="form-control" name="quantity[]" required>
                        </div>

                        <div class="col-md-1 mb-3">
                            <label for="validationServer01">Unit Cost</label>
                            <input type="text" class="form-control" name="unit_cost[]" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="validationServer01">Total Cost</label>
                            <input type="text" class="form-control" name="total_cost[]" required>
                        </div>

                        <div class="col-md-1 mb-3">
                            <label for="validationServer01">Type</label>
                            <select class="form-select form-control" name="type[]">
                                <option value="1">Office Supplies</option>
                                <option value="2">Non-Office Supplies</option>
                            </select>
                        </div>

                        <div class="col-md-1 mb-3">
                            <label for="validationServer01" class="text-center">---</label>
                            <select class="form-select form-control" name="consumable[]">
                                <option value="1">Consumable</option>
                                <option value="2">Non-Consumable</option>
                            </select>
                        </div>
                    </div>
                    <a type="button" class="remove-row ml-3 text-bold text-danger"
                        style="font-weight: bold; font-size: 20px;">x</a>
                </div>
            </div>


            <div id="form-rows"
                class="form-row col-12 text-dark border border-white border-radius align-items-center justify-center"
                style="display: flex; align-items: center; justify-content: center; flex-direction: column;"></div>
            <div class="col col-3 mx-auto">
                <button type="submit" class=" mt-2 btn btn-sm col-sm-12 mx-auto btn-dark">SAVE REQUEST</button>
            </div>
        </form>
        <button type="button" class="text-dark btn text-sm col-1 mb-3 mx-auto float-right" style="font-size: 15px;"
            id="add-row"><i class="fa fa-plus"></i>New Row</button>
    </div>
</div>