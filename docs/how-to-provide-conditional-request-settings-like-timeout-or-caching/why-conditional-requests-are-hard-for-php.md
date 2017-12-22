# Why conditional requests are harder to implement for PHP?
By conditional requests here I mean specific settings for specific requests.
For example, caching for `/results` or longer timeouts for `/export`.

## Usually this should not be that hard
Just create a specific location block and add the specific settings.

### For example for a plain HTML page

```
# Regular stuff.
location / {
    ...
}
# Long requests.
location ~ (batch.html|export.html|import.html|csv.html|excel.html|pdf.html) {
    add_header My-Long-Timeout true always;
    include snippets/long_requests.conf;
}
```
In the browser You go to '/batch.html' and the NGINX will apply these settings
and return the the file from the file system.

## Where's the catch for the PHP?
The pretty URL like `/results` does not match exactly with the PHP file that needs 
to be executed -`index.php`. That's why we need to execute it manually like
this:
```
 # First try files like CSS, JS, images else redirect to PHP.
location / {
    try_files $uri $uri/ /index.php?$args;
}

# All PHP requests.
location ~ \index.php$ {
    include snippets/fastcgi-php.conf;
}
```

### Why this is a problem?
Now try to add conditions here. What would you do? 

#### 1) Simply just add an `if` block and put the required content there, right? 
Like this?
```
# All PHP requests.
location ~ \index.php$ {
    if ($request_uri ~ (batch|results|export|import|csv|excel|pdf) ) {
        add_header My-Long-Timeout true always;
        include snippets/long_requests.conf;
    }
    include snippets/fastcgi-php.conf;
}
```
Sorry, this won't work because NGINX allows only `return`, `rewrite` and `set` 
actions and nothing else.

### Fine, then I'll just rewrite to @block
...

### return to @block
Will work.

### Execute index.php without a redirect
Won't work. `try_files` is the only way to **internally, without a redirect**
call a file that is not the same as the URL.

#### What's wrong with the redirect here?
The original pretty URL will be lost because it will be re-written with the
redirect's URL which now is `index.php`. Which means:
* Pretty URL in the address bar `/results` will be replaced with `index.php`.
* PHP won't be able to recognize the request and will throw an error. 

### Okay, do the redirect to index.php but check location from the new URI
* PHP will be executed because of the redirect to index.php.
* `If` block won't be necessary because we will use supported methods like `location`
block and just ask it to read the new URL from `request_uri`.

Won't work, because [location only checks `request_url`](/docs/nginx-constraints/contraints-of-nginx-location-block.md#checks-only-request_url-value) which now is `index.php`.

## SOLUTION
If the problem is that files does not match URL then make them match. Duplicate 
`index.php` to `index_long_request.php`. This will allow to divide location 
blocks and now you can add a specific location block with specific settings.

### Example
```
# First try files like CSS, JS, images else redirect to PHP.
location / {
    try_files $uri $uri/ /index.php?$args;
}
location ~ \index.php$ {
    internal;
    include snippets/fastcgi-php.conf;
}

# Long requests.
location ~ (batch|export|import|csv|excel|pdf) {
    try_files $uri /index_long_request.php?$args;
}
location ~ \index_long_request.php$ {
    internal;
    include snippets/long_requests.conf;
    include snippets/fastcgi-php.conf;
}
```