# 🚗 Car Rental Website

This is a **Car Rental Management System** developed using **PHP**, **HTML**, **CSS**, and **MySQL**, and it runs on the **WAMP server**. The project allows users to view luxury cars, register or log in, and make bookings online. Admins can manage car listings and bookings through the admin panel.

---

## 💻 Technologies Used

- **Frontend**: HTML, CSS  
- **Backend**: PHP  
- **Database**: MySQL  
- **Local Server**: WAMP (Windows Apache MySQL PHP)

---

## 📁 Project Structure

The main files and folders in this project include:

- `index.php` – Homepage  
- `about.php` – About Us page  
- `gallery.php` – Car gallery  
- `variations.php` – Different car options  
- `specials-model.php` – Featured car model  
- `contact.php` – Contact form  
- `onrent.php` – Cars available for rent  
- `login.php` – User login  
- `register.php` – User registration  
- `confirm-booking.php` – Booking confirmation  
- `payment.php` – Payment page with bill generation  
- `connect.php` – Database connection file  
- `/admin/` – Admin panel (includes login, dashboard, add car functionality)  
- `/images/` – Car and UI images  
- `/css/` – Stylesheets  

---

## 🧾 Key Features

- User Registration and Login  
- Admin Panel with login authentication  
- Add/view cars from Admin dashboard  
- Book car and confirm booking  
- Payment form with bill generator  
- Responsive layout and clean UI  
- All data stored securely in MySQL database  

---

## 🛠️ How to Run (on WAMP Server)

1. Download and install **WAMP Server**.
2. Copy the project folder to `C:/wamp64/www/` directory.
3. Start WAMP server and ensure Apache & MySQL are running.
4. Open browser and go to: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
5. Create a new database named `carhub`.
6. Import your project’s SQL file into this database.
7. Open `connect.php` and set your DB credentials:
   ```php
   $conn = mysqli_connect("localhost", "root", "", "Primecarhub");
