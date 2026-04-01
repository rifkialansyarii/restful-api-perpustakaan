# user API Spec

## Create user API

Endpoint : POST /localhost/api/users

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
    "first_name": "John",
    "last_name": "Doe",
    "username": "johndoe",
    "password": "password123",
    "whatsapp_number": "081234567890",
    "role": "student"
}
```

Response Body Success:

```json
{
    "code": 201,
    "success": true,
    "message": "User added successfully"
}
```

## Update user API

Endpoint : PUT /localhost/api/users/(id)

Request Body:

```json
{
    "first_name": "Jane"
}
```

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "User Updated successfully"
}
```

Response Body Error - not found:

```json
{
    "code": 404,
    "success": false,
    "message": "User record not found"
}
```

Response Body Error - role collision:

```json
{
    "code": 403,
    "success": false,
    "message": "Cannot update because role is collision"
}
```

## List user API

Endpoint : GET /localhost/api/users

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": [
      {"id": 1, "username": "johndoe"}
    ]
}
```

## Get user detail API

Endpoint : GET /localhost/api/users/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": {
      "id": 1,
      "username": "johndoe"
    }
}
```

## Remove user API

Endpoint : DELETE /localhost/api/users/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "User record deleted successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "User record not found"
}
```
