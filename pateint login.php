<?php
session_start();
include 'connection.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database mein Email aur Password check karne ki query
    $stmt = $conn->prepare("SELECT * FROM Patient WHERE Email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['patient_id'] = $row['PID']; // Session mein PID save kar li
        header("Location: pappointment booking.php");
        exit();
    } else {
        $error = "Invalid Email or Password!";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>HMSS - Patient Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-box">
        <h2>PATIENT LOGIN</h2>
        
        <?php if(!empty($error)) { echo "<p style='color:red; text-align:center;'>$error</p>"; } ?>

        <form method="POST" action="">
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>

        <!-- Naye users ke liye registration link -->
        <p style="text-align:center; margin-top:15px; color:white;">
            Don't have an account? <a href="pregistration.php" style="color: #4f4caf; text-decoration: underline;">Register here</a>
        </p>

        <a href="index.php" class="back" style="display:block; text-align:center; margin-top:10px; color:white;">Back to Home</a>
    </div>
</body>
</html>
