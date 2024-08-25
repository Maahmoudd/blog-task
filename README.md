# Mini Blog Post API

## Table of Contents

- [Introduction](#introduction)
- [Database Schema](#database-schema)
- [API Endpoints](#api-endpoints)
    - [1. Authenticate User](#1-authenticate-user)
    - [2. Posts CRUD](#2-posts-crud)
    - [3. Comments](#3-comments)

## Introduction

This project offers a suite of APIs designed to manage a small-scale blog.

## Database Schema

### Entities and Attributes

- `users`: id, name, email, password
- `posts`: id, content, user_id
- `comments` : id, content, user_id, post_id

## API Endpoints

## Path Table

| Method | Path                  | Description        |
|--------|-----------------------|--------------------|
| POST   | /api/register         | Register User      |
| POST   | /api/login            | Login User         |


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
