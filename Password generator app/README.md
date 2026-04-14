Project Report
SecurePass: A Web-Based Password Generator
1. Title Page
•	Project Title: SecurePass - A Web-Based Password Generator
•	Student's Name: Mehak Kausar
•	Student's Registration Number: SP22-BSE-044
•	Department: Computer Science
•	Institution: Comsats University Islamabad, Vehari Campus
•	Date: 19-12-2024
2. Abstract
SecurePass is a user-friendly web application designed to help users generate secure and customizable passwords. Built with Laravel, HTML, CSS, JavaScript, and SQLITE, the application provides users with tools to set password length, include or exclude specific character types, and view password strength. It also securely stores generated passwords for future use. The project aims to enhance password security awareness and make the process of creating strong passwords effortless and accessible to everyone.
3. Introduction
Background
Passwords play a critical role in securing personal and online accounts. Despite this, many individuals rely on weak or repetitive passwords, making their accounts vulnerable to cyberattacks. SecurePass addresses this issue by offering an easy-to-use tool for generating secure passwords tailored to individual needs.
Problem Statement
Existing password tools are often either too complex for non-technical users or lack customization options. This project aims to provide a simple, effective, and user-friendly solution to generate strong, customizable passwords while educating users on the importance of password security.
Objectives
•	Create a tool for generating strong, customizable passwords.
•	Offer a real-time password strength indicator.
•	Provide secure storage for generated passwords.
•	Educate users about good password practices.
Significance
This tool reduces the risk of online account breaches by helping users create better passwords and fostering awareness about password security.
4. Features of SecurePass
Password Customization:
•	Users can set the password length (8-128 characters).
•	Options to include or exclude:
o	Uppercase letters
o	Numbers
o	Symbols
Password Strength Indicator:
•	Real-time feedback on password strength (Weak, Moderate, Strong).
User-Friendly Interface:
•	Clean and responsive design compatible with all devices.
Backend Logic:
•	Passwords are generated securely and stored in a SQLITE database for future use.
Secure Data Management:
•	Integration of CSRF tokens to protect against malicious requests.
•	Data validation to ensure robust security.
5. System Design
Architecture
•	Frontend: HTML, CSS, JavaScript, Bootstrap, and jQuery.
•	Backend: Laravel (PHP Framework).
•	Database: SQLITE for securely storing passwords and user data.
Database Schema
•	Table Name: passwords
o	id (Primary Key) - Auto-increment integer.
o	generated_password - Stores the generated password.
o	strength - Stores the strength level of the password.
o	created_at - Timestamp of password creation.
6. Tools and Technologies
Frontend:
•	HTML: For structuring the web application.
•	CSS: For styling the interface.
•	JavaScript and jQuery: For dynamic functionality and AJAX calls.
•	Bootstrap: For responsive design.
Backend:
•	Laravel: For handling server-side logic and routing.
•	PHP: Core language for backend operations.
•	SQLITE: For database management.
Development Tools:
•	Visual Studio Code: For writing and managing code.
•	GitHub: For version control.
•	Composer: For managing Laravel dependencies.
•	XAMPP/WAMP: For running a local development server and database.
7. Routes and Functionalities
Routes:
•	GET / - Displays the password generator form.
•	POST /generate - Generates a password based on user input and stores it in the database.
•	GET /showPasswords - Fetches and displays all saved passwords.
•	POST /deletePasswords - Deletes selected passwords from the database.
Functionalities:
1.	Generate Password:
o	Accepts user preferences (length, character types) via a form.
o	Generates a password based on preferences and calculates its strength.
o	Saves the password and strength in the database.
2.	Display Saved Passwords:
o	Retrieves passwords from the database and displays them dynamically.
3.	Delete Passwords:
o	Allows users to select and delete specific passwords from the database.
4.	Real-Time Strength Feedback:
o	Displays password strength as "Weak," "Moderate," or "Strong" during generation.
8. Implementation Details
Frontend Implementation:
•	Password Form:
o	HTML form with input fields for length, checkboxes for character types, and a submit button.
•	Styling:
o	Background and container styling using CSS and Bootstrap.
Backend Implementation:
•	Laravel Controllers:
o	PasswordController handles password generation, saving, fetching, and deleting.
•	Database Integration:
o	SQLITE database stores generated passwords and their strengths.
Security:
•	CSRF Protection: Ensures all POST requests are verified with a CSRF token.
•	Data Validation: Ensures inputs meet required criteria before processing.
9. Expected Outcomes
•	A fully functional password generator with customizable features.
•	Secure storage of generated passwords.
•	Real-time password strength feedback.
•	A responsive and user-friendly web application.
10. Conclusion
SecurePass addresses a critical need for improved password security by offering an easy-to-use and customizable tool. By integrating robust security features and providing real-time feedback, this application empowers users to protect their online accounts effectively. The project serves as a foundation for future enhancements, such as multi-user accounts or advanced security tips.
