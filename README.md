# Reat API

Rest API для получения списка товаров с фильтрацией, сортировкой и пагинацией.

--- 

## Base URL

{{ host }}/api/product

---

## End points

### Получение списка товаров

---

## Query Parameters

### Фильтрация

| Параметр      | Тип     | Описание                 | Пример    |
|---------------|---------|--------------------------|-----------|
| `title`       | string  | Поиск по названию товара | `Qui`     |
| `category_id` | integer | ID категории             | `3`       |
| `price_from`  | number  | Минимальная цена         | `1000`    |
| `price_to`    | number  | Максимальная цена        | `5000`    |
| `in_stock`    | boolean | Наличие товара           | `1` / `0` |
| `rating_from` | float   | Минимальный рейтинг      | `4.5`     |

**Важно:**  
`in_stock=0` — валидное значение и означает «товар отсутствует на складе».

---

### Сортировка

| Параметр    | Тип    | Значения                              | По умолчанию |
|-------------|--------|---------------------------------------|--------------|
| `sort`      | string | `id`, `price`, `rating`, `created_at` | `id`         |
| `direction` | string | `asc`, `desc`                         | `desc`       |

---

### Пагинация

| Параметр   | Тип     | По умолчанию |
|------------|---------|--------------|
| `page`     | integer | `1`          |
| `per_page` | integer | `20`         |

___

### Пример возвращаеммых данных

#### Успешный запрос

**HTTP 200 OK**

```json
{
    "data": [
        {
            "id": 12,
            "title": "Quinoa Bread",
            "price": 2500.50,
            "category_id": 3,
            "in_stock": false,
            "rating": 4.6
        }
    ],
    "links": {
        "first": "https://products_filter.test/api/products?page=1",
        "last": "https://products_filter.test/api/products?page=10",
        "prev": null,
        "next": "https://products_filter.test/api/products?page=2"
    },
    "meta": {
        "current_page": 1,
        "per_page": 10,
        "total": 42,
        "last_page": 5
    }
}
```

**data** - перечень найденных элементов
**links** - ссылки пагинации
**meta** - общие данные по результатам запроса с указанием текущей страницы, количества резальтатов на странице,
общего количества результатов и номера последней страницы.

---
#### Пустой запрос

**HTTP 404**

```json 
{
    "message": "Products not found"
}
```

---
Проект содержит фабрику тестовых данных. Для заполнения необходимо запустить команду artisan db:seed
