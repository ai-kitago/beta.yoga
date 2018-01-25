<?php

if(!function_exists('org_get_datesearch')):
    function org_get_datesearch(){
        global $wpdb;
        $schedule = org_get_request();
        $sql = "SELECT DISTINCT ".$wpdb->prefix."posts.ID"
            ." FROM ".$wpdb->prefix ."posts"
            ." INNER JOIN ".$wpdb->prefix."postmeta ON ".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id"
            ." WHERE ".$wpdb->prefix."postmeta.meta_key LIKE 'class_start%' AND ".$wpdb->prefix."postmeta.meta_value != '' AND ".$wpdb->prefix."posts.post_type = 'class' AND  ".$wpdb->prefix."posts.post_status = 'publish'";
        $results = $wpdb->get_results( $sql );
        $postArray = array();
        foreach($results as $row){
            $postArray[] = $row->ID;
        }
        return $postArray;
    }
endif;

if(!function_exists('org_get_fields')):
    function org_get_fields($fields,$field,$schedule = NULL){
        $array = get_field($fields);
        if(is_null($schedule)){
            $schedule = org_get_request();
        }
        $data = false;
        foreach($array as $key){
            if(preg_match('/^'.$schedule.'/',$key[$field])){
                $data = $key[$field];
            }
        }
        return $data;
    }
endif;

if(!function_exists('org_get_time')):
    function org_get_time($fields,$field,$post_id){
        $array = get_field($fields,$post_id);
        $data = false;
        if(is_array($array)){
            foreach($array as $key){
                $data = $key[$field];
                $data = date('Y-m-d H:i:s',strtotime($data));
                break;
            }
        }else{
            $data = NULL;
        }
        return $data;
    }
endif;

if(!function_exists('org_get_date')):
    function org_get_date($fields,$field,$post_id){
        $array = get_field($fields,$post_id);
        $data = false;
        if(is_array($array)){
            foreach($array as $key){
                $data = $key[$field];
                $data = date('Y年m月d日',strtotime($data));
                break;
            }
        }else{
            $data = "予定なし";
        }
        return $data;
    }
endif;

if(!function_exists('org_Query')):
    function org_Query(){
        require ( get_template_directory() . '/inc/custom-class.php');
        $postArray = org_get_datesearch();
        $schedule = org_get_request();
        $args = array(
            'posts_per_page' =>'-1',
            'post_type' => 'magazine',
            'post_status' => 'publish',
            'post__in' => $postArray,
        );
        $the_query = new WP_Query( $args );
        $html = new createHtml;
        $data = array();
        $field = 'class_start';
        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post();
                $array = get_field('class_starts');
                $schedule = org_get_request();
                foreach($array as $key){
                    if(preg_match('/^'.$schedule.'/',$key[$field])){
                        $numkey = sprintf('%09d', get_the_ID());
                        
                        $data[$key[$field].$numkey] = $html->schedule($key[$field]);
                        //include(get_template_directory() . '/post-format/content-class.php');
                    }
                }
            endwhile;
            wp_reset_postdata();
        endif;
        ksort($data);
        return $data;
    }
endif;

if(!function_exists('org_get_request')):
    function org_get_request(){
        if(isset($_REQUEST['schedule'])){
            $schedule = $_REQUEST['schedule'];
        }else{
            $schedule = date('Ym',strtotime('now'));
        }
        return $schedule;
    }
endif;