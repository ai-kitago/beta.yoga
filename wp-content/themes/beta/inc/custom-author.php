<?php
if ( ! function_exists( 'get_author_org' ) ) :
function get_author_org(){
    echo '<div class="media post-author">
        <div class="pull-left">'
            . get_avatar( get_the_author_meta( 'ID' ), 100 )
        .'</div>
        <div class="media-body">
            <h3>' . get_the_author_link() . '</h3>
            <p>' . get_the_author_meta('description') . '</p>
        </div>
    </div> <!-- .post-author -->';
}
endif;
?>