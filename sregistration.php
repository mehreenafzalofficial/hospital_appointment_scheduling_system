<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'connection.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sid          = trim($_POST['sid'] ?? '');
    $name         = trim($_POST['name'] ?? '');
    $position     = trim($_POST['position'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $password     = $_POST['password'] ?? '';
    $confirm      = $_POST['confirm_password'] ?? '';

    if ($sid === '' || $name === '' || $email === '' || $password === '') {
        $error = "Please fill in all required fields.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Check if SID or email is already taken
        $stmt = $conn->prepare("SELECT SID FROM Staff WHERE SID = ? OR Email = ?");
        $stmt->bind_param("ss", $sid, $email);
        $stmt->execute();
        $existing = $stmt->get_result();
        $stmt->close();

        if ($existing->num_rows > 0) {
            $error = "An account with that Staff ID or email already exists.";
        } else {
            // Password plain text save ho raha hai (no hashing)
            $stmt = $conn->prepare("INSERT INTO Staff (SID, Name, Position, Phone, Email, Password) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $sid, $name, $position, $phone, $email, $password);
            $stmt->execute();
            $stmt->close();

            $success = "Staff account created successfully! You can now log in.";
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff Registration</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .reg-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px 20px;
        }
        .reg-card {
            background: rgba(20, 40, 70, 0.55);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 16px;
            padding: 35px 40px;
            width: 100%;
            max-width: 650px;
            color: #fff;
            backdrop-filter: blur(4px);
        }
        .reg-card h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
        }
        .reg-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 30px;
        }
        .reg-grid .full-width {
            grid-column: 1 / -1;
        }
        .input-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 15px;
        }
        .input-group input {
            width: 100%;
            padding: 10px 5px;
            background: transparent;
            border: none;
            border-bottom: 2px solid rgba(255,255,255,0.6);
            color: #fff;
            font-size: 15px;
            outline: none;
            box-sizing: border-box;
        }
        .input-group input::placeholder {
            color: rgba(255,255,255,0.5);
        }
        .reg-btn {
            width: 100%;
            margin-top: 25px;
            padding: 14px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            color: #fff;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
        }
        .reg-links {
            text-align: center;
            margin-top: 15px;
        }
        .reg-links a {
            display: block;
            color: #fff;
            text-decoration: underline;
            margin-top: 8px;
        }
    </style>
</head>

<body>
<div class="reg-wrapper">
    <div class="reg-card">
        <h2>Staff Registration</h2>
        <?php if ($error): ?>
            <p style="color:red; text-align:center;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color:lightgreen; text-align:center;"><?php echo htmlspecialchars($success); ?></p>
            <p style="text-align:center;"><a href="staff login.php" style="color:#fff;">Go to Staff Login →</a></p>
        <?php else: ?>
        <form action="sregistration.php" method="POST">
            <div class="reg-grid">
                <div class="input-group">
                    <label>Staff ID</label>
                    <input type="text" name="sid" placeholder="e.g. STF001" required
                           value="<?php echo isset($sid) ? htmlspecialchars($sid) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" required
                           value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Position</label>
                    <input type="text" name="position" placeholder="e.g. Staff, Admin, Nurse"
                           value="<?php echo isset($position) ? htmlspecialchars($position) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="e.g. 0300-1234567"
                           value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
                </div>
                <div class="input-group full-width">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required
                           value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Choose a password" required>
                </div>
                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Re-enter your password" required>
                </div>
            </div>
            <button type="submit" class="reg-btn">Register Account</button>
        </form>
        <?php endif; ?>
        <div class="reg-links">
            <a href="index.php">Back to Home</a>
        </div>
    </div>
</div>
</body>
</html>