### / [nginx](./../../) / [docs](./../) / [how-to-provide-conditional-request-settings-like-timeout-or-caching](./)

-----------------------------------------------------------------------------------

# How to provide conditional request settings like timeout or caching?

## For example for a plain HTML page

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

## For a site which URL does not match exactly with the file structure 
Like for PHP every request goes through index.php.

If that's the case then see:
* [Working conditional requests for PHP](/examples/php-cache/README.md).
* [Why conditional requests are harder to implement for PHP?](docs/how-to-provide-conditional-request-settings-like-timeout-or-caching/why-conditional-requests-are-hard-for-php.md).