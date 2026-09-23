
<!DOCTYPE html>
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pid   = $_POST['pid'];
    $did   = $_POST['did'];
    $date  = $_POST['appointment_date'];
    $time  = $_POST['appointment_time'];
    $status = "Confirmed";
    $aid   = "A-" . rand(100, 999);
    
    // Login staff ki ID uthayega (e.g., S-02 Fatima)
    $sid = isset($_SESSION['staff_id']) ? $_SESSION['staff_id'] : 'S-01';

    $stmt = $conn->prepare(
        "INSERT INTO Appointments (AID, Date, Time, Status, PID, DID, SID)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssss", $aid, $date, $time, $status, $pid, $did, $sid);

    if ($stmt->execute()) {
        // Ab yeh foran us page par le jayega jahan booked appointments show hoti hain
        header("Location: sbooked appointment.php");
        exit();
    } else {
        $msg = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$doctors_result = $conn->query("SELECT * FROM Doctors");
?>
<html lang="en">
<head>
<title>HMSS - Book Appointment</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="box glass">
        <h2>📝 Book Your Appointment</h2>
        
        <?php if(!empty($msg)){ echo "<p style='color:lightgreen; text-align:center; font-weight:bold;'>$msg</p>"; } ?>

        <form class="form" method="POST" action="">
            
            <div class="form-group">
                <label>Patient ID</label>
                <input type="text" name="pid" placeholder="Enter Patient ID (e.g. P-01)" required>
            </div>

            <div class="form-group">
                <label>Doctor</label>
                <select name="did" required>
                    <option value="">Select Doctor</option>
                    <?php
                    if ($doctors_result && $doctors_result->num_rows > 0) {
                        while($doc = $doctors_result->fetch_assoc()) {
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

<a href="staff dashboard.php" class="back">
           Back to Dashboard
        </a>
    </div>
</body>
</html>