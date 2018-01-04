### / [nginx](./../) / [docs](./)

-----------------------------------------------------------------------------------

# Client cache headers explained / Expired vs Pragma vs Cache-Control

Client cache is being considered the client's brower's cache that stores files
like CSS, Javascript based on 'Etag' header received from the server.

## Resources
* [https://www.sitepoint.com/solve-caching-conundrums/](https://www.sitepoint.com/solve-caching-conundrums/)

## [Expired t](http://nginx.org/en/docs/http/ngx_http_headers_module.html#expires)
IMO works like shorthand for 'Cache-control: public  max-age=t'.

## Pragma
* [Difference between pragma and cache-control](https://stackoverflow.com/questions/10314174/difference-between-pragma-and-cache-control-headers)

Pragma public is same as Cache-Control: public just for IE older browsers. 
Pragma is the HTTP/1.0 implementation and cache-control is the HTTP/1.1 implementation of the same concept.

## Pragma / Cache-control values

#### private
Indicates that the response is intended for a single user and must not be stored by a shared cache. A private cache may store the response.

#### no-cache
Forces caches to submit the request to the origin server for validation before releasing a cached copy.
only-if-cached
Indicates to not retrieve new data. The client only wishes to obtain a cached response, and should not contact the origin-server to see if a newer copy exists.

#### must-revalidate
The cache must verify the status of the stale resources before using it and expired ones should not be used.

#### proxy-revalidate
Same as must-revalidate, but it only applies to shared caches (e.g., proxies) and is ignored by a private cache.
