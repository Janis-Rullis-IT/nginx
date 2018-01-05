---
title: Constraints of NGINX `if` block
layout: default
---

### / [nginx](./../../) / [docs](./../) / [nginx-constraints](./)

-----------------------------------------------------------------------------------

# Constraints of NGINX `if` block

## `If` is EVIL
* [Orginal article why NGINX has these constraints](https://www.nginx.com/resources/wiki/start/topics/depth/ifisevil/).
As they mention:

## The only 100% safe things which may be done inside if in a location context are:
>>return ...;
>>rewrite ... last;

and set variables value - like `set $allow "${allow}n";`

## Other constraints 
* No if inside if.
* Allowed in specific scopes server, location.

## No multiple operators
* No OR, no AND, nothing.
* [Workaround](how-to-have-multiple-conditions-in-nginx.md)

## Why should you need to use `if` even if it is considered evil?
* Because of other NGINX constraints like ones for 
* [location](contraints-of-nginx-location-block.md) or 
* [redirect](contraints-of-nginx-redirect.md).