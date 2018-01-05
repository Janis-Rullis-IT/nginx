---
title: How to speed up nginx connection handling?
layout: default
---

### / [nginx](./../../) / [docs](./../) / [how-to-improve-concurrency](./)

-----------------------------------------------------------------------------------

# How to speed up nginx connection handling?

## Adjust the count of Workers - maybe you can have more workers that can handle requests

### Variables
* worker_processes.

### Calculation
1 worker per CPU. Better to use 'auto' - NGINX will do the same
in your place. No worries it won't do it on every request but just once when
changes are compiled.

## Open request count
The main bottleneck of handling request is the open file limit. If the limti
is reached then 500 error will just be thrown. You can try it by setting these
limits to a very small count and then just make more requests than the count.

### Variables
* `worker_rlimit_nofile`
* `worker_connections`

### Calculation
#### File system's Hard limit
* `ulimit -Hn; # 65536`

#### File system's Soft limit
* `ulimit -Sn; # 1024`

### Required action

#### Set the soft limit same as the hard
`ulimit -n 65536`.

#### Set NGINX variables to the hard limit's value.

 ```
 worker_rlimit_nofile 65536;
 worker_connections 65536;
 ```

## Cache meta data like paths
Keep track of every requested files for 2 minutes max while expiring resources
after 1 minute.

### Variables
* `open_file_cache max=500 inactive=20m;`
* `open_file_cache_valid 20m;`

### Variables
* `keepalive_timeout`
* `fastcgi_read_timeout`
* `proxy_connect_timeout`
* `proxy_send_timeout`
* `proxy_read_timeout`
* `send_timeout`

## Use HTTP2 A.K.A. H2
HTTP by default has a really small concurrent request limit. So H2 fixes this.
This example explains it:
* [H2 VS HTTP](../h2.md#h2-vs-http)
