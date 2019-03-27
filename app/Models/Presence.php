<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Presence extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'date', 'check_in', 'check_out', 'loc_x', 'loc_y', 'loc_c', 'loc_x_o', 'loc_y_o', 'loc_c_o', 'status', 'conf_i', 'conf_o'];

    /*******************************************************
    ********************************************************
    * Método para registro de entrada na tabela de presenças
    ********************************************************
    *******************************************************/
    public function register($locx, $locy, $locc, $states) : Array
    {
        $checks = Presence::with(['user'])->where('date', '=', date("Y-m-d"))->get();

        $cont_presentes = Presence::where([['date', '=', date("Y-m-d")], ['loc_c', '=', 'USF'], ['check_out', '=', NULL]])->count();

        $cont_i = (isset($states)) ? count($states) : 0;
        
        $cont_acertos = 0; $cont_erros = 0; $confiabilidade = 100;

        foreach($checks as $check)
        {
            if($check->user_id === auth()->user()->id)
                return [
                    'success' => false,
                    'message' => 'Você já registrou sua entrada hoje'
                ];
        }

        if($locc == "USF")
        {   
            if(isset($states))
            {
                foreach($states as $state)
                {
                    foreach($checks as $check) 
                    {
                        if($state == $check->user->name && $check->check_out == NULL && $check->loc_c == "USF")
                        {
                            $cont_acertos++;
                            break;
                        }  
                    }
                }
            }

            $cont_erros = $cont_i - $cont_acertos;

            $confiabilidade -= $cont_erros * 30;
            $confiabilidade -= ($cont_presentes - $cont_acertos) * 5;
        }

        if ($locx == null || $locy == null || $locc == null) 
            return [
                'success' => false,
                'message' => 'Preencha todos os campos'
            ];

        $presence = auth()->user()->presences()->create([
            'user_id'   => auth()->user()->id,
            'date'      => date('Y-m-d'),
            'check_in'  => date('H:i'),
            'loc_x'     => $locx,
            'loc_y'     => $locy,
            'loc_c'     => $locc,
            'status'    => 1,
            'conf_i'    => $confiabilidade
        ]);

        if ($presence) 
            return [
                'success' => true,
                'message' => 'Registro de Entrada efetuado com sucesso!'
            ];

        return [
            'success' => false,
            'message' => 'Falha no registro, tente novamente'
        ];
    }

    /*****************************************************
    ******************************************************
    * Método para registro de saída na tabela de presenças
    ******************************************************
    *****************************************************/
    public function exit($locx, $locy, $locc, $states) : Array
    {
        $checks = Presence::with(['user'])->where('date', '=', date("Y-m-d"))->get();

        $cont_presentes = Presence::where([['date', '=', date("Y-m-d")], ['loc_c', '=', 'USF'], ['check_out', '=', NULL]])->count();
        $cont_presentes--;

        $cont_i = (isset($states)) ? count($states) : 0;
        
        $cont_acertos = 0; $cont_erros = 0; $confiabilidade = 100; $flag_check_in = 0;

        foreach($checks as $check)
        {
            if($check->user_id == auth()->user()->id && $check->check_out == NULL)
            {
                $flag_check_in = 1;
            }
        }

        if($flag_check_in == 0)
            return [
                'success' => false,
                'message' => 'Você ainda não registrou sua entrada ou já registrou sua saída hoje'
            ];

        if($locc == "USF")
        {   
            if(isset($states))
            {
                foreach($states as $state)
                {
                    foreach($checks as $check) 
                    {
                        if($state == $check->user->name && $check->check_out == NULL && $check->loc_c == "USF")
                        {
                            $cont_acertos++;
                            break;
                        }  
                    }
                }
            }

            $cont_erros = $cont_i - $cont_acertos;

            $confiabilidade -= $cont_erros * 30;
            $confiabilidade -= ($cont_presentes - $cont_acertos) * 5;
        }

        if ($locx == null || $locy == null || $locc == null) 
            return [
                'success' => false,
                'message' => 'Preencha todos os campos'
            ];

        $presence = auth()->user()->presences()->where('date', '=', date("Y-m-d"))->update(
            array(
                'check_out' => date('H:i'),
                'loc_x_o'   => $locx,
                'loc_y_o'   => $locy,
                'loc_c_o'   => $locc,
                'status'    => 2,
                'conf_o'    => $confiabilidade,
            )
        );

        if ($presence) 
            return [
                'success' => true,
                'message' => 'Registro de Saída efetuado com sucesso!'
            ];

        return [
            'success' => false,
            'message' => 'Falha no registro, tente novamente'
        ];
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
