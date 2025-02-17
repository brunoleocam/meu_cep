document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('cepForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        // Oculta a div de resultado e exibe o spinner
        document.getElementById('resultado').classList.add('hidden');
        document.getElementById('spinner').classList.remove('hidden');

        const cep = document.getElementById('cep').value.replace(/\D/g, ''); // Remove caracteres não numéricos

        if (cep.length !== 8) {
            alert("CEP inválido. Digite um CEP com 8 dígitos.");
            // Oculta spinner se ocorrer erro de validação
            document.getElementById('spinner').classList.add('hidden');
            return;
        }

        console.log("Buscando CEP:", cep); 
        const response = await fetch(`index.php?url=busca/consultar/${cep}`);
        console.log("Resposta da API:", response); 
        const data = await response.json();

        // Oculta o spinner
        document.getElementById('spinner').classList.add('hidden');
        
        if (data.error) {
            alert("CEP não encontrado!");
            return;
        }

        const infoList = document.getElementById('infoList');
        infoList.innerHTML = ''; // Limpa resultados anteriores

        for (const [key, value] of Object.entries(data)) {
            const li = document.createElement('li');
            li.classList.add("flex", "items-center", "justify-between", "py-2", "w-full");
            // Capitaliza a primeira letra da chave
            const keyFormatted = key.toUpperCase();
            
            li.innerHTML = `
                <span class="whitespace-nowrap">${keyFormatted}: ${value}</span>
                <div class="flex items-center">
                    <button onclick="copyText('${value}', this)" class="text-blue-500 hover:text-blue-600 transition delay-150 duration-700 ease-in-out hover:-translate-y-0.5 hover:scale-110">
                        <i class="fas fa-copy"></i>
                    </button>
                    <span class="copy-message text-xs text-green-500 ml-2"></span>
                </div>
            `;
            infoList.appendChild(li);
        }
        
        // Exibe a div de resultado
        document.getElementById('resultado').classList.remove('hidden');
    });
});

function copyText(text, button) {
    // Cria um elemento textarea temporário
    const textarea = document.createElement('textarea');
    textarea.value = text; // Define o valor como o texto que queremos copiar

    // Adiciona o textarea ao body
    document.body.appendChild(textarea);
    
    // Seleciona o texto
    textarea.select();
    textarea.setSelectionRange(0, 99999); // Para dispositivos móveis

    // Tenta copiar o texto
    try {
        document.execCommand('copy'); // Copia o texto selecionado
        let copyMessage = button.nextElementSibling; // Pega o próximo elemento ao lado do botão
        if (!copyMessage || !copyMessage.classList.contains("copy-message")) {
            copyMessage = document.createElement('span');
            copyMessage.className = "copy-message text-xs text-green-500 ml-2"; // Estilo do texto
            button.parentNode.appendChild(copyMessage);
        }
        
        copyMessage.textContent = "Copiado"; // Atualiza o texto
        setTimeout(() => {
            copyMessage.textContent = ""; // Limpa a mensagem após 2 segundos
        }, 2000);
    } catch (err) {
        console.error('Erro ao copiar o texto: ', err);
        alert("Erro ao copiar o texto. Tente novamente.");
    }

    // Remove o textarea do DOM
    document.body.removeChild(textarea);
}