<?php
/** .-------------------------------------------------------------------
 * | 函数库
 * '-------------------------------------------------------------------*/
function url($path){
    $m =\houdunwang\request\Request::get('m');
    $url = "?m={$m}&action=controller/{$path}";
    return $url;
}