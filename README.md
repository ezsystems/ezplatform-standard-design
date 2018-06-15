# eZ Platform Standard Design Bundle

This Bundle defines standard Design and Theme to be handled by [ezplatform-design-engine](https://github.com/ezsystems/ezplatform-design-engine).

Standard Design is the default Design used by the templates shipped with eZ Platform.

## Installation

1. In your eZ Platform 2.2+ project, require this package with Composer.

    ```bash
        composer require ezsystems/ezplatform-standard-design
    ```

2. Enable the Bundle in `AppKernel.php`:

    ```php
        public function registerBundles()
        {
           $bundles = [
               // ...
               new EzSystems\EzPlatformStandardDesignBundle\EzPlatformStandardDesignBundle(),
           ];

           // ...
        }
   ```

3. Remember to clear the Symfony Cache (for `SYMFONY_ENV` your project uses).
    ```bash
        php bin/console cache:clear
    ```

## COPYRIGHT
Copyright (C) 1999-2018 eZ Systems AS. All rights reserved.

## LICENSE
http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
