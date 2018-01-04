### / [docs](./../) / [how-to-improve-concurrency](./)

-----------------------------------------------------------------------------------

# Do not force NGINX to do a redundant job

## Control what do you log
The less you log the faster requests will be served. Keep in mind the pain you 
will be in when you will need to get some information and the last hope are logs.

### Good place to start
* Do not log access for robots.txt, favicon, css, images, etc.
* Check [/snippets/client-cache.conf](../../snippets/client-cache.conf) for examples.

## Control what you do compress
It will cost CPU resources and time to compress something that has no benefit
of being compressed like really small files or already compresses ones.

### Good place to start
* Disable gzip in the `nginx.conf` to avoid compressing something You don't want
in a site you didn't ask.

 * ` gzip off;`
* Include [/snippets/gzip.conf](../../snippets/gzip.conf) in your site's conf.
* Set min size of a file to compress to be 10 K (by default it is 20 B).

## Smaller wait time
Less timeouts, faster next connection can be handled.

### Variables
* `keepalive_timeout`
* `fastcgi_read_timeout`
* `proxy_connect_timeout`
* `proxy_send_timeout`
* `proxy_read_timeout`
* `send_timeout`