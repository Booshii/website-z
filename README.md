# Website-Z

This project was an attempt to create a lightweight PHP website for my mother-in-law's vacation apartments.
In addition to displaying the individual vacation apartments, there is also a calendar showing the days that are booked. There is also a dashboard with a login to edit these calendar entries.
The project focuses on clean architecture, security, and framework-independent structure.

## Features
+ Custom PHP router (GET/POST routes with auth flags)
+ Session-based login system with CSRF validation
+ Dashboard with dynamic data rendering
+ Repository pattern for database operations
+ .env configuration support
+ Debug mode with error logging

## Structure
```bash
/public        – Entry point (index.php)
/src
  /core        – Router, Auth, CSRF, Session
  /views       – HTML/PHP views
  /templates   – Layouts & partials
.env           – Environment configuration
```
## Requirements
+ PHP 8+
+ MySQL/MariaDB
+ Apache/Nginx recommended

## getting started
1. Clone repository
2. Create a .env file
3. Start local server

   
## License

[MIT](https://choosealicense.com/licenses/mit/)
