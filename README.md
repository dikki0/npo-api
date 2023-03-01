# npo-api

## setup
Prerequisite: Docker
Start Docker instances using

`cd npo-api`

`./vendor/bin/sail up`

Note: it takes a while to setup all dependencies.

## database migrations
From the docker console: 

`docker exec -it [name local docker instance for Sail] /bin/bash`

This opens an ssh to the Sail Docker instance, to run the migrations. 

`php artisan migrate`

## use
Post to 

`localhost/api/v1/stream_events`

with file in multipart, under 'file'. 
