# 🚀 Student Progress and Goal Tracking System

To help students track their learning journey, set goals, document progress, and receive
teacher support. Teachers monitor student performance, offer feedback, and guide learning.
Admins manage users and class structures.

---

## 📦 Tech Stack

- 🧱 Laravel (v12)
- 🔐 Laravel Sanctum – Authentication & SPA token
- 🌥️ Cloudinary – Image & video storage
- 🔥 Firebase – Real-time database
- 🧰 PHP + Composer – Backend development & package management
- 🗃️ MySQL – Database
- 🛠️ RESTful API – Data exchange with frontend


## 📁 Project Structure

```bash
app/
├── Http/
│   ├── Controllers/        # Handle incoming requests
│   ├── Requests/           # request validation
│   ├── Resources/          # API response formatting (JSON)
│   ├── Middleware/
│   └── Filters/            # Query filters based on request
│
├── Services/               # Business logic layer and external services
│
├── Repositories/           # Data access layer (interacts with models)
│   ├── Contracts/          # Interfaces for repositories
│
├── Models/                 # Eloquent models
│
├── Traits/                 # API response helpers
│
├── Policies/               # Authorization logic

routes/
├── api.php                 # API routes (for Laravel Sanctum, etc.)

database/
├── migrations/

```


## 🛠️ Installation

```bash
# Clone the repository
git clone https://github.com/TaiVo1905/spagts-be.git
cd spagts-be

# Install dependencies
composer install

# build .env file
cp .env.example .env

#Generate key
php artisan key:generate

# Start development server
php artisan serve
```
