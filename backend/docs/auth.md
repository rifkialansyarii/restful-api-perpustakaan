# auth API Spec

## Login API

Endpoint : POST /localhost/api/login

Headers :

```json
{
  "Content-Type": "application/json"
}
```

Request Body:

```json
{
    "username": "johndoe",
    "password": "password123"
}
```

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Login successfully",
    "api_token": "..."
}
```

Response Body Error:

```json
{
    "code": 401,
    "success": false,
    "message": "Wrong username or password"
}
```
