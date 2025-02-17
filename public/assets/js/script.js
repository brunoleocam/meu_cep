document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("cep").addEventListener("input", function (e) {
        let value = e.target.value;
        
        // Remove caracteres que não sejam números ou hífen
        value = value.replace(/[^0-9-]/g, "");

        // Remove hífen se não estiver na posição correta
        value = value.replace(/-/g, "");

        // Adiciona o hífen na posição correta
        if (value.length > 5) {
            value = value.substring(0, 5) + "-" + value.substring(5, 8);
        }

        // Atualiza o valor do input
        e.target.value = value;
    });
});
