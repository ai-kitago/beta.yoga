<?php
if(!function_exists('org_get_category')):
    function org_get_category($toggle,$tax_name,$term_id = NULL){
        $data = false;
        if($term_id == NULL){
            $terms = get_the_terms( get_the_ID(),$tax_name);
            //$terms = wp_get_object_terms(get_the_ID(),$tax_name);
            //var_dump($terms);
            $id = NULL;
            $name = NULL;
            $description = NULL;
            $data = false;
            if(is_array($terms)){
                foreach($terms as $term){
                    $id = $term->term_id;
                    $name = $term->name . ',';
                    $description = $term->description;
                }
            }
        }else{
            $id = $term_id;
        }
        if($toggle == 'name'){
            $data = rtrim($name, ",");
        }elseif($toggle == 'description'){
            $data = nl2br($description);
        }elseif($toggle == 'studio_image'){
            $term_idsp = $tax_name . '_' . $id;
            $field = get_field($toggle,$term_idsp);
            $obj = wp_get_attachment_image_src($field, 'thumb-class');
            $data = $obj[0];
        }elseif($toggle == 'shop_name'){
            $term_idsp = $tax_name . '_' . $id;
            $field = get_field($toggle,$term_idsp);
            $data = $field;
        }elseif($toggle == 'thumbnail'){
            //$field_name = 'instructor-image';
            $term_idsp = $tax_name . '_' . $id;
            $field = get_field($field_name,$term_idsp);
            $obj = wp_get_attachment_image_src($field, 'thumbnail');
            $data = $obj[0];
        }elseif($toggle == 'studio_url'){
            //$field_name = 'instructor-subname';
            $term_idsp = $tax_name . '_' . $id;
            $field = get_field($toggle,$term_idsp);
            $data = $field;
        }elseif($toggle == 'link'){
            $data = get_category_link($id);
        }elseif($toggle == 'studio_map'){
            $term_idsp = $tax_name . '_' . $id;
            $field = get_field($toggle,$term_idsp);
            $data = $field;
        }elseif($toggle == 'studio_tel'){
            $term_idsp = $tax_name . '_' . $id;
            $field = get_field($toggle,$term_idsp);
            $data = $field;
        }elseif($toggle == 'profile-image'){
            $term_idsp = $tax_name . '_' . $id;
            $field = get_field($toggle,$term_idsp);
            $obj = wp_get_attachment_image_src($field, 'full');
            $data = $obj[0];
        }elseif($toggle == 'profile-subname'){
            $term_idsp = $tax_name . '_' . $id;
            $field = get_field($toggle,$term_idsp);
            $data = $field;
        }elseif($toggle == 'profile-text'){
            $term_idsp = $tax_name . '_' . $id;
            $field = get_field($toggle,$term_idsp);
            $data = $field;
        }
        return $data;
    }
endif;

if(!function_exists('org_get_class')):

function org_get_taxonomy($tax_name,$term_id = NULL){

    $data = array();
    if($term_id == NULL){
        $terms = get_the_terms( get_the_ID(),$tax_name);
        $id = NULL;
        $name = NULL;
        $description = NULL;
        if(is_array($terms)){
            foreach($terms as $term){
                $id = $term->term_id;
                $name = $term->name . ',';
                $description = $term->description;
            }
        }
    }
    $data['name'] = rtrim($name, ",");
    $data['description'] = nl2br($description);
    $data['link'] = get_category_link($id);

    return $data;
}

endif;

if(!function_exists('org_term_id')):
// （タクソノミーと）タームのリンクを取得する
function org_term_obj(){
    // 投稿 ID から投稿オブジェクトを取得
    //$taxonomy_id = get_term_by('id',$post_id,'tax_class_instructor');
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
    //$taxonomy_id  = get_query_var( 'term' );
    return $term;
}
endif;
?>


<?php
if(!function_exists('org_field_image')):
    function org_field_image(){
        $image = false;
        $attachment_id = get_field('class-thumbnail');
        if($attachment_id){
            $size = "full"; // (thumbnail, medium, large, full or custom size)
        	$obj = wp_get_attachment_image_src( $attachment_id, $size );
        	$image = $obj[0];
        }else{
            $image = get_template_directory_uri().'/images/no-image.gif';
        }
    	return $image;
    }
endif;
?>