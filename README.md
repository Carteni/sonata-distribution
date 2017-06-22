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

7. Create and promote user to ROLE_SUPER_ADMIN.
```
$ bin/console fos:user:create
$ bin/console fos:user:promote
```

8. Visit the admin page on `/admin/dashboard`.

Screenshots:

1. [Dashboard][1]
2. [Media / List][2]
3. [Category / Tree][3]
4. [Category / Edit][4]


###### ♥ ☕ m|e|s

[1]: http://www.multimediaexperiencestudio.it/github/sonata-distribution/screen_01.png
[2]: http://www.multimediaexperiencestudio.it/github/sonata-distribution/screen_02.png
[3]: http://www.multimediaexperiencestudio.it/github/sonata-distribution/screen_03.png
[4]: http://www.multimediaexperiencestudio.it/github/sonata-distribution/screen_04.png
