Sonata-Project Distribution (SF 3.3)
====================================

The aim of this distribution is to supply a skeleton to start working with some bundles
of Sonata already configured.
At the moment supplies an integration with Sonata Admin, Sonata Classification and
Sonata Media bundles.

**This project is experimental!**

Installation
============

1. Clone repository and generate a secret in parameters.yml.

2. Update vendors.
```
$ composer update
```

3. Create database.
```
$ bin/console doctrine:database:create
```

4. Update schema.
```
$ bin/console doctrine:schema:update --force
```

5. Fix Sonata contexts.

This distribution defines 2 contexts: _default_ e _media_ under `sonata_media` config
in `src\AppAdminBundle\Resources\config\config.yml`
```
$ bin/console sonata:classification:fix-context
$ bin/console sonata:media:fix-media-context
```

6. Clear cache and install assets
```
$ bin/console cache:clear
$ bin/console assets:install
```

Some screenshots:

<img src="http://www.multimediaexperiencestudio.it/github/sonata-distribution/screen_01.png" />
<img src="http://www.multimediaexperiencestudio.it/github/sonata-distribution/screen_02.png" />
<img src="http://www.multimediaexperiencestudio.it/github/sonata-distribution/screen_03.png" />
<img src="http://www.multimediaexperiencestudio.it/github/sonata-distribution/screen_04.png" />


###### ♥ ☕ m|e|s
