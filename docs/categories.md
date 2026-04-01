# category API Spec

## Create category API

Endpoint : POST /localhost/api/categories

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
    "category_name": "test_post"
}
```

Response Body Success:

```json
{
    "code": 201,
    "success": true,
    "message": "Category added successfully"
}
```

Response Body Error - not authenticated:

```json
{
    "code": 401,
    "success": false,
    "message": "Token is required"
}
```

```json
{
    "code": 403,
    "success": false,
    "message": "Permission denied"
}
```

## Update category API

Endpoint : PUT /localhost/api/categories/(id)

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
    "category_name": "test_put"
}
```

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Category Updated successfully"
}
```

Response Body Error - category not found:

```json
{
    "code": 404,
    "success": false,
    "message": "Category record not found"
}
```

## List category API

Endpoint : GET /localhost/api/categories

Headers :

```json
{
    "Content-Type": "application/json"
}
```

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": [
        {"id": 1, "category_name": "Cemilan"},
        {"id": 2, "category_name": "Fiksi"}
    ]
}
```

## Get category detail API

Endpoint : GET /localhost/api/categories/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": {"id": 2, "category_name": "Fiksi"}
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Category record is not found"
}
```

## Remove category API

Endpoint : DELETE /localhost/api/categories/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Category record deleted successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Category record not found"
}
```
