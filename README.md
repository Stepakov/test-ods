# Laravel Posts API

REST API для роботи з posts на Laravel 10.

---

## ⚙️ Вимоги

* PHP >= 8.1
* Composer
* MySQL

---

## 🚀 Встановлення

```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo

composer install

cp .env.example .env
php artisan key:generate
```

---

## 🛠 Налаштування БД

В файлі `.env` вкажіть параметри бази даних:

```env
DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## 📦 Міграції

```bash
php artisan migrate
```

---

## ▶️ Запуск сервера

```bash
php artisan serve
```

API буде доступний за адресою:

```
http://127.0.0.1:8000/api
```

---

# 📚 API Документація

---

## 🟢 1. Створення публікації

**Method:** POST
**URL:** `/api/posts`

### Body:

```json
{
  "title": "Test post",
  "content": "This is test content",
  "is_published": true
}
```

### Response:

```json
{
    "data": {
        "id": 1,
        "title": "Test post",
        "content": "This is test content",
        "is_published": 1,
        "published_at": "2026-03-18T09:17:01.000000Z"
    }
}
```

---

## 🔵 2. Отримання списку

**Method:** GET
**URL:** `/api/posts`

### Response:

```json
{
  "data": [
      {
          "id": 1,
          "title": "Test post",
          "content": "This is test content",
          "is_published": 1,
          "published_at": "2026-03-18T09:17:01.000000Z"
      }
  ]
}
```

---

## 🟡 3. Отримання однієї публікації

**Method:** GET
**URL:** `/api/posts/{id}`

### Response:

```json
{
  "data": {
      "id": 1,
      "title": "Test post",
      "content": "This is test content",
      "is_published": 1,
      "published_at": "2026-03-18T09:17:01.000000Z"
  }
}
```

---

## 🟠 4. Оновлення публікації

**Method:** PUT
**URL:** `/api/posts/{id}`

### Body:

```json
{
  "title": "Updated title",
  "is_published": true
}
```

### Response:

```json
{
  "data": {
      "id": 19,
      "title": "Updated title",
      "content": "This is test content",
      "is_published": 1,
      "published_at": "2026-03-18T09:17:01.000000Z"
  }
}
```

---

## 🔴 5. Видалення публікації

**Method:** DELETE
**URL:** `/api/posts/{id}`

### Response:

```json
{
  "message": "Post deleted successfully"
}
```

---

# 🧠 Особливості

* Slug генерується автоматично з title. Можливо його теж треба повертати у Response
* Якщо `is_published = true` і `published_at` не задано — встановлюється поточна дата
* Валідація реалізована через FormRequest в окремих класах
* Відповіді формуються через API Resources. Зробив лише один спільний
* Логіку не виносив у сервіси
* Не робив фабрики
* Використав касти для published_at
* Не робив вивод постів постранично
* Не робив фільтрацію постів (виводити тільки пости із паблішт)

---
