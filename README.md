# About this project
Simple Laravel application that provides a form to collect information.

## Installation

### Prerequisites
To use this project you need
- [PHP](https://www.php.net/) v8.1 or newer
- [Composer](https://getcomposer.org/) newest version recommended
- [Node.js](https://nodejs.org/en) LTS or newer

### Step-by-step guide
Follow the steps below to use the project on your local computer:

1. Install composer dependencies
    ```
    composer install
    ```

2. Install Node.js dependencies
    ```
    npm install
    ```

3. Set an application key
    ```
    php artisan key:generate
    ```

4. Configure your .env file
    1. Copy .env.example to .env
    2. Add a valid MySql connection (Database)
    3. Add a valid SMTP connection (E-Mail)

5. Execute Database Migrations and Seeders
    1. Migrations
    ```
    php artisan migrate
    ```

    2. Seeder
    ```
    php artisan db:seed
    ```

6. Start your local development server. You will require at least two terminals.
    1. Navigate to the project's root directory.
    2. Start the server
        1. Terminal 1:
        ```
        php artisan serve
        ```
        2. Termial 2:
        ```
        npm run dev
        ```

## How to extend
To add your own questions please see the TODO comments in
- resources/views/forms/students.blade.php
- resources/views/forms/teachers.blade.php
- database/migrations/2023_07_21_180941_create_questions_table.php

## Deployment
To deploy this application to a webserver follow the steps below:

1. Download the latest release from GitHub or use your modified version

    1. If you modified the code, run
    ```
    npm run build
    ```

2. Upload the release to the webserver of your choice

3. Install composer dependencies
    ```
    composer install --optimize-autoloader --no-dev
    ```

3. Set an application key
    ```
    php artisan key:generate
    ```

4. Configure your .env file
    1. Copy .env.example to .env
    2. Add a valid MySql connection (Database)
    3. Add a valid SMTP connection (E-Mail)

5. Execute Database Migrations and Seeders
    1. Migrations
    ```
    php artisan migrate
    ```

    2. Seeder
    ```
    php artisan db:seed
    ```

6. Point your webserver to the `public/index.php` file

## License
Copyright 2023 Simon Schmieder (contact@schmieders.dev)

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.