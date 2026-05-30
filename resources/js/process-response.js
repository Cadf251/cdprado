/**
 * process-response.js
 *
 * Interpreta o JSON do OperationResult e executa as instruções de UI.
 */

import { openOverlay, closeOverlay } from './overlay.js';

export function processResponse(response, triggerEl = null) {

    if (response.csrf_token) {
        refreshCsrf(response.csrf_token);
    }

    if (Array.isArray(response.updates)) {
        response.updates.forEach(applyUpdate);
    }

    if (response.close_overlay) {
        closeOverlay();
    }

    if (response.alert && response.messages) {
        showAlert(response.success, response.alert, response.messages);
    }

    if (response.redirect) {
        window.location.href = response.redirect;
    }
}

function applyUpdate({ type, target, html }) {
    switch (type) {
        case 'update': {
            const el = document.querySelector(target);
            if (el) el.outerHTML = html;
            break;
        }
        case 'append': {
            const container = document.querySelector(target);
            if (container) container.insertAdjacentHTML('beforeend', html);
            break;
        }
        case 'remove': {
            const el = document.querySelector(target);
            if (el) el.remove();
            break;
        }
        case 'overlay': {
            openOverlay(html);
            break;
        }
        default:
            console.warn('[processResponse] Instrução desconhecida:', type);
    }
}

function refreshCsrf(token) {
    document.querySelector('meta[name="csrf-token"]')?.setAttribute('content', token);
    document.querySelectorAll('input[name="_token"]').forEach(el => el.value = token);
}

function showAlert(success, label, message) {
    // TODO: conecte ao seu sistema de toast
    console[success ? 'info' : 'error'](`${label} — ${message}`);
}
