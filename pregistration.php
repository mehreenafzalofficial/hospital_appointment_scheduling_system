<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'connection.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid          = trim($_POST['pid'] ?? '');
    $name         = trim($_POST['name'] ?? '');
    $age          = trim($_POST['age'] ?? '');
    $gender       = trim($_POST['gender'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $password     = $_POST['password'] ?? '';
    $confirm      = $_POST['confirm_password'] ?? '';

    if ($pid === '' || $name === '' || $email === '' || $password === '') {
        $error = "Please fill in all required fields.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Check if PID or email is already taken
        $stmt = $conn->prepare("SELECT PID FROM Patient WHERE PID = ? OR Email = ?");
        $stmt->bind_param("ss", $pid, $email);
        $stmt->execute();
        $existing = $stmt->get_result();
        $stmt->close();

        if ($existing->num_rows > 0) {
            $error = "An account with that Patient ID or email already exists.";
        } else {
            // Password plain text save ho raha hai (no hashing)
            $stmt = $conn->prepare("INSERT INTO Patient (PID, Name, Age, Gender, Phone, Email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissss", $pid, $name, $age, $gender, $phone, $email, $password);
            $stmt->execute();
            $stmt->close();

            $success = "Patient account created successfully! You can now log in.";
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient Registration</title>
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
        .input-group input,
        .input-group select {
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
        .input-group select {
            background: rgba(20, 40, 70, 0.9);
        }
        .input-group select option {
            color: #000;
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
        <h2>Patient Registration</h2>
        <?php if ($error): ?>
            <p style="color:red; text-align:center;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color:lightgreen; text-align:center;"><?php echo htmlspecialchars($success); ?></p>
            <p style="text-align:center;"><a href="pateint login.php" style="color:#fff;">Go to Patient Login →</a></p>
        <?php else: ?>
        <form action="pregistration.php" method="POST">
            <div class="reg-grid">
                <div class="input-group">
                    <label>Patient ID</label>
                    <input type="text" name="pid" placeholder="e.g. P-04" required
                           value="<?php echo isset($pid) ? htmlspecialchars($pid) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your name" required
                           value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Age</label>
                    <input type="number" name="age" placeholder="Enter your age" min="0"
                           value="<?php echo isset($age) ? htmlspecialchars($age) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Gender</label>
                    <select name="gender">
                        <option value="" disabled <?php echo !isset($gender) ? 'selected' : ''; ?>>Select gender</option>
                        <option value="Male" <?php echo (isset($gender) && $gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo (isset($gender) && $gender === 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo (isset($gender) && $gender === 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="e.g. 0300-1234567"
                           value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
                </div>
                <div class="input-group">
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