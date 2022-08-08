<?php

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;

function validateErros($validate, $array_error = [])
{
    $messages_erros = array();
    $messages       = $validate->messages();

    foreach($messages as $key => $message)
    {
        $messages_erros["$key"] = $message;
    }

    foreach ($array_error as $key => $value) {
        $messages_erros["$key"] = [$value];
    }

    return $messages_erros;
}

function arrayToSelect(array $values, $key, $value, $noZeroIndex=null) {
    if(count($values) > 0)
    {
        $data = array();
        if($noZeroIndex==null)
        {
            $data[0] = 'Selecione';
        }
        foreach ($values as $row) {
            $data[$row[$key]] = $row[$value];
        }
        return $data;
    }else{
        if($noZeroIndex==null)
        {
            return ['Selecione'];
        }
        return [];
    }
}

function array_filter_recursive($array, $callback = null, $remove_empty_arrays = false) {
    foreach ($array as $key => & $value) {
        if (is_array($value)) {
            $value = call_user_func_array(__FUNCTION__, array($value, $callback, $remove_empty_arrays));
            if ($remove_empty_arrays && !(bool)$value) {
                unset($array[$key]);
            }
        }
        else {
            if ( ! is_null($callback) && ! $callback($value)) {
                unset($array[$key]);
            }
            elseif ( ! (bool) $value) {
                unset($array[$key]);
            }
        }
    }
    unset($value);
    return $array;
}
