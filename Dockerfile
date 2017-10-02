FROM alpine:edge

COPY ./src /app/src
COPY ./bin /app/bin
COPY ./composer.json /app/composer.json
COPY ./composer.lock /app/composer.lock

WORKDIR /app

RUN echo "http://dl-4.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \
    apk update && \
    apk add --no-cache php7 tini ca-certificates && \
    echo ">>> Install composer" && \
    apk add --no-cache --virtual .composer-deps wget php7-json php7-phar php7-iconv php7-openssl php7-zlib && \
    wget https://raw.githubusercontent.com/composer/getcomposer.org/1b137f8bf6db3e79a38a5bc45324414a6b1f9df2/web/installer -O - -q | php -- --quiet && \
    echo ">>> Run composer" && \
    php ./composer.phar install --ignore-platform-reqs --no-dev --optimize-autoloader && \
    echo ">>> Remove composer" && \    
    apk del .composer-deps && \    
    rm ./composer.phar && \
    echo ">>> Install php extensions" && \    
    apk add --no-cache php7-json php7-ctype && \
    echo ">>> System cleanup" && \
    rm -rf .git .hg && \
    rm -rf /var/cache/apk/*

WORKDIR /work

ENTRYPOINT ["/sbin/tini", "-g", "--", "/app/bin/composer2docker"]