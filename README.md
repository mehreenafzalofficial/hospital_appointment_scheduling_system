# hospital_appointment_scheduling_system
# 🏥 Hospital Appointment Scheduling System (HASS)

A dynamic, database-driven full-stack web application designed to streamline hospital operations, manage patient and staff authentication, and handle appointment bookings efficiently.

## 🚀 Features

* **Secure Authentication:** Separate, secure email and password login systems for both Patients and Staff.
* **Role-Based Access Control:** Dynamic session handling to restrict pages based on user roles (`Patient` or `Staff`).
* **Appointment Management:** Staff and patients can book, view, and manage appointments linked dynamically with doctors and medical records.
* **Doctor Directory:** Integrated doctor listings showing specializations and details.
* **Modern UI/UX:** Clean and responsive interface styled with custom CSS and glassmorphism design elements.

## 🛠️ Tech Stack

* **Frontend:** HTML5, CSS3
* **Backend:** PHP (PHP Data Objects / Prepared Statements for security)
* **Database:** MySQL
* **Server Environment:** XAMPP (Apache & MySQL)

## 📁 Database Schema (`hmss_db`)

The application runs on a relational database containing the following core tables:
* `Patient` (Stores patient credentials and details)
* `Staff` (Manages staff/admin profiles and credentials)
* `Doctors` (Maintains doctor profiles and specializations)
* `Appointments` (Tracks appointment dates, times, status, and foreign keys for Patient, Doctor, and Staff)

## ⚙️ How to Run Locally

1. **Download and Install XAMPP:**
   * If you don't have XAMPP installed, download it from the official Apache Friends website (`https://www.apachefriends.org/`).
   * Install it on your system with support for Apache and MySQL.
2. **Setup Local Server:**
   * Move the project files into a folder named dbproject and then move that folder into your XAMPP htdocs directory (e.g., C:/xampp/htdocs/).
   * Open the XAMPP Control Panel and click Start next to both Apache and MySQL.
3. **Configure Database:**
   * Open your browser and go to `http://localhost/phpmyadmin`.
   * Create a new database named `hmss_db`.
   * Open the provided `.rtf` file from the project files, copy all the SQL queries inside it.
   * In phpMyAdmin, click on your `hmss_db` database, go to the **SQL** tab at the top, paste the queries into the box, and click **Go**.
4. **Run the Application:**
   * Open a new browser tab and navigate to:
   * Plaintext
   * http://localhost/dbproject
## 📸 Screenshots
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 17 56 AM" src="https://github.com/user-attachments/assets/7bd53578-1bda-465f-a19b-857ae9b2f4d4" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 18 10 AM" src="https://github.com/user-attachments/assets/8b767fb6-e729-4348-ac2b-c775568be33b" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 20 08 AM" src="https://github.com/user-attachments/assets/5a6def1a-ee2e-44e8-80df-1593ee4278c2" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 20 30 AM" src="https://github.com/user-attachments/assets/e5c182a9-a3b8-4ab9-97aa-1f02b6272e5a" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 18 19 AM" src="https://github.com/user-attachments/assets/784cb730-c682-4df0-a807-49d043973731" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 18 40 AM" src="https://github.com/user-attachments/assets/1d8488dd-8461-4a5a-8fd7-888a5fda0094" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 19 18 AM" src="https://github.com/user-attachments/assets/64313e15-2e1e-4c61-bc7f-2a33b42d70c7" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 19 41 AM" src="https://github.com/user-attachments/assets/38bdd2dc-ac41-4972-b85f-d46b3bc3122a" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 18 50 AM" src="https://github.com/user-attachments/assets/cf6dcfe2-d15d-4f67-8b2f-a243d7da4062" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 18 58 AM" src="https://github.com/user-attachments/assets/254ecc26-8350-4f07-87e6-cb07035bafc0" />
