[![Build Status](https://secure.travis-ci.org/nickel715/munin-push-api.png?branch=master)](http://travis-ci.org/nickel715/munin-push-api)

# munin push api

munin cron run every */5 minute, the data push may send 2-3 minutes earlier.

## redis

hashes like `category label value`

hash expire after 5 min

## server

### push

script that receive the http requerst with data

### get

return value from redis if exists

## client

client send requests to push server in the following format

### get param

`category` contains category name

### data:

    label value
    label value
    ....
