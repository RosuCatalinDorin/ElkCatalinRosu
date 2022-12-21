FROM nginx

RUN chown -R root:root /certs
RUN chmod -R 600 /certs
