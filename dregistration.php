<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'connection.php';

// Sirf logged-in staff hi is page ko access kar sake
if (!isset($_SESSION['staff_id'])) {
    header("Location: staff login.php");
    exit();
}

$loggedInSID = $_SESSION['staff_id'];

$error = "";
$success = "";

// Room list fetch karo dropdown ke liye
$roomList = $conn->query("SELECT RNo FROM Room ORDER BY RNo");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $did            = trim($_POST['did'] ?? '');
    $name           = trim($_POST['name'] ?? '');
    $specialization = trim($_POST['specialization'] ?? '');
    $phone          = trim($_POST['phone'] ?? '');
    $sid            = $loggedInSID;   // session se, form se nahi
    $rno            = trim($_POST['rno'] ?? '');

    if ($did === '' || $name === '') {
        $error = "Please fill in all required fields.";
    } else {
        // Check if DID already taken
        $stmt = $conn->prepare("SELECT DID FROM Doctors WHERE DID = ?");
        $stmt->bind_param("s", $did);
        $stmt->execute();
        $existing = $stmt->get_result();
        $stmt->close();

        if ($existing->num_rows > 0) {
            $error = "A doctor with that Doctor ID already exists.";
        } else {
            $stmt = $conn->prepare("INSERT INTO Doctors (DID, Name, Specialization, Phone, SID, RNo) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $did, $name, $specialization, $phone, $sid, $rno);
            $stmt->execute();
            $stmt->close();

            $success = "Doctor registered successfully!";
        }
    }

    // Dropdown dobara fetch karo (page reload ke liye)
    $roomList = $conn->query("SELECT RNo FROM Room ORDER BY RNo");
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctor Registration</title>
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
        .input-group input[readonly] {
            color: rgba(255,255,255,0.7);
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
        <h2>Doctor Registration</h2>
        <?php if ($error): ?>
            <p style="color:red; text-align:center;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color:lightgreen; text-align:center;"><?php echo htmlspecialchars($success); ?></p>
            <p style="text-align:center;"><a href="doctors.php" style="color:#fff;">Go to Doctors List →</a></p>
        <?php else: ?>
        <form action="dregistration.php" method="POST">
            <div class="reg-grid">
                <div class="input-group">
                    <label>Doctor ID</label>
                    <input type="text" name="did" placeholder="e.g. D-04" required
                           value="<?php echo isset($did) ? htmlspecialchars($did) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Doctor Name</label>
                    <input type="text" name="name" placeholder="e.g. Dr. Ahmed" required
                           value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Specialization</label>
                    <input type="text" name="specialization" placeholder="e.g. Cardiologist"
                           value="<?php echo isset($specialization) ? htmlspecialchars($specialization) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="e.g. 0300-1234567"
                           value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
                </div>
                <div class="input-group">
                    <label>Registered By (Staff)</label>
                    <input type="text" value="<?php echo htmlspecialchars($loggedInSID); ?>" readonly>
                </div>
                <div class="input-group">
                    <label>Room Number</label>
                    <select name="rno" required>
                        <option value="">-- Select Room --</option>
                        <?php while ($room = $roomList->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($room['RNo']); ?>"
                                <?php echo (isset($rno) && $rno === $room['RNo']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($room['RNo']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="reg-btn">Register Doctor</button>
        </form>
        <?php endif; ?>
        <?php if (!$success): ?>
        <div class="reg-links">
            <a href="doctors.php">Back to Doctors List</a>
        </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>