### / [nginx](.../) / [docs](.)

-----------------------------------------------------------------------------------

# Reverse proxy cache

This document is about caching content on the proxy server to which all intranet machines are connected to.
This allows to avoid processing already processed requests on machines. 

For example,
If a static homepage was rendered for user A then there is no need to render it again for the next user B.
Just take it from the cache.

## Resources
* [http://docs.unified-streaming.com/tutorials/caching/reverse-proxy.html](http://docs.unified-streaming.com/tutorials/caching/reverse-proxy.html)
* [https://mattbrictson.com/nginx-reverse-proxy-cache] (https://mattbrictson.com/nginx-reverse-proxy-cache)
* [http://czerasz.com/2015/03/30/nginx-caching-tutorial/](http://czerasz.com/2015/03/30/nginx-caching-tutorial/)
* [https://www.slideshare.net/ortussolutions/itb2017-nginx-effective-high-availability-content-caching] (https://www.slideshare.net/ortussolutions/itb2017-nginx-effective-high-availability-content-caching)
* [https://blog.alexellis.io/save-and-boost-with-nginx/](https://blog.alexellis.io/save-and-boost-with-nginx/)
* [https://devcenter.heroku.com/articles/increasing-application-performance-with-http-cache-headers](https://devcenter.heroku.com/articles/increasing-application-performance-with-http-cache-headers)
* [https://www.nginx.com/blog/benefits-of-microcaching-nginx/](https://www.nginx.com/blog/benefits-of-microcaching-nginx/)


```
proxy_buffering on;
  proxy_cache_path /var/cache/nginx levels=1:2 keys_zone=edge-cache:10m inactive=20m max_size=1g;
  proxy_temp_path /var/cache/nginx/tmp;
  proxy_cache_lock on;
  proxy_cache_use_stale updating;
  proxy_bind 0.0.0.0;
  proxy_cache_valid 200 302 10m;
  proxy_cache_valid 301      1h;
  proxy_cache_valid any      1m;

  upstream origin {
    server origin.unified-streaming.com:82;
    keepalive 32;
  }
```
