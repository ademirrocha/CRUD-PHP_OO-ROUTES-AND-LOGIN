<?php
namespace classes\requests\users;
include $GLOBALS['PATH'] . '/helpers/ValidateHelper.php';
use helpers\ValidateHelper;

class GetFindRequest {

    public function rules(){
        return [
            'id' => 'required',
            'id' => 'exists:users'
        ];
    }

    public function validate(){
        $errors = new ValidateHelper;
        $errors = $errors->validateRules($this->rules(), 'GET');

        return $this->messages($errors);
    }

    public function messages($errors){
        $messages = array();
        foreach($errors as $key => $erro){
            foreach($erro as $index => $is_validate){
                $err = explode('.', $index);
                if($err[1] == 'required'){
                    $messages[$err[0]] = 'Obrigatório o envio do '. $err[0];
                }
                if($err[1] == 'exists:users'){
                    $messages[$err[0]] = 'ID inválido ou usuário não encontrado';
                }
                
            }
        }
        return $messages;
    }

}