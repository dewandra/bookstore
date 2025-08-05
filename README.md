# 📚 Bookstore Management System

A backend web application built with Laravel 11 to manage a bookstore's collection, allowing customers to rate books and view top-rated books and authors.

---

## 🚀 Features

1. **📖 List of Books**
   - Top 10 books by average rating (descending)
   - Filter by book title or author name
   - Choose how many items to display per page (10–100)

2. **👨‍💼 Top 10 Most Famous Authors**
   - Sorted by number of voters (only ratings > 5)

3. **⭐ Submit Book Rating**
   - Dropdown to select a book and rating (1–10)
   - After submission, redirects to book list

---

## ⚙️ Tech Stack

- PHP 8.2
- Laravel 11
- MySQL
- Bootstrap 5 (CDN)
- Select2 (for searchable dropdowns)

---

## 🧪 Requirements

- PHP ≥ 8.1
- Composer
- MySQL database

---

## 📦 Installation Guide

1. **Clone the repository**

```bash
git clone https://github.com/yourusername/bookstore.git
cd bookstore
```

2. **Install dependencies**

```bash
composer install
```

3. **Setup `.env` file**

```bash
cp .env.example .env
```

Edit the `.env` and set your database credentials:

```env
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_pass
```

4. **Generate application key**

```bash
php artisan key:generate
```

5. **Run migrations & seeders**

```bash
php artisan migrate:fresh --seed
```

⏳ This will generate:

- 1,000 authors
- 3,000 categories
- 100,000 books
- 500,000 ratings

> Seeding might take a few minutes depending on your machine.

6. **Run the development server**

```bash
php artisan serve
```

7. **Access the app**

Open in browser: [http://localhost:8000](http://localhost:8000)

---

## 📷 Screenshots

| Feature | Preview |
|--------|---------|
| Book List | ![book list](screenshots/book-list.png) |
| Top Authors | ![top authors](screenshots/top-authors.png) |
| Rating Form | ![rating form](screenshots/rate-book.png) |

---

## ⚠️ Notes

- No cache used (per test instructions)
- Database data generated with Laravel Factories and Faker
- You can search books or authors via filter
- Select2 is used for performance on large dropdowns

---

## 📬 Contact

Created by [Dewandra](https://github.com/dewandra)  
📧 dewandrarb@gmail.com