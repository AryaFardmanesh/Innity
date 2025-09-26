# 🏨 Innity – Online Hotel Booking Website

**Innity** is a university project that demonstrates the design and implementation of an online hotel booking platform.  
The system allows users to browse hotels, check availability, and make reservations through a simple and intuitive interface.  

⚠️ **Note**: This project is a prototype developed for academic purposes only.  
This repository is **archived** and will not receive further updates or maintenance.

---

## 📌 Features

- 🔑 **User Authentication** – Sign up, log in, and manage user accounts.  
- 🏨 **Hotel Listings** – Browse hotels with details like description, location, and pricing.  
- 📅 **Booking System** – Reserve rooms with date selection and availability check.  
- 👤 **Admin Dashboard** – Manage hotels, rooms, bookings, and user data.  
- 🎨 **Responsive UI** – Built with [Bootstrap](https://getbootstrap.com/) for mobile-first design.  
- 🗄️ **Database Integration** – MySQL used for data storage and retrieval.  

---

## 🛠️ Tech Stack

- **Frontend**: [Bootstrap](https://getbootstrap.com/), HTML5, CSS3, JavaScript  
- **Backend**: PHP (MVC architecture)  
- **Database**: MySQL  
- **Server Architecture**: Model–View–Controller (MVC) pattern  

---

## 📂 Project Structure

```
Innity/
├── assets/                  # Project assets
│   ├── components/
│   ├── css/
│   ├── images/
│   └── libs/
├── controllers/             # Project controllers
├── dashboard/               # Dashboard page 
├── hotel/                   # Hotel page 
├── hotels/                  # Hotels page 
├── login/                   # Login page 
├── logout/                  # Logout page 
├── management/              # Management page 
├── profile/                 # Profile page 
├── reserve/                 # Reserve page 
├── signup/                  # Sign up page 
├── src/                     # Server source
│   ├── models/
│   ├── repositories/
│   ├── services/
│   ├── utils/
│   └── config.php/          # Database configuration and settings
├── database/                # SQL scripts and migrations
├── index.php/               # Home page
├── users.txt/               # User list
└── README.md                # Project documentation
````

---

## ⚙️ Setup & Installation

> ⚠️ This project is a university prototype and not intended for production use.

1. Clone this repository:
   ```bash
   git clone https://github.com/AryaFardmanesh/Innity.git
   ```

2. Set up your local server environment (e.g., XAMPP, WAMP, MAMP).

3. Import the database:

   * Import the SQL file located in `database/innity.sql`.

4. Configure database connection:

   * Update database credentials in `src/config.php`.

5. Start the development server and open the project in your browser:

   ```
   http://localhost/innity/
   ```

---

## 🎓 Academic Context

This project was developed as part of a **university course project** to demonstrate:

* Web application development using PHP.
* MVC-based server-side implementation.
* Database-driven web applications with MySQL.
* UI/UX design with Bootstrap.

---

## 🚧 Limitations

* Not optimized for production environments.
* Security measures are minimal (not suitable for handling real data).
* Functionality is limited to the scope of the academic project.

---

## 📜 License

This project is licensed under the [MIT license](./LICENSE).

---

## 📌 Repository Status

🔒 **Archived** – This repository is no longer maintained.
