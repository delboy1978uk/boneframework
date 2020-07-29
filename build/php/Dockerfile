FROM delboy1978uk/php74:1.1.5
#COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./xdebug.ini /usr/local/etc/php/conf.d/
COPY ./ssmtp.conf /etc/ssmtp/ssmtp.conf

RUN usermod -a -G staff www-data
RUN echo "export PATH=$PATH:bin:vendor/bin" > /root/.bashrc
RUN touch /var/www/error_log
RUN ln -sf /dev/stderr /var/www/error_log

