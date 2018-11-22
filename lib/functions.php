<?php

/**
 * Get an icon
 *
 * This function is a wrapper that makes it easier to include an icon by only providing the name of the icon and
 * not the whole path. By adding this function, it’s also possible to use the theme version constant for cache
 * busting.
 *
 * @api
 * @since 1.0.0
 * @see   get_svg_icon()
 * @example
 * ```php
 * echo get_icon( 'angle-down', 12, 12, [ 'class' => 'icon icon-dropdown' ] );
 * ```
 *
 * @param string $icon_name The slug of the icon.
 * @param string $width     Width in pixel the icon should be displayed at.
 * @param string $height    Height in pixel the icon should be displayed at.
 * @param array  $args      Optional. Array of arguments for SVG icon. See get_svg_icon() function.
 *
 * @return string The HTML to be used in a template.
 */
function get_icon( $icon_name, $width, $height, $args = [] ) {
	$icon_path = get_icon_url() . '#' . $icon_name;

	return get_svg_icon( $icon_path, $width, $height, $args );
}

/**
 * Return HTML for an accessible SVG icon in an icon sprite.
 *
 * Has the possibility to add a description for the icon to provide better accessibility.
 *
 * @link  https://gist.github.com/davidhund/564331193e1085208d7e
 * @link  https://css-tricks.com/accessible-svgs/#article-header-id-8
 * @link  http://simplyaccessible.com/article/7-solutions-svgs/
 *
 * According to https://css-tricks.com/svg-symbol-good-choice-icons/ we don’t need to use viewBox
 * on the <svg> tag, because the symbol inside the SVG sprites already includes this.
 *
 * @api
 * @since 1.0.0 - Updated output code for better accessibility. Changed attributes.
 *              - Applied tips from http://simplyaccessible.com/article/7-solutions-svgs/.
 *              - Removed title, use description only as sibling of <svg> with class
 *              'screen-reader-text'.
 *              - Removed aria-hidden attribute, because SVG icons are always hidden for ARIA.
 * @since 0.9.0 Added
 * @example
 * ```php
 * echo get_svg_icon(
 *     'https://www.mind.ch/wp-content/theme/theme-mind/build/icons/icon-sprite.svg#arrow-right',
 *     20, 20,
 *     [ 'class' => 'icon']
 * );
 * ```
 *
 * @param string $path        Absolute URL to the icon in an icon sprite.
 * @param string $width       Width in pixel the icon should be displayed at.
 * @param string $height      Height in pixel the icon should be displayed at.
 * @param array  $args        {
 *     Optional. Array of arguments for SVG icon.
 *
 *     @type string  $class         Class names for the SVG icon.
 *     @type string  $id            ID of the SVG icon.
 *     @type string  $description   Description of the icon for better accessibility. Don’t describe the
 *                                  icon, but describe what it means.
 * }
 * @return string The HTML to be used in a template.
 */
function get_svg_icon( $path, $width = '', $height = '', $args = [] ) {
	$defaults = [
		'id'          => '',
		'class'       => '',
		'description' => '',
	];

	$args = wp_parse_args( $args, $defaults );

	$id     = prepare_html_tag_attribute( $args['id'], 'id' );
	$class  = prepare_html_tag_attribute( $args['class'], 'class' );
	$width  = prepare_html_tag_attribute( $width, 'width' );
	$height = prepare_html_tag_attribute( $height, 'height' );

	// Open SVG
	$svg = '<svg' . $id . $class . $width . $height;

	/**
	 * Catch different screenreader inconsistencies and browser bugs.
	 *
	 * @link http://simplyaccessible.com/article/7-solutions-svgs/#acc-heading-3
	 * @link http://simplyaccessible.com/article/7-solutions-svgs/#acc-heading-4
	 */
	$svg .= ' focusable="false"';
	$svg .= ' aria-hidden="true"';
	$svg .= ' role="img">';

	/**
	 * Add whitespace around <use> tags for better compatibility with Safari 10.
	 *
	 * @see http://simplyaccessible.com/article/7-solutions-svgs/#acc-heading-5
	 */
	$svg .= ' <use xlink:href="' . $path . '"></use> ';
	$svg .= '</svg>';

	/**
	 * Add description.
	 *
	 * Do not add a <description> tag inside the SVG, but as a sibling element of the <svg> that is only visible
	 * for screenreaders.
	 *
	 * @link http://simplyaccessible.com/article/7-solutions-svgs/#acc-heading-3
	 * @link http://simplyaccessible.com/article/7-solutions-svgs/#acc-heading-6
	 */
	if ( ! empty( $args['description'] ) ) {
		$svg .= '<span class="screen-reader-text">' . $args['description'] . '</span>';
	}

	return $svg;
}

/**
 * Turn a value and a name into an HTML attribute.
 *
 * @since 1.0.0
 *
 * @param string $value The value to use.
 * @param string $name  The attribute’s name.
 * @return string
 */
function prepare_html_tag_attribute( $value = '', $name = '' ) {
	if ( ! empty( $value ) ) {
		return ' ' . $name . '="' . $value . '"';
	}

	return '';
}

/**
 * Get the URI to the icon sprite.
 *
 * @api
 * @since 1.0.0
 * @return string The URI to the icon sprite. Default `build/icons/icons.svg`
 */
function get_icon_url() {
	$icon_url = mix( 'build/icons/icons.svg' );

	/**
	 * Filters the URL to the icon sprite.
	 *
	 * @api
	 * @since 1.0.1
	 *
	 * @param string $icon_url The default icon URL.
	 */
	$icon_url = apply_filters( 'get_icon_url', $icon_url );

	return $icon_url;
}
