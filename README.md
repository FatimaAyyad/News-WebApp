# News-WebApp

## Overview
News-WebApp is a PHP and MySQL based web application for managing news content.
It allows users to register, log in, and manage news items categorized by type,
with support for image uploads and a responsive user interface.

The project is fully containerized using Docker to ensure easy setup and
consistent runtime behavior across different environments.

## Features
- User registration and authentication
- Add, edit, and soft-delete news items
- Categorize news by type
- Upload and display images
- Responsive and clean user interface

## Tech Stack
- PHP 8.2
- MySQL 8
- Apache
- Docker
- Docker Compose

## Running the Project with Docker

### 1. Clone the repository
    ```bash
    git clone https://github.com/FatimaAyyad/News-WebApp.git
    cd News-WebApp

### 2.  Build and start containers
    docker-compose up --build -d
3. Access the application
    Open your browser and visit:
    http://localhost:8080
4. Stop the containers
    docker-compose down
### Testing the Application
    Create a new user account or log in

    Add, edit, and view news items

    Upload images and verify they appear in the interface

    Docker Notes
    MySQL database is automatically initialized using an SQL script

    A healthcheck endpoint is available at /health.php

    Multi-stage Docker build is used to reduce image size

### Attribution
This project was designed and implemented by Fatima Ayyad as part of an
Operating Systems Lab assignment.