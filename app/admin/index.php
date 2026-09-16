<?php
require '../../config/config.php';
require '../../config/functions.php';

requireRole('admin');

logActivity(
    $pdo, 
    $_SESSION['user_id'], 
    $_SESSION['user_email'], 
    'view_activity_logs', 
    'success');

//Activity logs Query#3
$stmt = $pdo ->query("
    SELECT * 
    FROM activity_logs 
    ORDER BY activity_log_created_at DESC");

$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.8/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/3.0.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/4.0.3/css/buttons.bootstrap5.min.css"
    
</head>
<body>
    <h1>Welcome Admin</h1>
    <a href="../../auth/signout.php">Sign Out</a>
        <div class="container mt-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">


    <div class="responsive-table">
        <table class="table table-striped table-bordered">
        <thead>

            <tr>
                <th>Record ID</th>
                <th>User ID</th>
                <th>User Email</th>
                <th>Action</th>
                <th>Status</th>
                <th>IP Address</th>
                <th>User Agent</th>
                <th>Date & Time</th>
            </tr>
        </thead>

            <?php foreach($activities as $activity):?>
                <tr>
                    <td><?= htmlspecialchars($activity['activity_log_id'])?></td>
                    <td><?= htmlspecialchars($activity['user_id'])?></td>
                    <td><?= htmlspecialchars($activity['user_email'])?></td>
                    <td><?= htmlspecialchars($activity['activity_log_action'])?></td>
                    <td><?= htmlspecialchars($activity['activity_log_status'])?></td>
                    <td><?= htmlspecialchars($activity['activity_log_ip_address' ])?></td>
                    <td><?= htmlspecialchars($activity['activity_log_user_agent' ])?></td>
                    <td><?= htmlspecialchars($activity['activity_log_created_at' ])?></td>
                </tr>
            <?php endforeach; ?>
            
    </table>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/3.0.4/js/jquery.dataTables.min.js"></script>

</body>
</html>