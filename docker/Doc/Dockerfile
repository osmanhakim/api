FROM mysql:5.7
RUN apt-get update && apt-get install -y ca-certificates --no-install-recommends 
COPY store.sql /docker-entrypoint-initdb.d/