<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
include('include/db.php');

// SQL query to retrieve tree count based on tree_type
$sql = "SELECT tree, COUNT(*) as count FROM tree WHERE tree_status = 'alive' GROUP BY tree ";
$result = $conn->query($sql);

// Initialize arrays for chart data
$labels = [];
$data = [];

// Loop through the query results and add data to arrays
while ($row = $result->fetch_assoc()) {
    array_push($labels, $row['tree']);
    array_push($data, $row['count']);
}

// Close database connection
$conn->close();
?>

<canvas id="tree-chart"></canvas>


<script>
// Get the canvas element and create a new chart
var ctx = document.getElementById('tree-chart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'Tree Count',
            data: <?php echo json_encode($data); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
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
