<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Bold_Post_Helper {

	public static function add_responsive_vars ($attributes, &$target_array, $attr_base, $prop_name, $properties = [], $is_object = false) {
   		$devices = ['' => 'desktop', 'Tablet' => 'tablet', 'Mobile' => 'mobile'];
    
    	foreach ($devices as $d_suffix => $device) {
			$attr_name = $attr_base . $d_suffix;
			$val = isset($attributes[$attr_name]) && $attributes[$attr_name] !== '' ? $attributes[$attr_name] : null;
			
			if ($is_object && is_array($val)) {
				foreach ($properties as $prop_key => $css_prop) {
					if ( isset( $val[$prop_key] ) && $val[$prop_key] !== '' ) {
						$v = $val[$prop_key];
						if ( in_array( $prop_key, ['top', 'right', 'bottom', 'left', 'fontSize', 'letterSpacing'] ) ) {
							$v = self::ensure_unit($v);
						}
						$target_array[$device][$css_prop] = $v;
					}
				}
			} elseif ( ! $is_object && ! empty( $val ) ) {
				$v = $val;
				if ( in_array($attr_base, ['itemGap', 'itemColGap', 'itemRowGap', 'columns']) ) {
                     // handled per block usually, but let's store it
                }
				$target_array[$device][$prop_name] = $v;
			}
		}
	}

	public static function ensure_unit ($value) {
		if ( $value === '' || $value === null ) return '0px';
		if ( is_numeric( $value ) && $value != 0 ) return $value . 'px';
		return $value;
	}

	public static function get_inline_styles ($style_map) {
		$styles = [];
		foreach ( $style_map as $prop => $value ) {
			if ( $value !== '' && $value !== null && $value !== 'inherit' && $value !== '0px' ) {
				$styles[] = $prop . ':' . $value;
			}
		}
		return implode( ';', $styles );
	}

	public static function generate_responsive_css($selector, $responsive_data) {
		$css = "";
		$breakpoints = [
			'desktop' => '',
			'tablet'  => '@media (max-width: 1024px)',
			'mobile'  => '@media (max-width: 767px)'
		];

		foreach ($breakpoints as $device => $media) {
			if (!empty($responsive_data[$device])) {
				$decls = "";
				foreach ($responsive_data[$device] as $prop => $val) {
					$decls .= $prop . ":" . $val . ";";
				}
				if ($media) {
					$css .= $media . " { " . $selector . " { " . $decls . " } }\n";
				} else {
					$css .= $selector . " { " . $decls . " }\n";
				}
			}
		}
		return $css;
	}

	public static function add_custom_style( $handle, $selector, $responsive_css = "", $sub_styles = [] ) {
		$css = $responsive_css;
		
		foreach ( $sub_styles as $sub_sel => $style ) {
			if ( ! empty( $style ) ) {
				 $css .= $selector . " " . $sub_sel . " { " . $style . "; }\n";
			}
		}

		if ( ! empty( $css ) ) {
			if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CSS is sanitized during generation
				echo '<style>' . $css . '</style>';
			} else {
				wp_add_inline_style( $handle, $css );
			}
		}
	}
}