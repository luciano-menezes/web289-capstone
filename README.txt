# README.md

## **Introduction**

This is a web site to showcase and sell my wife's handmade wood work products online.

## **Installation**

1. Make sure you have XAMPP (or a similar local server environment) installed on your computer.

2. Download the project files and place them in the appropriate directory of your local server (e.g., the "htdocs" folder in XAMPP).

3. Start XAMPP and ensure that the Apache and MySQL services are running.

4. Open your web browser and navigate to http://localhost or the specified localhost address for your XAMPP installation.

5. You should see the homepage of the website. Congratulations, the installation is complete!

**Note:** If you're using a different local server environment, adjust the instructions accordingly.

## **Usage**

#### **General User:**

- Access the website by opening the URL in your web browser.

- Explore the product listings, send us a message, and view detailed product information without the need to log in or create an account.

- Get a feel for the website's design and functionality.

#### **Registered User:**

- Create an account or log in to an existing account to unlock additional features.

- Add desired products to your cart and proceed to the checkout process.

- Track your orders and manage your account settings.

#### **Admin User:**

- Obtain admin-authorized login credentials to access the admin side of the website.

- Log in using the provided admin credentials to access exclusive features.

- Manage product inventory by adding, editing, or deleting products.

- Monitor customer orders.

## Technologies Used

- HTML: Used for creating the structure and content of the website.

- CSS: Used for styling the website and providing visual enhancements.

- Bootstrap: Utilized for responsive and mobile-friendly design components.

- PHP (procedural): Used for server-side scripting and handling backend logic.

- MySQL: Employed as the database management system for storing and retrieving data.

##### Additional Notes:

- **Payment Page:** The payment functionality on the website utilizes a PayPal sandbox for demonstration purposes only. The necessary credentials were created and provided by PayPal.

- **reCaptcha:** The login and sign-up pages incorporate **reCaptcha v2** for added security. However, this feature is only active on the web host. In the local environment, the reCaptcha portion of the code is commented out to simplify the setup process. To enable reCaptcha functionality, a separate pair of keys is required, which involves a different process. Publishing these keys on GitHub would pose safety risks, hence the exclusion from the local environment setup.

## Deployment

1. Sign up for a hosting service (e.g., Hostinger) and obtain your hosting credentials.

2. Upload the project files to your hosting account. This can typically be done through an FTP client or the hosting provider's file manager.

3. Ensure that the hosting environment meets the requirements for PHP and MySQL.

4. Set up a MySQL database on your hosting account and import the necessary tables and data.

5. Update the configuration files (if any) to connect the website to the MySQL database. Usually, this involves modifying the database connection settings to match your hosting provider's configuration.

6. If you wish to activate the **reCaptcha** feature on the login and sign-up pages:

- Uncomment the relevant sections of code in the respective PHP files.

- Obtain the site keys and secret keys for reCaptcha **v2** from the reCaptcha website.

- Insert the obtained keys into the code where specified.

7. Save the changes to the files and ensure that all files are in their correct locations on the hosting server.

8. Visit your website's URL in a web browser to access the live version of the site. Verify that all functionalities are working correctly, including the reCaptcha feature if activated.
