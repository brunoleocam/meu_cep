<?php

class CepModel {
    public function buscarCep($cep) {
        // Array com as URLs das APIs
        $urls = [
            'viacep'    => "https://viacep.com.br/ws/$cep/json/",
            'brasilapi' => "https://brasilapi.com.br/api/cep/v2/$cep",
            'opencep'   => "https://opencep.com.br/api/v1/cep/$cep"
        ];
    
        // Inicializa o multi-cURL
        $multiCurl = curl_multi_init();
        $curlHandles = [];
    
        // Configura cada requisição cURL
        foreach ($urls as $key => $url) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Defina os timeouts (em segundos) para conexão e execução
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            $curlHandles[$key] = $ch;
            curl_multi_add_handle($multiCurl, $ch);
        }
    
        // Executa as requisições de forma paralela
        $running = null;
        do {
            curl_multi_exec($multiCurl, $running);
            // Aguarda até que haja atividade em alguma conexão
            curl_multi_select($multiCurl);
        } while ($running > 0);
    
        // Processa as respostas
        $results = [];
        foreach ($curlHandles as $key => $ch) {
            $response = curl_multi_getcontent($ch);
            $data = json_decode($response, true);
    
            // Se a API retornar um erro, marcamos como nulo
            if (isset($data['erro']) || isset($data['error'])) {
                $results[$key] = null;
            } else {
                $results[$key] = $data;
            }
    
            curl_multi_remove_handle($multiCurl, $ch);
            curl_close($ch);
        }
        curl_multi_close($multiCurl);
    
        // Verifica qual API retornou um resultado válido e prioriza a ordem:
        // Primeiramente ViaCEP, depois BrasilAPI, e por último OpenCEP.
        if ($results['viacep'] !== null) {
            return $results['viacep'];
        } elseif ($results['brasilapi'] !== null) {
            return $results['brasilapi'];
        } elseif ($results['opencep'] !== null) {
            return $results['opencep'];
        } else {
            return ['error' => 'CEP não encontrado'];
        }
    }
    

    private function formatarDados($data) {
        return [
            "CEP" => $data["cep"] ?? "",
            "Logradouro" => $data["logradouro"] ?? $data["street"] ?? "",
            "Complemento" => $data["complemento"] ?? "",
            "Bairro" => $data["bairro"] ?? $data["neighborhood"] ?? "",
            "Localidade" => $data["localidade"] ?? $data["city"] ?? "",
            "UF" => $data["uf"] ?? $data["state"] ?? "",
            "IBGE" => $data["ibge"] ?? "",
            "DDD" => $data["ddd"] ?? "",
        ];
    }
}
