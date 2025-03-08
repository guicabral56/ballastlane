FROM guicabral56/php81 as base

EXPOSE 80
WORKDIR /application

COPY ./phpdocker/nginx/nginx.conf /etc/nginx/http.d/default.conf
COPY ./phpdocker/php-fpm/php-ini-overrides.ini /usr/local/etc/php/conf.d/99-overrides.ini
COPY ./phpdocker/supervisor/supervisor.conf /etc/supervisord.conf

RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www    

COPY . /application/
RUN composer update --optimize-autoloader

RUN chown -R www:www /application/storage /application/bootstrap/cache /var/lib/nginx /var/log/nginx /var/run/nginx
RUN chmod -R 775 /application/storage /application/bootstrap/cache

RUN mkdir -p /application/storage/logs && chown -R www:www /application/storage/logs && chmod -R 775 /application/storage/logs

USER www
CMD ["supervisord","-n", "-c", "/etc/supervisord.conf"]
