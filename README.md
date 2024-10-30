# Cookie Consent Translation Issue

To start up locally.

Fill in the .env and .docker.env (mysql root password)

In the .env the main things needed are database and docker port.

Then:

    docker compose build

and

    docker compose up

after that you should be able to visit:

    http://localhost:$DOCKER_PORT