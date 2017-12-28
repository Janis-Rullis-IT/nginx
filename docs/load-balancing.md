# Load balancing

## Round robin
Servers are connected in a circle. A new request goes to the next server in line. 
* Skips a server which is down.
* Does not cares about that servers load. It can be very loaded.

## Least connected
least_conn- Specifies that a group should use a load balancing method where a request is
 passed to the server with the least number of active connections, taking into account weights of servers.

## Fastest response
least_time - Server with the least average response time and least number of active connection

## IP hash
Based on IP.

## Generic hash
The server to which a request is sent is determined from a user-defined key which may be a text, variable, or their combination.

## Options
 weight=number sets the weight of the server, by default, 1.
* max_conns=number def 0
* max_fails def 1
* fail_timeout def 10s
* backup - marks the server as a backup server. It will be passed requests when the primary servers are unavailable.
* down - marks the server as permanently unavailable.

### Sticky session
* A client can be hooked to one server based on client's session. Works for all balancing types.

### Slow start
The server slow start feature prevents a recently recovered server from being overwhelmed by connections, which may timeout 
and cause the server to be marked as failed again.

```
upstream backend {
    server backend1.example.com       weight=5;
    server backend2.example.com:8080;
    server unix:/tmp/backend3;

    server backup1.example.com:8080   backup;
    server backup2.example.com:8080   backup;
}

server {
    location / {
        proxy_pass http://backend;
    }
}
```

## Resources
* [NGINX.org ngx_http_upstream_module](http://nginx.org/en/docs/http/ngx_http_upstream_module.html)
* [Scaling Web Applications with NGINX Load Balancing and Caching | Datadog](https://youtu.be/jVCYaLEBCpU?list=PLSyMwbwM_tntgUiWx_wzSQsAZmLYdASQB]
