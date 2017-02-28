Symfony 2/3 PhotoBundle Symfony client for RefPhoto
---

This bundle is a client for the referencial Photo (https://github.com/l3-team/RefPhoto). 


Pre-requisites
---
* have a RefPhoto instance installed (https://github.com/l3-team/RefPhoto)
* have a Symfony 2/3 application

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
 
Next, add the Bundle in AppKernel.php

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

Configuration
---

Add and adapt the 3 variables for configuration in the **app/config/parameters.yml.dist** and **app/config/parameters.yml** :
```
    photo_enabled: true
    photo_image_url: 'https://refphotos.univ.fr/image/'
    photo_token_url: 'https://refphotos.univ.fr/token/add/'
```

Next add the variable **%photo_enabled%** in **app/config/config.yml** under **twig globals** :
```
# Twig Configuration
twig:
    debug:            "%kernel.debug%"
    strict_variables: "%kernel.debug%"
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
