### / [nginx](.../) / [docs](.)

-----------------------------------------------------------------------------------

# How to test NGINX?

## Load test
* Use [Apache Bench (ab)](https://httpd.apache.org/docs/2.4/programs/ab.html)

`ab -c 40 -n 50000 http://159.203.93.149/`

## Debug
```
location /token {
    error_page 419 = @debug;
    return 419;
}

location @debug {
     add_header X-Fastcgi-Cache $upstream_cache_status always;
        add_header X-debug-message "$uri $args $request_uri" always;
        default_type application/json;
        return 200 ' {
            "request_uri": "$request_uri", "uri": "$uri", "args": "$args",
            "request_header": "$http_language"
        }
        ';
}
```