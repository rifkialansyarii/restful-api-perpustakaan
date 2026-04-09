# book API Spec

## Create book API

Endpoint : POST /localhost/api/books

Headers :

```json
{
  "Content-Type": "application/json",
  "Authorization": "Bearer <JWT_TOKEN>"
}
```

Request Body:

```json
{
    "isbn": "9786020318639",
    "title": "Bumi Manusia",
    "publisher_name": "PT Gramedia",
    "publication_year": 1980,
    "stock": 15,
    "authors": ["Pramoedya Ananta Toer"],
    "categories": ["Fiksi"]
}
```

Response Body Success:

```json
{
    "code": 201,
    "success": true,
    "message": "Book added successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Publisher not found"
}
```

```json
{
    "code": 404,
    "success": false,
    "message": "Author with name '...' not found"
}
```

## Update book API

Endpoint : PATCH /localhost/api/books/(id)

Request Body (set one or more fields):

```json
{
    "title": "Bumi Manusia II",
    "stock": 20,
    "authors": ["Ahmad Fuadi"],
    "categories": ["Non-Fiksi"]
}
```

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Book Updated successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Book record not found"
}
```

## List book API

Endpoint : GET /localhost/api/books

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": [
        {
            "isbn": "9786020318639",
            "title": "Bumi Manusia",
            "authors": [{"author_name":"Pramoedya Ananta Toer"}],
            "categories": [{"category_name":"Fiksi"}],
            "publisher": "PT Gramedia",
            "publication_year": 1980,
            "stock": 15
        }
    ]
}
```

## Get book detail API

Endpoint : GET /localhost/api/books/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": {
        "isbn": "9786020318639",
        "title": "Bumi Manusia",
        "authors": [{"author_name":"Pramoedya Ananta Toer"}],
        "categories": [{"category_name":"Fiksi"}],
        "publisher": "PT Gramedia",
        "publication_year": 1980,
        "stock": 15
    }
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Book record is not found"
}
```

## Remove book API

Endpoint : DELETE /localhost/api/books/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Book record deleted successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Book record not found"
}
```
