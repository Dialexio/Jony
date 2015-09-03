# Jony
A skin for MediaWiki, inspired by the user interface of newer versions of iOS.

This skin has only been tested on the MediaWiki 1.24 branch. This skin may work with other versions, but compatibility is not ensured at this time.

## Installation
To install this theme, copy the "Jony" directory into your MediaWiki installation's "skins" directory.

For MediaWiki 1.24, the following line must be also be added to your LocalSettings.php:
```php
    require_once( "$IP/skins/Jony/Jony.php" );
```

For MediaWiki 1.25, it is recommended to use this line instead:
```php
    wfLoadSkin( "Jony" );
```

## Variables
As most of the styling is written in [LESS](http://lesscss.org/), this skin makes use of variables that may be customized to your liking. These are primarily offered to allow for easy color customization, but may in future updates.

Under the terms of the [GNU General Public License 2.0](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html#SEC1), you are required to publish all modifications under the same license. I hereby waive this requirement, provided the only modifications made are to value of the LESS variables. If any other portion of this skin is modified, the terms of the GNU General Public License 2.0 still apply.
