<p align="center"><a href="#" target="_blank"><img src="https://iili.io/wgpUTg.png" width="400"></a></p>


## About {Q & A} Rest API

{Q & A} is a application for people can make question to other people and answer to the question, feature :

- Authentication with JWT [ Json web token ]
- This application use laravel v9  
- User can't post question if not have a token
- User can't answer question if not have a token
- User can't comment on answer if not have a token
- User can make much post question
- This application have good security !

This Project For My Portofolio backend with Laravel !

## Database Design
<p align="center"><a href="#" target="_blank"><img src="https://i.ibb.co/kMKCcTH/database-design.png" ></a></p>

## Scheme User In This Application
<p align="center"><a href="#" target="_blank"><img src="https://i.ibb.co/0CgcC6s/scheme-user-in-this-web.png" ></a></p>

## Test API with postman
1. Register
   <b>POST</b>
```
http://<server>/api/user/register
```

Request Body
```
{
     "name": "test1",
     "username": "test1",
     "email": "test@gmail.com",
     "password": "password",
     "password_confirmation: "password"
}
```

Response (Status: 201)
```
{
    "status": true,
    "message": "success register user",
    "code": 201,
    "user": {
        "name": "test",
        "username": "test",
        "email": "test@gmail.com",
        "updated_at": "21 July 2022 15:20",
        "created_at": "21 July 2022 15:20",
        "id": 1
    }
}
```
2. Login
   <b>POST</b>
```
http://<server>/api/user/login
```

Request Body
```
{
     "email": "test@gmail.com",
     "password": "password",
}
```

Response (Status: 200)
```
{
    "success": true,
    "message": "Success login",
    "code": "200",
    "user": {
        "id": 1,
        "name": "test",
        "username": "test",
        "email": "test@gmail.com",
        "email_verified_at": null,
        "created_at": "21 July 2022 15:20",
        "updated_at": "21 July 2022 15:20"
    },
    token : "<yourtoken>"
}    
```
3. Logout
   <b>GET</b>
```
http://<server>/api/user/logout
```

Header
```
Bearer <yourtoken>
```

Response (Status: 200)
```
{
    "status": true,
    "message": "succes logout",
    "code": 200
}
```   
4. User
   <b>GET</b>
```
http://<server>/api/user
```

Header
```
Bearer <yourtoken>
```

Response (Status: 200)
```
{
    "id": 1,
    "name": "test",
    "username": "test",
    "email": "test@gmail.com",
    "email_verified_at": null,
    "updated_at": "21 July 2022 15:20",
    "created_at": "21 July 2022 15:20"
}
```   
5. Edit User
   <b>PUT</b>
```
http://<server>/api/user/{username}/update/{id}
```

Header
```
Bearer <yourtoken>
```

Request Body
```
{
     "name": "test@gmail.com",
     "password": "password",
     "password_confirmation": "password"
}
```

Response (Status: 200)
```
{
     "status": true,
     "message": "success update user",
     "code" => 200,
}
```

6. Delete user
   <b>DELETE</b>
```
http://<server>/api/user/{username}/delete/{id}
```

Header
```
Bearer <yourtoken>
```

Response (Status: 200)
```
{
     "status": true,
     "message": "user success deleted",
     "code" => 200,
}
```

7. Create Question
   <b>POST</b>
```
http://<server>/api/user/{username}/question
```

Header
```
Bearer <yourtoken>
```

Request Body
```
{
     "title": "this title",
     "tags": "title",
     "description": "this description"
}
```

Response (Status: 201)
```
{
    "status": true,
    "message": "success create question",
    "code": 201,
    "question": {
        "user_name": "test",
        "title": "this-title",
        "tags": "title",
        "description": "this description",
        "updated_at": "21 July 2022 17:02",
        "created_at": "21 July 2022 17:02",
        "id": 1
    }
}
```
8. Edit Question
   <b>PUT</b>
```
http://<server>/api/user/{username}/edit/question/{id}
```

Header
```
Bearer <yourtoken>
```

Request Body
```
{
     "title": "this title",
     "tags": "title",
     "description": "this description"
}
```

