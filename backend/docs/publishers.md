# publishers API Spec

## Create Publishers API

Endpoint : POST /localhost/api/publishers

Headers :

```json
{
  "Content-Type": "application/json"
}
```

Request Body:

```json
{
    "publisher_name":"Test Publisher",
    "address" : "Test Publisher Address"
}
```

Response Body Success:

```json
{
    "code": 201,
    "success": true,
    "message": "Publisher added successfully"
}
```
## Update Publishers API

Endpoint : PATCH /localhost/api/publishers/(id)

Request Body (set one or more fields):

```json
{   
    "publisher_name" : "Test Publisher (edited)",
    "address":"Test Publisher Adress (edited)"
}z
```

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Category Updated successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Publisher record not found"
}
```

## List publishers API

Endpoint : GET /localhost/api/publishers

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": [
        {
            "uuid": null,
            "publisher_name": "Lentera Dipantara",
            "address": "Jakarta"
        },
        {
            "uuid": null,
            "publisher_name": "Bentang Pustaka",
            "address": "Yogyakarta"
        },
        {
            "uuid": null,
            "publisher_name": "Pearson Education",
            "address": "New York"
        }
    ]
}
```

## Get publishers detail API

Endpoint : GET /localhost/api/publishers/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "data": {
        "publisher_name": "Lentera Dipantara",
        "address": "Jakarta"
    }
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Publisher record is not found"
}
```

## Remove publishers API

Endpoint : DELETE /localhost/api/publishers/(id)

Response Body Success:

```json
{
    "code": 200,
    "success": true,
    "message": "Publisher record deleted successfully"
}
```

Response Body Error:

```json
{
    "code": 404,
    "success": false,
    "message": "Publisher record not found"
}
```
