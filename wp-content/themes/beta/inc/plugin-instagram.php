<?php
/**
 * Instagram Developer
 * https://www.instagram.com/developer/
 * 
 * トークン取得
 * https://instagram.com/oauth/authorize/?client_id=d782329989b7423f9373850524c0eede&redirect_uri=http://www.yoga-academy.jp&response_type=token
 * 
 * ID 取得
 * https://api.instagram.com/v1/users/self/?access_token=2997146383.d782329.2df9b60c9f0f4ac090d7f110602b49d6
**/
class instagramClass {

    private $user_api_url;

    function __construct() {
        // ユーザネームから固有のuser_IDを取得する
        define('INSTAGRAM_ACCESS_TOKEN', '2997146383.d782329.2df9b60c9f0f4ac090d7f110602b49d6');
        // ユーザアカウント名
        $user_account = 'yg_academy';
        $user_id = 2997146383;
        // ユーザアカウント名からユーザデータを取得する。
        $this->user_api_url = 'https://api.instagram.com/v1/users/' . $user_id .'/media/recent?access_token=' . INSTAGRAM_ACCESS_TOKEN . '&amp;count=10';
        //$this->user_api_url = 'https://api.instagram.com/v1/users/search?q=' . $user_account . '&access_token=' . INSTAGRAM_ACCESS_TOKEN;
    }
    
    public function get_images($class){
        $class = NULL;
        $user_data = json_decode(@file_get_contents($this->user_api_url));
        $images = array();
        if(is_array($user_data->data)){
            foreach($user_data->data as $data){
                echo '<li class="'.$class.'"><a href="'.$data->images->standard_resolution->url.'" data-title="'.$data->caption->text.'"><img src="' . $data->images->low_resolution->url . '" alt="'.$data->caption->text.'"></a></li>';
            }
        }
    }
}
?>