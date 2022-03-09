FROM phpdockerio/php:8.1-fpm
ENV PROJECT_DIR /application
WORKDIR $PROJECT_DIR
ENV PATH $PROJECT_DIR/bin:$PROJECT_DIR/vendor/bin:$PATH

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        php8.1-xdebug; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
