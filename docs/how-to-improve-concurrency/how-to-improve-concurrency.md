# How to improve concurrency?

## Intro
By default NGINX is configured to be safe for most use cases which means
that many of settings are set lower just to be safe. At the end of my research
I observed that some settings are downgraded quite a lot which gives us a 
great space for improvements and benefits from them.

## So what is responsible for concurrency?
* Connection workers - further will be called just Workers.
* Opened request file count limit.

## What can be improved?
* [Speed-up NGINX connection handling](how-to-speed-up-nginx-connection-handling.md)
* [Get rid of lags](do-not-force-nginx-to-do-redundant-taks.md)
