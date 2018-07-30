Symfony 2/ Symfony3 / Symfony4 PhotoBundle Symfony client for RefPhoto
---

This bundle is a client for the referencial Photo (https://github.com/l3-team/RefPhoto) or (https://github.com/l3-team/RefPhotoJ2EE) 


Pre-requisites
---
* have a RefPhoto instance installed (https://github.com/l3-team/RefPhoto) or (https://github.com/l3-team/RefPhotoJ2EE)
* have a Symfony 2 or Symfony3 or Symfony4 application

Installation
---
Install the Bundle by adding this line to your composer.json :
```
"l3/photo-bundle": "~1.0"
```
Then 
 ```
$ composer update
 ```
 
For Symfony 2 and Symfony3, add the Bundle in AppKernel.php

```
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new L3\Bundle\PhotoBundle\L3PhotoBundle(),
        );

        // ...
    }

    // ...
}
```

For Symfony4, add the bundle in config/bundles.php file (add the line if not present) :
```
<?php
// config/bundles.php

return [
    ...
    L3\Bundle\PhotoBundle\L3PhotoBundle::class => ['all' => true],
    ...
];
```

Configuration
---

For Symfony2 and Symfony3, add and adapt the 3 variables for configuration in the **app/config/parameters.yml.dist** and **app/config/parameters.yml** :
```
# app/config/parameters.yml.dist
# app/config/parameters.yml

parameters:
    photo_enabled: true
    photo_image_url: 'https://refphotos.univ.fr/image/'
    photo_token_url: 'https://refphotos.univ.fr/token/add/'
```

Next add the variable **%photo_enabled%** in **app/config/config.yml** under **twig globals** :
```
# app/config/config.yml

# Twig Configuration
twig:
    debug:            "%kernel.debug%"
    strict_variables: "%kernel.debug%"
    globals:
        photo_enabled: '%photo_enabled%'
```

For Symfony4, add and adapt the 3 variables for configuration in the **.env.dist** and **.env** :
```
# .env.dist
# .env

###> l3/photo-bundle ###
PHOTO_ENABLED=true
PHOTO_IMAGE_URL=https://refphotos.univ.fr/image/
PHOTO_TOKEN_URL=https://refphotos.univ.fr/token/add/
###< l3/photo-bundle ###
```
and add the 3 variables under **parameters** in the config/services.yaml file :
```
# config/services.yaml

parameters:
    photo_enabled: '%env(bool:PHOTO_ENABLED)%'
    photo_image_url: '%env(string:PHOTO_IMAGE_URL)%'
    photo_token_url: '%env(string:PHOTO_TOKEN_URL)%'
```
and the variable **%photo_enabled%** in config/packages/twig.yaml under **twig globals** :
```
# config/packages/twig.yaml

# Twig Configuration
twig:
    paths: ['%kernel.project_dir%/templates']
    debug: '%kernel.debug%'
    strict_variables: '%kernel.debug%'
    globals:
        photo_enabled: '%photo_enabled%'
``` 


How to use
---

In your twig views you can use it like this :
```
{% if photo_enabled %}
<img src="{{ photo(p.uid) }}" alt="photo inexistante" />
{% endif %}
```
