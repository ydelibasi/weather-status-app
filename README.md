# weather-status-app

Weather Status service API using Phalcon Framework

### Installation
- Clone the project
- docker-compose up
- docker exec -i -t weather-status-app /bin/bash
- php composer.phar install
- Hit the IP address (127.0.0.1:8080) with Postman

### Usage

#### Requests
The routes available are:

| Method | Route               | Parameters                         | Action                                                   | 
|--------|---------------------|------------------------------------|----------------------------------------------------------|
| `POST` | `login`             | `email`, `password`                | Login - get Token                                        |
| `POST` | `user/register`     | `email`, `password`, `device_os`, `timezone`, `language`, `city_id`, `notify_token` | Add a user record in the database |
| `PUT`  | `user/update`       | `email`, `password`, `device_os`, `timezone`, `language`, `city_id` | Update User info |
| `POST` | `gift-code/activate`| `code`                             | Check gift code & activate free subscription          |
