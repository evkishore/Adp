FROM dtr.md.docker.com/wfn/java-base:latest
 
ENV APP_OPTS ""
ENV JAVA_OPTS ""
 
COPY myapp.jar /opt/app/myapp.jar
 
WORKDIR /opt/app
 
COPY ./entrypoint.sh /opt/app
 
ENTRYPOINT ["/opt/app/entrypoint.sh"]
