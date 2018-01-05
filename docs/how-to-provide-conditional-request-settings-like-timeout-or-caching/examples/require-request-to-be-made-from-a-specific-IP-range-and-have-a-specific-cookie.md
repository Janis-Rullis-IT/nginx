---
title: Require request to be made from a specific IP range and have a specific cookie
layout: default
---

### / [nginx](./../../../) / [docs](./../../) / [how-to-provide-conditional-request-settings-like-timeout-or-caching](./../) / [examples](./)

-----------------------------------------------------------------------------------

# Require request to be made from a specific IP range and have a specific cookie

All others will be redirected to the authorization page.

```
    set $allow '';

    if ($remote_addr !~ "(127.0.0.1|192.168.1.)" ){

   	 set $allow "${allow}n";
    }

    if ($cookie_apiauth = ''){

   	 set $allow "${allow}o";
    }

    if ($allow = 'no'){

   	 rewrite ^ http://auth.api.local?from=$http_host;
    }    

```