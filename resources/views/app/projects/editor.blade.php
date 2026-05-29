@extends("layouts.editor")

@section("html")

<iframe id="editor-frame"></iframe>

<script>
    // 1. Pegamos o HTML do PHP de forma segura
    const rawHtml = @json($html);

    // 2. Criamos um "arquivo virtual" na memória do navegador (Blob)
    const blob = new Blob([rawHtml], { type: 'text/html' });
    const url = URL.createObjectURL(blob);

    // 3. Apontamos o iframe para essa URL virtual
    const iframe = document.getElementById('editor-frame');
    iframe.src = url;

    iframe.onload = () => {
        const doc = iframe.contentDocument || iframe.contentWindow.document;

        // Injetamos um CSS dinâmico dentro do Iframe para o hover ficar profissional
        const style = doc.createElement('style');
        style.textContent = `
            .is-editable {
                outline: 2px dashed #00ced1 !important; s
            }
            .is-editable:hover { 
                outline: 2px solid #055ec5 !important; 
                cursor: pointer !important;
                transition: all 0.2s;
            }
            .is-editing-now { 
                outline: 2px solid #6500d1 !important; 
                background: rgba(182, 182, 182, 0.24) !important;
            }
        `;
        doc.head.appendChild(style);

        // Mapeamos todos os elementos que têm data-edit
        const editableElements = doc.querySelectorAll('[data-edit]');

        editableElements.forEach(el => {
            // Adicionamos a classe visual no pai
            el.classList.add('is-editable');

            // Eventos de clique
            el.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                // Remove marcação de outros elementos
                editableElements.forEach(item => item.classList.remove('is-editing-now'));
                el.classList.add('is-editing-now');

                // Pegamos os dados do elemento clicado
                const key = el.getAttribute('data-edit');
                const text = el.getAttribute('data-text');

                // Populamos o formulário do seu Painel (SaaS)
                document.querySelector('.js--identifier').value = key;    // Hidden input
                document.querySelector('.js--text').value = text;  // Textarea
                
                // Feedback visual no painel
                document.getElementById('current-key-display').innerText = 'Editando: ' + key;
            });
        });

        // Verifica há alterações na sessão
        const sessionDrafts = @json($drafts);

        console.log(sessionDrafts);
        
        // Percorre a sessão e força os textos no Iframe
        Object.entries(sessionDrafts).forEach(([key, value]) => {
            const el = doc.querySelector(`[data-edit="${key}"]`);
            if (el) {
                el.innerHTML = value;
                el.setAttribute('data-text', value);
                // Dica: adicione uma borda sutil para saber o que já foi alterado
                el.style.outline = "1px solid #00ced1"; 
            }
        });
        
        // Reativa os cliques após o reload
        // initEditorEvents(doc); 
    };

    function initEditorEvents(doc) {
        // doc.querySelectorAll('[data-edit]').forEach(el => {
        //     el.addEventListener('click', (e) => {
        //         e.preventDefault();
        //         document.getElementById('input-key').value = el.dataset.edit;
        //         document.getElementById('input-text').value = el.dataset.text || el.innerText;
        //     });
        // });
    }
</script>
@endsection