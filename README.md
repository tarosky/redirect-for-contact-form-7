# redirect-for-contact-form-7

[![Build Status](https://travis-ci.org/tarosky/redirect-for-contact-form-7.svg?branch=master)](https://travis-ci.org/tarosky/redirect-for-contact-form-7)

An add-on plugin for the Contact Form 7 which redirect to the specific URL.

## Requires

* WordPress 4.8 or later
* Contact Form 7 4.9 or later
* PHP 5.3 or later

## Usage

```
[contact-form-7 id="4" title="Contact form 1" goto="http://wp.test/archives/1"]
```

## Running automated testing

```
$ export CF7=https://downloads.wordpress.org/plugin/contact-form-7.4.9.zip
$ bin/install-wp-tests.sh <db-name> <db-user> <db-pass> [db-host] [wp-version]
$ phpunit
```

If you want to run tests with the specific version of the Contact Form 7, please edit `.travis.yml`.
