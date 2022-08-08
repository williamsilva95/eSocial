<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dominio extends Model
{
    protected $table = 'dominios';

    protected $fillable = ['nome', 'tld'];

    public function rules() {

        return [

            'nome'  => 'required',
            'tld'  => 'required|not_in:0',

        ];
    }

    public $mensages = [

        'nome.required' => 'Nome de Domínio não informado.',
        'tld.required' => 'TLD não informado.',
        'tld.not_in' => 'TLD não selecionado.',

    ];

    public static function getAllForIndex(){
        return self::select('id', 'nome','tld')->orderBy('id')->get();
    }
    
}
