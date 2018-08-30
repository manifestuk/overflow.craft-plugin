# Overflow
Overflow is a plain text Craft field type, with a soft or hard character limit. It's perfect for things such as metadata titles and descriptions, which have an "ideal" length, but not an absolute limit.

Overflow will gently inform your content authors when they exceed a soft character limit, but will still allow the entry to be saved.

Opting for a hard limit causes Overflow to behave exactly like [the built-in plain text field][craft-plaintext].

## Requirements
Overflow requires Craft 3.0.0+.

## Installation
You can install Overflow via [the Craft Plugin Store][store].

[store]: https://craftcms.com/features/plugin-store

If you're [a `1337` hacker][iamdevloper], you can also install it via Composer, as follows:

[iamdevloper]: https://twitter.com/iamdevloper

```
$ cd /path/to/project
$ composer require experience/overflow
```

## Field configuration
Overflow adds a new "Enforce character limit" checkbox to [the plain text field][craft-plaintext] settings.

Check the box to enforce the character limit (the standard plain text field behaviour). Leave the box unchecked for a soft character limit.

[craft-plaintext]: https://docs.craftcms.com/v3/plain-text-fields.html
