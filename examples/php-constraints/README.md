# Playground for testing conditional requests in PHP

* The test page will be located in http://php-constraints.local .
* Download this repo.
* Add permissions to this folder.
* `sudo chmod a+rwX /var/www/nginx/ -R`
* Open the `hosts` file.
`sudo nano /etc/hosts`;
* Add a new record in the hosts file.
`127.0.0.1       php-constraints.local`
* Define the 1 hour cache in the nginx.conf which most probably is located in /etc/nginx/nginx.conf.
`fastcgi_cache_path /tmp/cache_1h levels=1:2 keys_zone=cache_1h:100m max_size=100m inactive=1h;`
* Add [`php-constraints.conf`](/examples/php-constraints/php-constraints.conf) NGINX vhost file to your NGINX enabled sites (`sites-enabled`).
I would use Midnight Commander (`mc` command) and create a symlink.
* Restart NGINX;
`sudo systemctl restart nginx`
* Open the http://php-constraints.local
'INDEX' should appear.
* Open http://php-constraints.local/static-text which does not have a matching
file in this directory. Will display 'Static'.