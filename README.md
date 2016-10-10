# ETA API
[![Build Status](https://travis-ci.org/sadovnik/eta-api.svg?branch=master)](https://travis-ci.org/sadovnik/eta-api)
[![Code Climate](https://codeclimate.com/github/sadovnik/eta-api/badges/gpa.svg)](https://codeclimate.com/github/sadovnik/eta-api)
[![Test Coverage](https://codeclimate.com/github/sadovnik/eta-api/badges/coverage.svg)](https://codeclimate.com/github/sadovnik/eta-api/coverage)
[![Issue Count](https://codeclimate.com/github/sadovnik/eta-api/badges/issue_count.svg)](https://codeclimate.com/github/sadovnik/eta-api)

A simple web service for calculus of estimated time of arrival (ETA).

## Install
Vagrant and Ansible ~2.1 are required.

```
git clone https://github.com/sadovnik/eta-api sadovnik-eta-api
cd sadovnik-eta-api
vagrant up
```

The service will be available on `192.168.33.99`.

## Fixtures
Car fixture is located at `app/fixtures/car.json`. To apply it, run `make fixture`:
```
vagrant ssh
cd /vagrant
make fixture
```

## Examples
Success example:
```
curl "http://192.168.33.99/eta?lat=55.757766&lon=37.595824"; echo
```

```
{"eta":12}
```

Error example:

```
curl -i "http://192.168.33.99/eta?lat=55.757766"; echo
```
```
HTTP/1.1 422 Unprocessable Entity
Server: nginx/1.4.6 (Ubuntu)
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
Cache-Control: no-cache
Date: Mon, 10 Oct 2016 06:04:37 GMT

{"error":"Lat and lon parameters are required"}
```
