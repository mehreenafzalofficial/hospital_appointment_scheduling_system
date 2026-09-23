<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'connection.php';

$result = $conn->query("SELECT DID, Name, Specialization, Phone, SID, RNo FROM Doctors ORDER BY DID");
?>
<!DOCTYPE html>
<html>
<head>

    <title>HMAS - Doctors</title>

    <link rel="stylesheet" href="style.css">

    <style>

        .doctor-box {
            width: 850px;
            margin: 100px auto;
            padding: 20px;
            background: rgba(30, 45, 65, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 15px;
        }

        .doctor-box h2 {
            color: white;
            text-align: center;
            margin-bottom: 15px;
        }

        .add-doctor-btn {
            display: block;
            width: fit-content;
            margin: 0 auto 20px;
            padding: 10px 25px;
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            color: #fff;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
        }

        .add-doctor-btn:hover {
            opacity: 0.9;
        }

        .doctor-table {
            width: 100%;
            border-collapse: collapse;
            color: white;
        }

        .doctor-table th {
            background-color: #4b45c6;
            padding: 12px;
            text-align: left;
        }

        .doctor-table td {
            padding: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .doctor-table tr:hover {
            background-color: rgba(255, 255, 255, 0.08);
        }

        .back {
            display: block;
            width: fit-content;
            margin: 25px auto 5px;
            color: white;
        }

        .back:hover {
            color: #ffd166;
        }

    </style>

</head>

<body>

    <div class="doctor-box">

        <h2>DOCTORS</h2>

        <table class="doctor-table">

            <tr>
                <th>Doctor ID</th>
                <th>Doctor Name</th>
                <th>Specialization</th>
                <th>Phone</th>
                <th>Room No</th>
            </tr>

            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['DID']); ?></td>
                        <td><?php echo htmlspecialchars($row['Name']); ?></td>
                        <td><?php echo htmlspecialchars($row['Specialization']); ?></td>
                        <td><?php echo htmlspecialchars($row['Phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['RNo']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No doctors found.</td>
                </tr>
            <?php endif; ?>

        </table>
<br>
        <a href="dregistration.php" class="add-doctor-btn">+ Add New Doctor</a>

        <a href="staff dashboard.php" class="back">
            Back to Dashboard
        </a>

    </div>

</body>
</html>
<?php $conn->close(); ?>
