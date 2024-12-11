<!DOCTYPE html>
<html>
<head>
    <title>Complaint Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .dashboard-card {
            padding: 20px;
            margin: 15px 0;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
        .dashboard-card h3 {
            margin: 0;
            font-size: 24px;
        }
        .dashboard-card p {
            font-size: 16px;
        }
    </style>
</head>
<body>
<?php
// Connect to MySQL Database using MySQLi
$conn = mysqli_connect('localhost', 'root', '', 'ERCMS');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to get complaint counts
$newCountQuery = "SELECT COUNT(*) as count FROM complaints WHERE action = 'Not yet'";
$pendingCountQuery = "SELECT COUNT(*) as count FROM complaints WHERE action = 'Pending'";
$closedCountQuery = "SELECT COUNT(*) as count FROM complaints WHERE action = 'Closed'";
$archivedCountQuery = "SELECT COUNT(*) as count FROM complaints WHERE action = 'Archived'";

// Execute queries
$newCount = mysqli_fetch_assoc(mysqli_query($conn, $newCountQuery))['count'];
$pendingCount = mysqli_fetch_assoc(mysqli_query($conn, $pendingCountQuery))['count'];
$closedCount = mysqli_fetch_assoc(mysqli_query($conn, $closedCountQuery))['count'];
$archivedCount = mysqli_fetch_assoc(mysqli_query($conn, $archivedCountQuery))['count'];

// Fetch history logs (last 5 complaints for demonstration)
$historyLogQuery = "SELECT * FROM complaints ORDER BY date_of_complaint DESC LIMIT 5";
$historyLog = mysqli_query($conn, $historyLogQuery);
?>

<div class="container">
    <h1>Complaint Management Dashboard</h1>
    <div class="row">
        <div class="col-md-3">
            <div class="dashboard-card">
                <h3><?php echo $newCount; ?></h3>
                <p>New Complaints</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <h3><?php echo $pendingCount; ?></h3>
                <p>Pending Complaints</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <h3><?php echo $closedCount; ?></h3>
                <p>Closed Complaints</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <h3><?php echo $archivedCount; ?></h3>
                <p>Archived Complaints</p>
            </div>
        </div>
    </div>

    <h2>History Log</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Complaint No</th>
                <th>Complainant</th>
                <th>Category</th>
                <th>Urgency</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($log = mysqli_fetch_assoc($historyLog)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($log['id']); ?></td>
                    <td><?php echo htmlspecialchars($log['username']); ?></td>
                    <td><?php echo htmlspecialchars($log['category']); ?></td>
                    <td><?php echo htmlspecialchars($log['urgency']); ?></td>
                    <td><?php echo htmlspecialchars($log['date_of_complaint']); ?></td>
                    <td><?php echo htmlspecialchars($log['action']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
