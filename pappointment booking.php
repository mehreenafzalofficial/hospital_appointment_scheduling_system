<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pid   = $_POST['pid'];<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pid   = $_POST['pid'];
    $did   = $_POST['did'];
    $date  = $_POST['appointment_date'];
    $time  = $_POST['appointment_time'];
    $status = "Pending";
    $aid   = "A-" . rand(100, 999);
    $sid   = 'S-01'; // Default staff assigned

    $stmt = $conn->prepare(
        "INSERT INTO Appointments (AID, Date, Time, Status, PID, DID, SID)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssss", $aid, $date, $time, $status, $pid, $did, $sid);

    if ($stmt->execute()) {
        header("Location: pbooked appointment.php");
        exit();
    } else {
        $msg = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$doctors_result = $conn->query("SELECT * FROM Doctors");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>HMSS - Patient Appointment</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="box glass">
        <h2>📝 Patient - Book Your Appointment</h2>

        <?php if (!empty($msg)) { echo "<p style='color:lightgreen; text-align:center; font-weight:bold;'>$msg</p>"; } ?>

        <form class="form" method="POST" action="">

            <div class="form-group">
                <label>Patient ID</label>
                <input type="text" name="pid" placeholder="Enter your Patient ID (e.g. P-01)" required>
            </div>

            <div class="form-group">
                <label>Doctor</label>
                <select name="did" required>
                    <option value="">Select Doctor</option>
                    <?php
                    if ($doctors_result && $doctors_result->num_rows > 0) {
                        while ($doc = $doctors_result->fetch_assoc()) {
                            echo "<option value='{$doc['DID']}'>{$doc['Name']} ({$doc['Specialization']})</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="appointment_date" required>
            </div>

            <div class="form-group">
                <label>Time</label>
                <input type="time" name="appointment_time" required>
            </div>

            <button type="submit">Book Appointment</button>

        </form>

        <a href="index.php" class="back" style="display:block; text-align:center; margin-top:15px; color:white;">
            Back to Home
        </a>
    </div>
</body>
</html>
    $did   = $_POST['did'];
    $date  = $_POST['appointment_date'];
    $time  = $_POST['appointment_time'];
    $status = "Pending";
    $aid   = "A-" . rand(100, 999);
    $sid   = 'S-01'; // Default staff assigned

    $stmt = $conn->prepare(
        "INSERT INTO Appointments (AID, Date, Time, Status, PID, DID, SID)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssss", $aid, $date, $time, $status, $pid, $did, $sid);

    if ($stmt->execute()) {
        header("Location: pbooked appointment.php");
        exit();
    } else {
        $msg = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$doctors_result = $conn->query("SELECT * FROM Doctors");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>HMSS - Patient Appointment</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="box glass">
        <h2>📝 Patient - Book Your Appointment</h2>

        <?php if (!empty($msg)) { echo "<p style='color:lightgreen; text-align:center; font-weight:bold;'>$msg</p>"; } ?>

        <form class="form" method="POST" action="">

            <div class="form-group">
                <label>Patient ID</label>
                <input type="text" name="pid" placeholder="Enter your Patient ID (e.g. P-01)" required>
            </div>

            <div class="form-group">
                <label>Doctor</label>
                <select name="did" required>
                    <option value="">Select Doctor</option>
                    <?php
                    if ($doctors_result && $doctors_result->num_rows > 0) {
                        while ($doc = $doctors_result->fetch_assoc()) {
                            echo "<option value='{$doc['DID']}'>{$doc['Name']} ({$doc['Specialization']})</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="appointment_date" required>
            </div>

            <div class="form-group">
                <label>Time</label>
                <input type="time" name="appointment_time" required>
            </div>

            <button type="submit">Book Appointment</button>

        </form>

        <a href="index.php" class="back" style="display:block; text-align:center; margin-top:15px; color:white;">
            Back to Home
        </a>
    </div>
</body>
</html>
