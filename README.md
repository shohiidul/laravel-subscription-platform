
# Simple subscription platform
## Only RESTful APIs using PHP (Laravel) & MySQL

A simple subscription platform(only RESTful APIs with MySQL) in which 
users can subscribe to a website (there can be multiple websites in the system). 
Whenever a new post is published on a particular website, all it's subscribers will receive an email with the post title and description in it using email queue.



## Features

- Create Post & Show Post
- Added new post detail to email job to send subscribed email
- Subscribe usins email address
- Verify subscription email address
- Send email to subscribe user after each new post.


## Installation & Runs Locally

- Install the project from github by cloning from git repository.
- To run this project you will need minimum PHP-8.2, mysql-8. 
- Also you will need Supervisord to run & complete the job queue. 
- For job queue I used mysql database table.

Go to your project dir.
```bash
  cd project-dir
```
Install & run npm to load css, js & other library
    
```bash
  npm install
  npm run dev
```
Install PHP library by running composer 
```bash
  composer install
```
Run laravel migration & DB seed
```bash
  php artisan migrate
  php artisan db:seed
```
Set your env config values, database credential, localhos url etc. 

Run below command to clear all laravel cache, view, routes & regenerate.
```bash
  php artisan key:generate
  php artisan optimize:clear
  php artisan optimize
```
Run the project to view on browser
```bash
  php artisan serve
```
## Important Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`TIMEZONE`

`MAIL_FROM_ADDRESS`

`MAIL_FROM_NAME`

`JOB_SUBSCRIBER_SEND_EMAIL_LIMIT`

`QUEUE_CONNECTION`



## API Reference

#### Show Post

```http
  GET /api/posts/show/${id}/post
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `integer` | **Required**. Post ID |

#### CReate Post

```http
  POST /api/posts/create
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `title`      | `string` | **Required**. Title of the post |
| `body`     | `string` | **Required**. Text bosy of the post |


```http
  GET /api/subscribe
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required** & **Unique**. User email address |


```http
  GET /api/subscribe/verify-email/key/${secure_string}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `secure_string`      | `string` | **Required**. Random secure string to verify user email address |

### Send job queue command to run with `Supervisord`
- Run this below command on terminal to test
- Also set this below commad on `Supervisord` to send email autometically every time. To set it please check documentation of `Supervisord` 
```bash
php artisan subscription-email:dispatch
```
### Postman Collection
Sample postman collection is added on `postman-collection` folder

## License

[MIT](https://choosealicense.com/licenses/mit/)

