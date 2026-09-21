# CloudAuth - Laravel & AWS Cognito Integration

A secure, cloud-based authentication system built with Laravel 11 and AWS Cognito. This project demonstrates enterprise-grade user management, OAuth2 integration, and secure session handling using the AWS Hosted UI.

## Features
- **AWS Cognito Integration**: Secure OAuth2 Authorization Code flow.
- **Hosted UI**: Utilizes AWS Cognito's built-in, secure login and registration pages.
- **Session Management**: Secure Laravel session handling linked to AWS identity tokens.
- **Modern UI**: Clean, minimal Tailwind CSS frontend with success toast notifications.
- **LAMP Stack Ready**: Fully compatible with AWS EC2 deployment on an Ubuntu LAMP stack.

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/CloudAuth.git
   cd CloudAuth
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   Copy `.env.example` to `.env` and configure your database and AWS Cognito settings:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Add your Cognito credentials to `.env`:
   ```env
   AWS_REGION=us-east-1
   COGNITO_USER_POOL_ID=your_pool_id
   COGNITO_CLIENT_ID=your_client_id
   COGNITO_CLIENT_SECRET=your_client_secret
   COGNITO_DOMAIN=your-domain.auth.us-east-1.amazoncognito.com
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Start the Development Server**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## Technologies Used
- PHP 8.x
- Laravel 11
- AWS Cognito
- Tailwind CSS
- SQLite / MySQL

## License
Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
