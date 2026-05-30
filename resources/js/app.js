import './bootstrap';
import Alpine from 'alpinejs';
import { validateStep, validateField } from './form-handler.js';
import { ActionHandler } from './action-handler.js';
import { processResponse } from "./process-response.js";

window.Alpine = Alpine;
window.validateField = validateField;

// Não lembro pra que serve
window.ProjectManager = {
  async toggleStatus(id, currentStatus) {
    try {
      const res = await axios.patch(`/projetos/${id}/status`);
      return res.data.new_status;
    } catch (e) {
      alert("Erro ao atualizar");
      return currentStatus;
    }
  }
}

document.addEventListener('alpine:init', () => {
  Alpine.data('formWizard', (currentStep, totalStep) => ({
    currentStep: 1,
    totalSteps: 1,
    wrapper: null,

    init() {
      this.wrapper = this.$el;
      this.totalSteps = Number(this.$el.querySelector('form').dataset.max);
    },

    get progress() {
      return (this.currentStep / this.totalSteps) * 100;
    },

    next() {
      const stepEl = this.wrapper.querySelector(`.form-step[data-step="${this.currentStep}"]`);
      if (!validateStep(stepEl)) return;

      const form = this.wrapper.querySelector('form');
      const url = form.action;
      const saveAllSteps = form.dataset.saveAllSteps === '1';
      const isLastStep = this.currentStep === this.totalSteps;

      // se estiver com a opção de salvar a cada etapa ou for a última, faz uma requisição
      if (saveAllSteps || isLastStep) {
        const body = new URLSearchParams(new FormData(form));

        ActionHandler.post(url, body, (response) => {
            processResponse(response);
            if (response.success && !isLastStep) this.currentStep++;
        }, this.$el);
      } else {
        if (this.currentStep < this.totalSteps) this.currentStep++;
      }
    },

    prev() {
      if (this.currentStep > 1) this.currentStep--;
    }
  }));
});

Alpine.start();