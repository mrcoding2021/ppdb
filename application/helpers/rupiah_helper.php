<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function rupiah($data){
    if ($data == '') {
        return '';
    } else {
        $rupiah = number_format($data,0,',','.').',-';
        return $rupiah;
    }
}
