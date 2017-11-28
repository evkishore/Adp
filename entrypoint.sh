#!/bin/bash
set +x
 
unset http_proxy 
unset https_proxy
if [ -d /opt/app/ng_conf ] ; then
   rm -rf /opt/app/ng_conf;
fi
 
if [ -d /opt/app/env_conf ] ; then
   rm -rf /opt/app/env_conf;
fi
 
/usr/bin/git clone -b $RELEASE_VERSION $CONFIG_HOST/cmadmin/wfncf-config.git /opt/app/ng_conf
/usr/bin/git clone -b $RELEASE_VERSION $CONFIG_HOST/cmadmin/wfnconf-env-config.git /opt/app/env_conf
 
if [ $? -ne 0 ] ; then
   echo "Config Server is down! Unable to start container"
   exit 1;
else
   if [ -d /opt/app/ng_conf ] && [ -d /opt/app/env_conf ] ; then
                                chmod -R 755 /opt/app/ng_conf/
                                chmod -R 755 /opt/app/env_conf/
                                #find /mnt/app/log4j2/ -name "*.hprof" -exec rm -f {} \;
                                java $JAVA_OPTS -jar /opt/app/ei9-sb.jar $APP_OPTS 2>&1
   else
                                echo "Config Server is down! Config folders are missing!"
                                exit 1;
   fi
fi
