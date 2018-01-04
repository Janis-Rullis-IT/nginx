### / [nginx](./../../) / [docs](./../) / [how-to-provide-conditional-request-settings-like-timeout-or-caching](./)

-----------------------------------------------------------------------------------

# How to have multiple conditions in NGINX?

By default it has very stict constrainsts for if logical operator. One of them
is - you can not have multiple conditions inside one if. No OR, no AND, nothing.

## Workaround
One of few things that is allowed inisde `if` block is you can set a variable.
So the workaround is to concat values and check in a latter `if` block value 
that contains the results of the concatenation.

## Example
* [Require request to be made from a specific IP range and have a specific cookie](examples/require-request-to-be-made-from-a-specific-IP-range-and-have-a-specific-cookie.md)