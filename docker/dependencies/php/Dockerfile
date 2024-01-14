FROM php:8.2-alpine

LABEL maintainer="Catalin rosu <catared.dev@gmail.com>"

ENV WORKDIR "var/www/html"

# Add timezone
RUN ln -s /usr/share/zoneinfo/UTC /etc/localtime && \
    "date"

# Install composer
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer


RUN mkdir -p ${WORKDIR}

WORKDIR ${WORKDIR}

EXPOSE 9000

CMD ["php-fpm"]