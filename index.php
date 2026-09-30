<?php
require_once 'config/config.php';

if(isset($_SESSION['user_id'])){
    header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');   
    exit; 
}

$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    
    $error = 'Invalid login credentials.';
    

    if ($login == '' || $password == '') {

        //Log incomplete login attemp
        logActivity($pdo, null, $login, 'login','failed');

    }else {

    
    $result = loginUser($pdo, $login, $password);

    if($result===true){
        //log incomplete login attemp
        logActivity(
            $pdo,$_SESSION['user_id'], 
            $_SESSION['user_email'], 
            'login',
            'success'
        );

        echo 'Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php';
        header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
        exit;

    }elseif($result=== 'active_session'){

        $error = 'This account is already logged in on another device';

    } else{

        $error = 'Invalid login credentials';
    }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />

</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h2 class="card-body">Login</h2>
        <?php if($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        
        <form method="POST">

            <!-- Username nga Input -->
            <div class="mb-3">
                <label for="login" class="form-label">Username</label>
                <input type="text"
                    class="form-control"
                    id="login"
                    name="login"
                    required>
            </div>

            <!-- Password nga Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    required>
            </div>

            <!-- Submit nga Button -->
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
</body>
</html>