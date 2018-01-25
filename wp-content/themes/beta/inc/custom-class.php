<?php
class createHtml{
    function schedule($field){
    $id = get_the_ID();
    $html = '<article id="post-'. $id .'">
        <header class="entry-header col-md-3 col-xs-4">';
        if ( org_field_image() ) {
            $html .= '<div class="entry-thumbnail">
               <a href="' . get_the_permalink() .'" rel="bookmark"><img src="' . org_field_image($id) . '" class="suck-image"></a>'
            .'</div>
        </header>';
        } //.entry-thumbnail
        $html .= '<div class="entry-content col-md-9 col-xs-8">
            <div class="row">
            <p class="publish-date">
                <time class="entry-date" datetime="'. date('Y-m-d H:i:s',strtotime(org_get_fields('class_starts','class_start',$field))) .'">'. date('Y年m月d日',strtotime(org_get_fields('class_starts','class_start',$field))).'</time>
            </p>
            <h2 class="entry-title">
                <a href="'. get_the_permalink().'" rel="bookmark">'. get_title_replace().'</a>
            </h2>
            </div>
        </div>
        <footer class="entry-footer col-md-9 col-xs-12">
            <dl>
                <dt>担当講師</dt>
                <dd>
                    <div class="row">';
            $tax_name = 'tax_event_instructor';
            $terms = get_the_terms( $id,$tax_name);
            foreach($terms as $term){
                
            $html .= '<div class="entry-profile col-md-4 col-xs-6">
                <div class="profile-image">
                    <a href="'. org_get_category('link',$term->term_id).'"><img src="'. org_get_category('thumbnail',$term->term_id).'" class="suck-image"></a>
                </div>
                <div class="profile-name">
                    <p><a href="'. org_get_category('link',$term->term_id).'">'.rtrim($term->name).'</a></p>
                </div>
            </div>';
            }
        $html .= '</dd>
            </dl>
        </footer>
    </article>';
    return $html;
    }
}