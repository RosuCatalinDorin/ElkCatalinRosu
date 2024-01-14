# Deployment Steps

## Build Docker Image

It's important to increase the image tag before building the image.

```bash
$ docker build -t catared/node-build-nginx-app:0.4 .
```

# Push Image to Docker Hub

It's important to increase the image version before pushing it to Docker Hub.
```bash
$ docker push catared/node-build-nginx-app:0.4
```

If you want to use `docker-compose-swarm.yml`, make sure to change the image tag in the nginx service.

# Deploy App
If you want to use docker-compose-swarm.yml, make sure to change the image tag in the nginx service. Then, deploy the application using the following command:

```bash
$ docker stack deploy -c docker-compose-swarm.yml web_app
```