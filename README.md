# Healthcare Appointment Booking API

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![Swagger](https://img.shields.io/badge/Swagger-85EA2D?style=for-the-badge&logo=swagger&logoColor=black)

A modular, production-ready Laravel 12 RESTful API for booking healthcare appointments with comprehensive authentication, validation, and business logic.

[API Documentation](#swagger-documentation) • [Quick Start](#installation) • [Docker Setup](#docker-setup) • [Testing](#testing)

</div>

---

## 🚀 Features

- Token-based Authentication with Laravel Passport
- Modular & Domain-Driven Folder Structure
- Smart Appointment Booking with Availability Check
- View & Cancel Own Appointments
- 24-Hour Cancellation Policy
- Swagger (OpenAPI) API Documentation
- Form Request Validations for data integrity
- Comprehensive Testing - Unit & Feature Tests
- Docker Support for easy deployment
- Postman Collection Included

## 📁 Project Structure

```
healthcare-appointment-booking-api/
├── app/
│   ├── Domains/
│   │   ├── Appointment/
│   │   │   ├── Controllers/
│   │   │   ├── Models/
│   │   │   ├── Requests/
│   │   │   ├── Resources/
│   │   │   ├── Services/
│   │   │   └── Repositories/
│   │   ├── Auth/
│   │   ├── User/
│   │   ├── HealthcareProfessional/
│   │   └── Common/
│   └── Http/
├── config/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── docker/
│   ├── Dockerfile
│   ├── docker-compose.yml
│   └── nginx/default.conf
├── swagger/
│   └── api-docs/swagger.json
├── tests/
│   ├── Feature/
│   └── Unit/
├── postman
├── .env
├── composer.json
└── README.md
```

## 🔧 Installation

### Prerequisites
- PHP ^8.2
- Laravel ^12.x
- MySQL 
- Composer
- Docker

### Step-by-Step Setup

**1. Clone the Repository**
```bash
git clone https://github.com/Rishabh092/healthcare-appointment-booking-api.git
cd healthcare-appointment-booking-api
```

**2. Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

**3. Install Dependencies**
```bash
composer install
```

**4. Database & Passport Setup**
```bash
php artisan migrate
php artisan passport:install
```

**5. Seed Sample Data**
```bash
php artisan db:seed
```

**6. Start Development Server**
```bash
php artisan serve
```

Your API is now running at `http://localhost:8000`

## 🐳 Docker Setup

Ensure Docker is installed and running on your system.

**Build and Run Containers**
```bash
docker-compose up -d --build
```

**Setup Database Inside Container**
```bash
docker exec -it healthcare-api-app bash
php artisan migrate --seed
```

**Access Application**
```bash
curl http://localhost:8000/api/professionals
```

## 🔐 Authentication (Laravel Passport)

| Action | Endpoint | Method | Auth Required |
|--------|----------|--------|---------------|
| Register | `/api/register` | POST | No |
| Login | `/api/login` | POST | No |
| Logout | `/api/logout` | POST | Yes |
| Profile | `/api/user/profile` | GET | Yes |

> **Note:** Use the Bearer Token in the Authorization header for protected routes.

### Authentication Examples

**Register New User**
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

**Login User**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

## 📜 API Routes Summary

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| POST | `/api/register` | No | Register a new user |
| POST | `/api/login` | No | Login and receive access token |
| GET | `/api/user/profile` | Yes | View user profile |
| GET | `/api/professionals` | Yes | List all healthcare professionals |
| POST | `/api/appointments` | Yes | Book appointment with availability checks |
| GET | `/api/appointments` | Yes | View user's appointments |
| DELETE | `/api/appointments/{id}` | Yes | Cancel appointment (24h policy check) |
| PUT | `/api/appointments/{id}/complete` | Yes | Mark appointment as completed |

## 📌 Business Logic & Rules

| Rule | Status | Description |
|------|--------|-------------|
| No Double Booking | Enforced | Prevents booking same slot & professional |
| User Isolation | Enforced | Users can only view/cancel their own appointments |
| Future Appointments | Enforced | Appointments must be scheduled in the future |
| 24h Cancellation Policy | Enforced | Cannot cancel within 24h of appointment |
| Completion Tracking | Available | Mark appointments as completed |

## 🔒 Middleware & Security

| Middleware | Purpose |
|------------|---------|
| `auth:api` | Secures authenticated routes |
| `CheckAvailability` | Prevents booking already booked slots |

## 📚 Swagger Documentation

**Access Interactive API Documentation:**
```
http://localhost:8000/api/documentation
```

Generated using `darkaonline/l5-swagger` for comprehensive API exploration and testing.

## 🧪 Testing

**Run All Tests**
```bash
php artisan test
```

**Run Tests Inside Docker**
```bash
docker exec -it healthcare-api-app php artisan test
```

### Test Coverage
- **Unit Tests:** `tests/Unit/` - Domain logic and services
- **Feature Tests:** `tests/Feature/` - API endpoints and integration

## 📬 Postman Collection

**Collection Path:** `postman/HealthcareAPI.postman_collection.json`

**Includes testable routes for:**
- Authentication
- Appointment CRUD operations
- Healthcare Professionals management

## 🗃️ Database Seeders

| Seeder Class | Description |
|--------------|-------------|
| `HealthcareProfessionalSeeder` | Seeds sample healthcare professionals |
| `AppointmentSeeder` | Seeds dummy appointment data |
| `UserSeeder`| Adds demo users for testing |

**Run Individual Seeders:**
```bash
php artisan db:seed --class=HealthcareProfessionalSeeder
php artisan db:seed --class=AppointmentSeeder
```
## ⚙️ System Requirements

- PHP ^8.2
- Laravel ^12.x
- MySQL
- Composer
- Docker (Optional)

## 👨‍💻 Author

**Rishabh Shah**

Email: shahrishabhr1992@gmail.com

---

<div align="center">

**Star this repository if you found it helpful!**

Made with Laravel & Docker

![GitHub stars](https://img.shields.io/github/stars/your-username/healthcare-api?style=social)
![GitHub forks](https://img.shields.io/github/forks/your-username/healthcare-api?style=social)

</div>
