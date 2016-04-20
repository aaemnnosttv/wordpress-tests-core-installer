# WordPress Tests Core Installer

A custom Composer installer plugin for the [WordPress Core PHPUnit Test Library](https://github.com/aaemnnosttv/wordpress-tests-core).

### Usage

This installer requires a key within the `extra` configuration of your `composer.json` for the target installation path to install the core test library.

```
"extra": {
	"wordpress-tests-core-dir": "custom/path"
}
```
