FROM php:7.3-fpm

# 本番環境であることを示す環境変数
ENV CURRENT_ENVIRONMENT=production
ENV CAKEPHP_DEBUG=0

# 鍵の環境変数（AWS上での操作による設定に切り替える可能性）
ENV DEV_KEY=HOGEhogeHOGEhogeHOGEhogeHOGEhoge

# MySQL用の環境変数
ENV MYSQL_DATABASE=docker_db
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_USER=docker_db_user
ENV MYSQL_PASSWORD=docker_db_user_pass
ENV TZ=Asia/Tokyo

# composerをインストールする
RUN curl -sS https://getcomposer.org/installer | php -- --version=1.10.15 && mv composer.phar /usr/local/bin/composer

# Node.jsをダウンロードする
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -

# パッケージをインストールする
RUN apt-get update \
  && apt-get install -y git zip unzip \
  && apt-get install -y sudo \
  && apt-get install -y vim \
  && apt-get install -y nodejs \
  && apt-get install -y libicu-dev \
  && docker-php-ext-install pdo_mysql intl mbstring

# 作業ディレクトリを変更する
WORKDIR /var/www/html/mycakeapp

ADD html/ /var/www/html
ADD docker/php/php.ini /var/www/docker/php/php.ini
# composerのインストールを行う
RUN composer install
