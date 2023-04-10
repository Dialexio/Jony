## **This repository is no longer maintained. Please visit https://github.com/wikimedia/Jony for future updates.**

## Jony
A skin for MediaWiki, inspired by the user interface of modern versions of iOS.

This skin has only been tested on MediaWiki 1.28.x branch. This skin may work with other versions, but compatibility is not ensured.

## Installation
To install this theme, copy the "Jony" directory into your MediaWiki installation's "skins" directory.

The following line must be also be added to your LocalSettings.php:
```php
    wfLoadSkin( "Jony" );
```

## Variables
As most of the styling is written in [LESS](http://lesscss.org/), this skin makes use of variables that may be customized to your liking. These are primarily offered to allow for easy color customization, but may in future updates.

Under the terms of the [GNU General Public License 2.0](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html#SEC1), you are required to publish all modifications under the same license. I hereby waive this requirement, provided the only modifications made are to the value of the LESS variables. If any other portion of this skin is modified, the terms of the GNU General Public License 2.0 still apply.
