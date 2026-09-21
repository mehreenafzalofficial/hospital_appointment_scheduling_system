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
                <th>Available Days</th>
                <th>Available Time</th>
            </tr>

            <tr>
                <td>D-01</td>
                <td>Dr. Ahmed</td>
                <td>Cardiologist</td>
                <td>Monday - Friday</td>
                <td>9:00 AM - 1:00 PM</td>
            </tr>

            <tr>
                <td>D-02</td>
                <td>Dr. Sara</td>
                <td>Neurologist</td>
                <td>Tuesday - Saturday</td>
                <td>10:00 AM - 2:00 PM</td>
            </tr>

            <tr>
                <td>D-03</td>
                <td>Dr. Ali</td>
                <td>Dermatologist</td>
                <td>Monday - Thursday</td>
                <td>11:00 AM - 3:00 PM</td>
            </tr>

        </table>

        <a href="staff dashboard.php" class="back">
            Back to Dashboard
        </a>

    </div>

</body>
</html>