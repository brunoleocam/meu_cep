<?php

require_once '../app/model/CepModel.php';

class BuscaController {
    public function consultar($cep) {
        $cepModel = new CepModel();
        $result = $cepModel->buscarCep($cep); // Certifique-se de que este método exista e funcione corretamente
    
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'CEP não encontrado']);
        }
    }
    
}
