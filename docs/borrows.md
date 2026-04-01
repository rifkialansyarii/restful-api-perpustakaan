# borrow API Spec

## Create borrow API

Endpoint : POST /localhost/api/borrows

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
    "nisn": "0012345678",
    "isbn": "9786020318639",
    "status": "borrowed"
}
```

Response Body Success:

```json
{
    "code": 201,
    "success": true,
    "message": "Book borrowed successfully"
}
```

Response Body Error - user not found:

```json
{
    "code": 404,
    "success": false,
    "message": "User not found"
}
```

Response Body Error - book not found:

```json
{
    "code": 404,
    "success": false,
    "message": "Book not found"
}
```

Response Body Error - already borrowed:

```json
{
    "code": 400,
    "success": false,
    "message": "Book is already borrowed"
}
```

## Update borrow API

Endpoint : PUT /localhost/api/borrows/(id)

Request Body:

```json
{
    "status": "returned"
}
```

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Book returned successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Borrow record not found"
}
```

## List borrow API

Endpoint : GET /localhost/api/borrows

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": [
        {
            "borrow_code": "PJ-20260401-001",
            "student": "John Doe",
            "student_nisn": "0012345678",
            "book_title": "Bumi Manusia",
            "book_isbn": "9786020318639",
            "borrow_date": "2026-04-01",
            "due_date": "2026-04-08",
            "return_date": null,
            "status": "borrowed"
        }
    ]
}
```

## Get borrow detail API

Endpoint : GET /localhost/api/borrows/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": {
        "borrow_code": "PJ-20260401-001",
        "student": "John Doe",
        "student_nisn": "0012345678",
        "book_title": "Bumi Manusia",
        "book_isbn": "9786020318639",
        "borrow_date": "2026-04-01",
        "due_date": "2026-04-08",
        "return_date": null,
        "status": "borrowed"
    }
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Borrow record is not found"
}
```

## Remove borrow API

Endpoint : DELETE /localhost/api/borrows/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Borrow record deleted successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Borrow record not found"
}
```
