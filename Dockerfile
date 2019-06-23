FROM php:alpine


RUN mkdir /app
# Copy semua source code ke directory /app dalam docker container
ADD . /app
# Semacam cd (pindah directory) ke /app
WORKDIR /app

RUN composer install
RUN php http://0.0.0.0:8080/ci-rest/api/consume
EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080"]