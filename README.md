# Mail Automation App 📧

This Laravel application automates sending order confirmation emails to customers.  
It reads PDFs and order IDs from decorator emails, fetches order details from Shopify, generates HTML previews, and sends them to customers.

---

## 🚀 Features
- Fetch PDF & Order ID from emails.
- Retrieve order details from Shopify.
- Combine PDF & order details into HTML.
- Send HTML preview link to customer.
- Track order processing in a UI.

---

## 🛠️ Requirements
- PHP 8.2+
- Composer
- Laravel 11
- MySQL
- Shopify API credentials
- Email account credentials (IMAP/SMTP)

---

## 📦 Installation
1. git clone https://github.com/rajkumarynot/mockup-automation.git
2. cd mail_automation
3. composer install
4. Copy .env.example to .env
5. Set up database, mail, and Shopify API keys.
6. Create Storage folder in public folder
7. Create public and pdfs folder in storage/app folder
8. php artisan storage:link
9. php artisan migrate
10. php artisan serve
11. php artisan read:emails

