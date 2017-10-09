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

## Customizing

If you set the default URL to redirect via filter function, `goto` argument can be omitted.

```
add_filter( 'redirect_for_contact_form_7_default_url', function() {
	return home_url( 'path/to/page' );
} );
```

## Running automated testing

```
$ export WP_PLUGIN=https://downloads.wordpress.org/plugin/contact-form-7.4.9.zip
$ bash bin/install-wp-tests.sh <db-name> <db-user> <db-pass> [db-host] [wp-version]
$ bash bin/install-plugin.sh
$ phpunit
```

If you want to run tests with the specific version of the Contact Form 7, please change the value of `$WP_PLUGIN`.

Also, if you want to check the compatibility with the latest version of Contact Form 7, please click "Restart build" on the Travis CI.

![](https://www.evernote.com/l/ABWENY2VA8pHPoVbrQVU78GlRO_svHqSMCsB/image.png)
