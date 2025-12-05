# Doctor RSE App

A modern healthcare appointment booking system with a focus on sustainability and eco-friendly practices. This application connects patients with healthcare providers while tracking and rewarding environmentally conscious choices.

## Features

- 🏥 **Doctor Management**: Browse and search for healthcare providers
- 📅 **Appointment Booking**: Schedule appointments with doctors (in-person or remote)
- 🌱 **Sustainability Tracking**: Monitor CO₂ savings and RSE (Responsabilité Sociétale des Entreprises) scores
- 📊 **Dashboard**: Professional dashboard with statistics and recent activity
- 👤 **User Profiles**: Manage user information and preferences
- 🎯 **RSE Scoring**: Track eco-friendly bookings and local business support

## Tech Stack

- **Backend**: Laravel 10
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL/MariaDB
- **Build Tool**: Vite

## Requirements

See [requirements.txt](requirements.txt) for detailed requirements.

### Minimum Requirements
- PHP >= 8.1
- Composer
- Node.js >= 16.0
- MySQL >= 5.7 or MariaDB >= 10.3

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/oussamaouragini/Doctor-RSE.git
cd Doctor-RSE
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node Dependencies
```bash
npm install
```

### 4. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Database
Edit `.env` file and set your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=doctor_rse_app
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Migrations and Seeders
```bash
php artisan migrate
php artisan db:seed
```

### 7. Build Frontend Assets
```bash
npm run build
# Or for development:
npm run dev
```

### 8. Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Default Login Credentials

After seeding the database, you can login with:
- **Email**: test@example.com
- **Password**: password

## Project Structure

```
doctor-rse-app/
├── app/
│   ├── Http/Controllers/    # Application controllers
│   ├── Models/              # Eloquent models
│   └── View/Components/     # Blade components
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   └── web.php             # Web routes
└── public/                 # Public assets
```

## Key Features Implementation

### Appointments
- Book appointments with doctors
- Choose between in-person or remote consultations
- Remote appointments automatically track CO₂ savings

### Sustainability Dashboard
- View CO₂ savings over time
- Track eco-friendly bookings
- Monitor RSE score progression
- View sustainability logs

### Doctor Profiles
- View doctor information and specialties
- See RSE features (eco-friendly, local business, accessible)
- Check RSE scores

## Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

### Building Assets
```bash
# Development
npm run dev

# Production
npm run build
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author

Developed with ❤️ for sustainable healthcare.
