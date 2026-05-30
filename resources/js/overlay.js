/**
 * overlay.js
 *
 * Controla o overlay global via um evento customizado.
 * O componente Alpine vive em um único lugar no layout.
 * O resto do código só chama openOverlay(html) ou closeOverlay().
 *
 * No layout Blade, inclua o componente uma única vez:
 *   <x-overlay />
 */

/**
 * Abre o overlay com HTML arbitrário.
 * Chamado pelo processResponse quando chega uma instrução { type: 'overlay' }.
 */
export function openOverlay(html) {
    window.dispatchEvent(new CustomEvent('overlay:open', { detail: { html } }));
}

/**
 * Fecha o overlay.
 * Chamado pelo processResponse quando close_overlay === true.
 */
export function closeOverlay() {
    window.dispatchEvent(new CustomEvent('overlay:close'));
}
