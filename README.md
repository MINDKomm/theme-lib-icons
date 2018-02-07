# Icons

Collection of icon sprite helper functions for WordPress themes.

## Installation

You can install the package via Composer:

```bash
composer require mindkomm/theme-lib-icons
```

## Functions
| Name | Summary | Type | Returns/Description |
| --- | --- | --- | --- |
| [get_icon](#get_icon) | Get an icon | `string` | The HTML to be used in a template. |
| [get_icon_url](#get_icon_url) | Get the URI to the icon sprite. | `string` | The URI to the icon sprite. Default `build/icons/icons.svg` |
| [get_svg_icon](#get_svg_icon) | Return HTML for an accessible SVG icon in an icon sprite. | `string` | The HTML to be used in a template. |
| [prepare_html_tag_attribute](#prepare_html_tag_attribute) | Turn a value and a name into an HTML attribute. | `string` |  |

### get\_icon

<p class="summary">Get an icon</p>

This function is a wrapper that makes it easier to include an icon by only providing the name of the icon and
not the whole path. By adding this function, it’s also possible to use the theme version constant for cache
busting.

`get_icon( string $icon_name, string $width, string $height, array $args = [] )`

**Returns:** `string` The HTML to be used in a template.

| Name | Type | Description |
| --- | --- | --- |
| $icon_name | `string` | The slug of the icon. |
| $width | `string` | Width in pixel the icon should be displayed at. |
| $height | `string` | Height in pixel the icon should be displayed at. |
| $args | `array` | Optional. Array of arguments for SVG icon. See get_svg_icon() function. |

**PHP**

```php
<?php
echo get_icon( 'angle-down', 12, 12, [ 'class' => 'icon icon-dropdown' ] );
```

---

### get\_svg\_icon

<p class="summary">Return HTML for an accessible SVG icon in an icon sprite.</p>

Has the possibility to add a description for the icon to provide better accessibility.

`get_svg_icon( string $path, string $width = '', string $height = '', array $args = [] )`

**Returns:** `string` The HTML to be used in a template.

| Name | Type | Description |
| --- | --- | --- |
| $path | `string` | Absolute URL to the icon in an icon sprite. |
| $width | `string` | Width in pixel the icon should be displayed at. |
| $height | `string` | Height in pixel the icon should be displayed at. |
| $args | `array` | Optional. Array of arguments for SVG icon.<br><br><ul><li>**$class**<br>`string` Class names for the SVG icon.</li><li>**$id**<br>`string` ID of the SVG icon.</li><li>**$description**<br>`string` Description of the icon for better accessibility. Don’t describe the icon, but describe what it means.</li></ul> |

**PHP**

```php
<?php
echo get_svg_icon(
    'https://www.mind.ch/wp-content/theme/theme-mind/build/icons/icon-sprite.svg#arrow-right',
    20, 20,
    [ 'class' => 'icon']
);
```

---

### prepare\_html\_tag\_attribute

<p class="summary">Turn a value and a name into an HTML attribute.</p>

`prepare_html_tag_attribute( string $value = '', string $name = '' )`

**Returns:** `string` 

| Name | Type | Description |
| --- | --- | --- |
| $value | `string` | The value to use. |
| $name | `string` | The attribute’s name. |

---

### get\_icon\_url

<p class="summary">Get the URI to the icon sprite.</p>

**Returns:** `string` The URI to the icon sprite. Default `build/icons/icons.svg`

---

## Twig Functions

You need [Timber](https://github.com/timber/timber) to use this.

### icon

Shorthand function for [`get_icon()`](#get_icon).

```twig
{{ icon('angle-down', 12, 12, { class: 'icon icon-dropdown' }) }}
```

## Support

This is a library that we use at MIND to develop WordPress themes. You’re free to use it, but currently, we don’t provide any support. 
