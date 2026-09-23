# hospital_appointment_scheduling_system
# 🏥 Hospital Appointment Scheduling System (HASS)

A dynamic, database-driven, web-page built to streamline hospital operations — patient records, staff account, doctor management, and appointment scheduling efficiently— all in one place.

## 🚀 Features

* **Secure Authentication:** Separate email and password login systems for both Patients and Staff.
* **Role-Based Access Control:** Session-based access restricting pages so only logged-in Staff/Patients can perform actions meant for their role.
* **Patient Registration:** Patients can create accounts with details like name, age, gender, and contact info.
* **Staff Registration:** Staff members can register with role/position and contact details.
* **Doctor Management:** Staff can add new doctors directly from the dashboard — each doctor is automatically linked to the staff member who registered them and assigned an available hospital room.
* **Appointment Booking:** Book, view, and manage appointments by selecting a patient, doctor, date, and time.
* **Doctor Directory:** A live, database-driven doctor listing showing specialization, contact details, and assigned room — updates automatically as new doctors are added.
* **Modern UI/UX:** Clean, responsive interface styled with custom CSS and glassmorphism design elements.

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
## Developed as part of computer science academic projects.
## 📸 Screenshots
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 17 56 AM" src="https://github.com/user-attachments/assets/7bd53578-1bda-465f-a19b-857ae9b2f4d4" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 12 23 AM" src="https://github.com/user-attachments/assets/af53f912-f5e6-466a-8aa4-dcacff151251" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 12 30 AM" src="https://github.com/user-attachments/assets/c8be48b5-4dc4-42b7-b08c-08ec2c5ba910" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 13 15 AM" src="https://github.com/user-attachments/assets/47640474-124c-436b-b642-f3553c8db39c" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 12 23 AM" src="https://github.com/user-attachments/assets/7655e9ca-3ac4-4fb0-b2e2-e0d9d1bd5b83" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 20 08 AM" src="https://github.com/user-attachments/assets/5a6def1a-ee2e-44e8-80df-1593ee4278c2" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 20 30 AM" src="https://github.com/user-attachments/assets/e5c182a9-a3b8-4ab9-97aa-1f02b6272e5a" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 17 56 AM" src="https://github.com/user-attachments/assets/2837a91b-4a05-470f-a124-ceef76f23857" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 11 24 AM" src="https://github.com/user-attachments/assets/7f768f9c-81b8-4bf6-9826-8fbb632fe7bd" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 11 34 AM" src="https://github.com/user-attachments/assets/d1b8d33b-a8b5-4874-8316-69de0a8cd510" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 12 12 AM" src="https://github.com/user-attachments/assets/6e6dae22-fcdb-415d-8c17-0dda65b17d10" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 11 24 AM" src="https://github.com/user-attachments/assets/9d6e9c63-7cae-4c32-a3cd-aac87bbcda17" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 18 40 AM" src="https://github.com/user-attachments/assets/c6931fda-d45b-4412-885c-a98c6e22c984" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 19 18 AM" src="https://github.com/user-attachments/assets/c4de9da2-f35c-49b3-9e11-fef0fb0be3ca" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 19 41 AM" src="https://github.com/user-attachments/assets/0c60d019-7ffe-4cea-acf0-86fb9c253023" />
<img width="1404" height="753" alt="Screenshot 2026-09-22 at 3 18 50 AM" src="https://github.com/user-attachments/assets/944feefd-3f6d-4cb7-9fe6-bd371617eda2" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 10 27 AM" src="https://github.com/user-attachments/assets/412a9f12-701d-4f55-ae96-f968e7e7448d" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 10 35 AM" src="https://github.com/user-attachments/assets/9b543349-2871-4cde-904f-40ed25d869d3" />
<img width="1404" height="753" alt="Screenshot 2026-09-24 at 1 11 06 AM" src="https://github.com/user-attachments/assets/7edd92f4-bb3a-4004-8b31-344153448f34" />
