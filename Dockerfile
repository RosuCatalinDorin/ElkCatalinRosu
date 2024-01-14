FROM nginx:alpine
# Install Nano
RUN apk update && apk add nano

LABEL maintainer="Catalin Rosu <catared.dev@gmail.com >"

WORKDIR /var/www/html/

COPY docker/nginx/site.conf /etc/nginx/conf.d/default.conf
COPY ./api /var/www/html/api
COPY ./app/build/* /var/www/html/app/build/
RUN cd /var/www/html
RUN cd /var/www/html
RUN mkdir "cache"
RUN chmod -R 777 /var/www/html/api/var

EXPOSE 8443