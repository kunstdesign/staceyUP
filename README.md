# StaceyUP@0.0.0

### based off kolber/Stacey@3.0.0

## Dev. ROADMAP:

### 0.0.1
- [X] Merge useful commits from others in github (features & fixes)
- [X] Make JSON the primary content holder format
- [X] Add performance logs (HTML only)
- [ ] Single pages for Uploads
  - [X] _media.json (specific case, as of 0.0.1)
  - [ ] Routes to _media.json (for APIs)
  - [ ] Render pages based on _media.json
  - [ ] correct routing to individual pages
- [ ] Add routes to JSONs, for READ APIs
- [ ] clean up


### 0.0.2
- [ ] multilanguage
- [ ] clean up



### future

- [ ] interchangeable templating


## Overview

StaceyUP takes content from `.json` files (backwards compatible with `.yml`), image files and implied directory structure and generates a website.
It is a no-database, dynamic website generator.

It's intended to make it easier to integrate onto machine backends, such as an admin pane or app.
and also more focused on media. so each upload can have a permalink page, easing the integration of singular content over the internet. (EG: social networks) 

## Templating

StaceyUP will have an interchangeable templating system.

as of today it uses the [Twig templating language](http://twig.sensiolabs.org/). 

## Read More

See <http://staceyapp.com> for the original project.

## Copyright/License
Original stacey:
Copyright (c) 2009 Anthony Kolber. See `LICENSE` for details.
Except [PHP Markdown Extra](http://michelf.com/projects/php-markdown/extra/) which is (c) Michel Fortin (see `/app/parsers/markdown-parser.inc.php` for details) and
[jsmin.php](https://github.com/rgrove/jsmin-php/) which is (c) Ryan Grove (see `app/parsers/json-minifier.inc.php` for details).