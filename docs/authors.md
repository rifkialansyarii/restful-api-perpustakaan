# author API Spec

## Create author API

Endpoint : POST /localhost/api/authors

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
    "name": "test_author"
}
```

Response Body Success:

```json
{
    "code": 201,
    "success": true,
    "message": "Author added successfully"
}
```

## Update author API

Endpoint : PUT /localhost/api/authors/(id)

Request Body:

```json
{
    "name": "test_put"
}
```

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Author Updated successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Author record not found"
}
```

## List author API

Endpoint : GET /localhost/api/authors

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": [
      {"id": 1, "name": "Author A"},
      {"id": 2, "name": "Author B"}
    ]
}
```

## Get author detail API

Endpoint : GET /localhost/api/authors/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": {"id": 2, "name": "Author B"}
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Author record is not found"
}
```

## Remove author API

Endpoint : DELETE /localhost/api/authors/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Author record deleted successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Author record not found"
}
```
