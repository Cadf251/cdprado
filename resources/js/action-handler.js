/**
 * ActionHandler — dispara ações AJAX a partir de atributos data-* no HTML.
 *
 * Uso no Blade:
 *   <button
 *     data-action
 *     data-url="/leads/123/archive"
 *     data-target="#lead-card-123"
 *     data-confirm="true"
 *     data-confirm-title="Arquivar lead?"
 *     data-confirm-text="Essa ação pode ser desfeita."
 *   >Arquivar</button>
 *
 * Tipos de ação (data-action-type):
 *   (vazio)   → POST com CSRF
 *   "get"     → GET simples
 *   "overlay" → GET, resultado vai para o overlay
 */

import { processResponse } from './process-response.js';

// ─── Bootstrap: delega todos os cliques com data-action ──────────────────────

document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-action]');
    if (!btn) return;

    e.preventDefault();
    ActionHandler.run(btn);
});

// ─── Core ─────────────────────────────────────────────────────────────────────

export const ActionHandler = {

    run(btn) {
        const ds = btn.dataset;

        if (!ds.url) {
            console.warn('[ActionHandler] data-url ausente em', btn);
            return;
        }

        if (ds.confirm) {
            // Integre aqui seu sistema de confirmação (modal, window.confirm, etc.)
            const ok = window.confirm(ds.confirmText ?? ds.confirmTitle ?? 'Confirmar?');
            if (!ok) return;
        }

        ActionHandler.execute(btn);
    },

    execute(btn) {
        const ds = btn.dataset;
        const url = ds.url;
        const type = ds.actionType ?? 'post';
        const target = ds.target ?? null;

        // Efeito de carregamento
        if (target) ActionHandler.setLoading(target, true);

        // Monta body com data-param-* do botão
        const body = new URLSearchParams();

        Object.entries(ds).forEach(([key, val]) => {
            if (!key.startsWith('param')) return;
            // data-param-lead-id → lead_id
            const name = key
                .replace(/^param/, '')
                .replace(/([A-Z])/g, '_$1')
                .toLowerCase()
                .replace(/^_/, '');
            body.append(name, val);
        });

        // Coleta campos dinâmicos via data-include=".seletor"
        if (ds.include) {
            document.querySelectorAll(ds.include).forEach(el => {
                if (el.name && el.value !== undefined) {
                    body.append(el.name, el.value);
                }
            });
        }

        const callback = (response) => {
            if (target) ActionHandler.setLoading(target, false);
            processResponse(response, btn);
        };

        if (type === 'get' || type === 'overlay') {
            ActionHandler.get(url, callback);
        } else {
            ActionHandler.post(url, body, callback);
        }
    },

    // ─── HTTP helpers ──────────────────────────────────────────────────────

    post(url, body, callback, btn = null) {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

        if (btn) {
            btn._originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = 'Salvando...';
        }

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: body.toString(),
        })
            .then(r => r.json())
            .then(response => {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = btn._originalText;
                }
                callback(response);
            })
            .catch(err => {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = btn._originalText;
                }
                console.error('[ActionHandler] Erro na requisição:', err);
            });
    },

    get(url, callback) {
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then(r => r.json())
            .then(callback)
            .catch(err => console.error('[ActionHandler] Erro na requisição:', err));
    },

    // ─── UI helpers ────────────────────────────────────────────────────────

    setLoading(selector, loading) {
        const el = document.querySelector(selector);
        if (!el) return;
        el.classList.toggle('is-loading', loading);
        el.setAttribute('aria-busy', loading);
    },
};