Response (Status: 200)
```
{
    "status": true,
    "message": "success update question",
    "code": 200,
    "question": 1
}
```

9. Delete Question
   <b>DELETE</b>
```
http://<server>/api/user/{username}/delete/question/{id}
```

Header
```
Bearer <yourtoken>
```

Response (Status: 200)
```
{
     "status": true,
     "message": "success delete question",
     "code" => 200,
}
```

10. Page Question
    <b>GET</b>
```
http://<server>/api/question/all?page=1
```

Response (Status: 200)
```
{
    "status": true,
    "message": "List Data Question",
    "code": 200,
    "question": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "user_name": "testing",
                "title": "this-title",
                "tags": "title",
                "description": "this description",
                "created_at": "21 July 2022 17:02",
                "updated_at": "21 July 2022 17:02"
            }
        ],
        "first_page_url": "http://<server>/api/question/all?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://<server>/api/question/all?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://<server>/api/question/all?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://<server>/api/question/all",
        "per_page": 5,
        "prev_page_url": null,
        "to": 1,
        "total": 1
    }
}
```
11. Detail Question
    <b>GET</b>
```
http://<server>/api/question/{id}/{title}
```

Response (Status: 200)
```
{
    "status": true,
    "message": "success get data",
    "code": 200,
    "question": [
        {
            "id": 1,
            "user_name": "testing",
            "title": "this-title",
            "tags": "title",
            "description": "this description",
            "username_answer": testing,
            "answer": test,
            "username_comment": testing,
            "comment": test
        }
    ]
}
```

12. Answer Question
    <b>POST</b>
```
http://<server>/api/question/{id}/answer/{username}
```

Header
```
Bearer <yourtoken>
```

Request Body
```
{
     "answer": "test"
}
```

Response (Status: 201)
```
{
    "status": true,
    "message": "success create answer",
    "code": 201,
    "answer": {
        "username_answer": "testing",
        "answer": "test",
        "question_id": 1,
        "updated_at": "21 July 2022 17:15",
        "created_at": "21 July 2022 17:15",
        "id": 1
    }
}
```

13. Edit Answer Question
    <b>PUT</b>
```
http://<server>/api/question/edit/{username}/answer/{id}
```

Header
```
Bearer <yourtoken>
```

Request Body
```
{
     "answer": "test"
}
```

Response (Status: 200)
```
{
     "status" => true,
     "message": "success update answer",
     "code": 200,
}
```
    
14. Delete Answer Question
    <b>DELETE</b>
```
http://<server>/api/question/delete/{username}/answer/{id}
```

Header
```
Bearer <yourtoken>
```

Response (Status: 200)
```
{
     "status": true,
     "message": "success delete answer",
     "code" => 200,
}
```
    
15. Comment On Answer
    <b>POST</b>
```
http://<server>/api/question/{id}/answer/{id_answer}/comment/{username}
```

Header
```
Bearer <yourtoken>
```

Request Body
```
{
     "comment": "test"
}
```

Response (Status: 201)
```
{
    "status": true,
    "message": "success create comment",
    "code": 201,
    "comment": {
        "username_comment": "testing",
        "comment": "test",
        "question_id": 1,
        "answer_id": 1,
        "updated_at": "21 July 2022 17:20",
        "created_at": "21 July 2022 17:20",
        "id": 1
    }
}
```

16. Edit Comment On Answer
    <b>PUT</b>
```
http://<server>/api/question/edit/{username}/comment/{id}
```

Header
```
Bearer <yourtoken>
```

Request Body
```
{
     "comment": "test"
}
```

Response (Status: 200)
```
{
     "status" => true,
     "message": "success update comment",
     "code": 200,
}
```

17. Delete Comment On Answer
    <b>DELETE</b>
```
http://<server>/api/question/delete/{username}/comment/{id}
```

Header
```
Bearer <yourtoken>
```

Response (Status: 200)
```
{
     "status": true,
     "message": "success delete comment",
     "code" => 200,
}
```

   

## Security Vulnerabilities

If you discover a security vulnerability within {Q & A} application, please send an e-mail to ifqygazhar via [foolm402@gmail.com](mailto:foolm402@gmail.com). All security vulnerabilities will be promptly addressed.
