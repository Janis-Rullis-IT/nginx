### / [nginx](.../) / [docs](.)

-----------------------------------------------------------------------------------

# How to improve security?

## Force only HTTPS
Create a separate block for 80 port and redirect it to 443.

```
# Redirect http to https.
server {
    server_name api.local;
    listen 80;
    listen [::]:80;
    return 302 https://$server_name$request_uri;
}
```

### Example
* [api.conf](../api.conf)

## Block access to specific file types
Like .conf, .ini, .lock, .git, etc.

### Example
* [/snippets/security.conf](../snippets/security.conf)

## Use `internal` keyword for internal requests
For example
```
location / {
	try_files $uri $uri/ /index.php?$args;
}
location ~ \index.php$ {
	internal;
	include snippets/fastcgi-php.conf;
}
```
Won't allow to access page using `yoursite.com/index.php` syntax.

### Example
* [api.conf](../api.conf)

