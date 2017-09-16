FROM alpine:edge

COPY ./src /app/src
COPY ./bin /app/bin
COPY ./composer.json /app/composer.json
COPY ./composer.lock /app/composer.lock

WORKDIR /app

RUN echo "http://dl-4.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \
    apk update && \
    apk add php7 && \
    echo "Install composer" && \
    apk add --virtual .composer-deps curl php7-json php7-phar php7-iconv php7-openssl php7-zlib && \
    curl -s https://getcomposer.org/installer | php > /dev/null && \
    mv composer.phar /usr/local/bin/composer && \
    echo "Install package dependencies" && \
    composer install --ignore-platform-reqs --no-dev --optimize-autoloader && \
    apk del .composer-deps && \
    echo "Install php extensions" && \
    rm -rf .git .hg && \
    apk add {{ alpinePackages | join(' ') }} && \
    echo "Cleanup" && \
    rm -rf /var/cache/apk/*

WORKDIR /work

CMD ["/app/{{ binName }}"]