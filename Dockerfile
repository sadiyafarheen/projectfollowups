FROM webdevops/php-apache-dev
COPY . /app
RUN apt-get update

RUN yes | apt-get install vim
RUN apt-get update
COPY ./config/vhost.conf /opt/docker/etc/httpd/vhost.conf
COPY ./config/10-server.conf /opt/docker/etc/httpd/conf.d
RUN chmod 777 /app/runtime
RUN chmod 777 /app/assets

#RUN chmod 777 /app/assets
#Add for olx scrap => At every minute
#RUN crontab -l | { /bin/cat; /bin/echo "* * * * * /usr/bin/php /app/yii cronrunlinux/social"; } | crontab -
#Add for olx social posting => At every 5th minute
#RUN crontab -l | { /bin/cat; /bin/echo "*/5 * * * * /usr/bin/php /app/yii cronrunlinux/scrapolx"; } | crontab -
#Delete logs => At 01:00 on day-of-month 1 in February, April, June, August, October, and December.
#RUN crontab -l | { /bin/cat; /bin/echo "0 1 1 2,4,6,8,10,12 * /usr/bin/php /app/yii cronrunlinux/flushlogs"; } | crontab -
#RUN composer update -d /app
