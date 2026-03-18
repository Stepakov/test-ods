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
git clone git@github.com:Stepakov/test-ods.git
cd test-ods

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

### Body:

```json
{
    "page": 1,
    "per_page": 2
}
```

### Response:

```json
{
    "data": [
        {
            "id": 1,
            "title": "new content2",
            "content": "fdas",
            "is_published": 1,
            "published_at": "2026-03-18T08:33:46.000000Z"
        },
        {
            "id": 4,
            "title": "asdfasd",
            "content": "fdas",
            "is_published": 1,
            "published_at": null
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/posts?page=1",
        "last": "http://127.0.0.1:8000/api/posts?page=4",
        "prev": null,
        "next": "http://127.0.0.1:8000/api/posts?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 4,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/posts?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/posts?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/posts?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/posts?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/posts?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/posts",
        "per_page": 2,
        "to": 2,
        "total": 7
    }
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

* Slug генерується автоматично з title
* Якщо `is_published = true` і `published_at` не задано — встановлюється поточна дата
* Валідація реалізована через FormRequest в окремих класах
* Відповіді формуються через API Resources. Зробив лише один спільний
* Логіку винніс у сервіси
* Не робив фабрики
* Використав касти для published_at
* Вивод постів постранично
* Фільтрація постів по властивості is_published
* Не робив окремо адмінку та окремо публічну частину

---
