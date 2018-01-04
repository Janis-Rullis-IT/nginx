### / [nginx](./../../) / [docs](./../) / [nginx-constraints](./)

-----------------------------------------------------------------------------------

# Constraints of NGINX location block

## Checks only `request_url` value. 
This is bad if URL does not match the file path and you need a check by
`request_uri`. [See the use case here](../how-to-provide-conditional-request-settings-like-timeout-or-caching/why-conditional-requests-are-hard-for-php.md).

## Ignores query part of the URL like `?lang=`
Forbids you to use more precise location blocks like `/results?v=1`. Sure You 
can use `if` block inside it but [it has it's own drawbacks](../nginx-constraints/contraints-of-nginx-if-block.md).
