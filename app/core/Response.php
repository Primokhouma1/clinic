<?php
/**
 * Created by PhpStorm.
 * User: seeynii.faay
 * Date: 10/22/19
 * Time: 10:31 AM
 */

namespace app\core;

trait Response
{
    public function log($response = []) {

    }

    public function response($params = []) {
        $this->lang_choice = $this->request_headers["lang"];
        $this->lang = Language::getLang($this->lang_choice);
        if(!is_array($params)) $params = (array)$params;
        $this->log($params);
        $response = $params;
        if(!isset($_SERVER['HTTP_PROCESS'])) {
            $response = [];
            $response['code'] = isset($params['code']) ? $params['code'] : 200;
            $response['error'] = isset($params['error']) ? $params['error'] : true;
            $response['msg'] = !isset($params['msg']) ? $this->lang[$response['code']] : $params['msg'];
            $response['data'] = isset($params['data']) ? $params['data'] : [];
        }
        return $response;
    }
}