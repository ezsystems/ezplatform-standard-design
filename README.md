# Ibexa Standard Design Bundle

This Bundle defines standard Design and Theme to be handled by [ezplatform-design-engine](https://github.com/ezsystems/ezplatform-design-engine).

Standard Design is the default Design used by the templates shipped
with [Ibexa DXP](https://www.ibexa.co/products) and Ibexa Open Source.

## Installation

1. In your Ibexa project, require this package with Composer.

    ```bash
        composer require ezsystems/ezplatform-standard-design
    ```

2. Enable the Bundle in `config/bundles.php`:

    ```php
        return [
            // ...
            EzSystems\EzPlatformStandardDesignBundle\EzPlatformStandardDesignBundle::class => ['all' => true],
            // ...
        ];
   ```

3. Remember to clear the Symfony Cache (for `SYMFONY_ENV` your project uses).
    ```bash
        php bin/console cache:clear
    ```

## COPYRIGHT
Copyright (C) 1999-2021 Ibexa AS (formerly eZ Systems AS). All rights reserved.

## LICENSE
This source code is available separately under the following licenses:

A - Ibexa Business Use License Agreement (Ibexa BUL),
version 2.4 or later versions (as license terms may be updated from time to time)
Ibexa BUL is granted by having a valid Ibexa DXP (formerly eZ Platform Enterprise) subscription,
as described at: https://www.ibexa.co/product
For the full Ibexa BUL license text, please see:
https://www.ibexa.co/software-information/licenses-and-agreements (latest version applies)

AND

B - GNU General Public License, version 2
Grants an copyleft open source license with ABSOLUTELY NO WARRANTY. For the full GPL license text, please see:
https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
