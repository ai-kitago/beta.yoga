<?php
/*
* Custom Post Type Support
* For 'fudo' post type:
*
* @since AMP Plugin 0.3.2
* License: GPLv2 or later
*/
function org_amp_add_review_cpt() {
    add_post_type_support( 'magazine', AMP_QUERY_VAR );
}
add_action( 'amp_init', 'org_amp_add_review_cpt', 99 );

/*
* CSS ‚ğ’Ç‰Á‚·‚é
* use the `amp_post_template_css` action. 
*
* @since AMP Plugin 0.3.2
* License: GPLv2 or later
*/
function org_amp_additional_css_styles( $amp_template ) {
// only CSS here please...
?>
nav.amp-wp-title-bar {
background: #333;
}
h1.title {
font-size: 26px;
}
h2 {
line-height: 1.3;
}
.content {
font-family: "Helvetica Neue", Helvetica, "ƒqƒ‰ƒMƒmŠpƒS Pro", "Hiragino Kaku Gothic Pro", "ƒƒCƒŠƒI", "Meiryo", sans-serif;
}
<?php
}
add_action( 'amp_post_template_css', 'org_amp_additional_css_styles' );

?>