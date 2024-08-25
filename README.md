# Mini Blog Post API

## Table of Contents

- [Introduction](#introduction)
- [Database Schema](#database-schema)
- [API Endpoints](#api-endpoints)
    - [1. Authenticate User](#1-authenticate-user)
    - [2. Posts CRUD](#2-posts-crud)
    - [3. Comments](#3-comments)
- [Design Patterns](#design-patterns)
- [Bonus Features](#bonus-features)
- [Docker](#docker)
- [Authentication](#authentication)
- [Postman Collection](#postman-collection)
## Introduction

This project offers a suite of APIs designed to manage a small-scale blog.

## Database Schema

### Entities and Attributes

- `users`: id, name, email, password
- `posts`: id, content, user_id
- `comments` : id, content, user_id, post_id

## API Endpoints

## Path Table

| Method | Path                                 | Description    |
|--------|--------------------------------------|----------------|
| POST   | /api/register                        | Register User  |
| POST   | /api/login                           | Login User     |
| POST   | /api/posts                           | Create Post    |
| GET    | /api/posts                           | List Posts     |
| GET    | /api/posts/{post}                    | View Post      |
| PUT    | /api/posts/{post}                    | Update Post    |
| DELETE | /api/posts/{post}                    | Delete Post    |
| POST   | /api/posts/{post}/comments           | Create Comment |
| DELETE | /api/posts/{post}/comments/{comment} | Delete Comment |


### 1. Authenticate User

Endpoint: `/api/register`

Description: Register user

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"

**Request Body:**
```json
{
    "name": "Mahmoud Mohamed",
    "email": "mahmoud@admin.com",
    "password": "password",
    "password_confirmation": "password"
}

```

Endpoint: `/api/login`

Description: Authenticate user and generate token

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"

**Request Body:**
```json
{
    "email": "admin@admin.com",
    "password": "password"
}
```

### 2. Posts CRUD

Endpoint: `/api/posts`

Description: Create Post

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"

**Request Body:**
```json
{
    "title": "New Post",
    "content": "This is a newly created post for test purposes"
}
```

Endpoint: `/api/posts`

Description: List all the blog posts

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"

Endpoint: `/api/posts/{post}`

Description: View Single Post

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"

Endpoint: `/api/posts/{post}`

Description: Update his own post

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"

**Request Body:**
```json
{
    "title": "New Post (updated)",
    "content": "This is a newly created post for test purposes"
}
```


Endpoint: `/api/posts/{post}`

Description: Delete his own post

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"


### 3. Comments

Endpoint: `/api/posts/{post}/comments`

Description: Create Comment on post

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"

**Request Body:**
```json
{
    "content": "Here is my comment content"
}
```

Endpoint: `/api/posts/{post}/comments/{comment}`

Description: Delete his own comment

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"

## Design Patterns

- SOA Design Pattern for handling single responsibility methods
- Repository Design Pattern for handling interaction with database separated from the business logic
## Bonus Features

- **Unit Tests**: Tested the functionality of all the endpoints.

## Authentication

Authentication With Sanctum

## Postman Collection

To facilitate testing and integration, provide a Postman collection that includes sample requests for each API endpoint, along with expected responses. This will help users understand how to interact with your API.

[Link to Postman Collection](https://documenter.getpostman.com/view/36493973/2sAXjF9uxE) - Update this link once you create the collection.


- BaseUrl: your app link
- bearer_token : the token from login
- In Every Api Body have example about request


# Requirements
- PHP 8.3
- Laravel 11
- MySQL

## Getting Started


## Clone
Clone this repo to your local machine using https://github.com/Maahmoudd/blog-task.git
and run
```
git clone https://github.com/Maahmoudd/blog-task.git
cd blog-task
cp .env.example .env
composer install
composer dumpautoload
```

# Laravel sail
run  ./vendor/bin/sail up -d to setup environment by docker
```
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
```

## Run Migrations
```bash
 ./vendor/bin/sail artisan migrate --seed
 ````
## Run Test
```bash
 ./vendor/bin/sail artisan test
 ````
