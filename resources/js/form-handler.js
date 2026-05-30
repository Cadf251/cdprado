import { Validator } from './validator';

// --- Validação ---
export function validateStep(stepEl) {
  const fields = stepEl.querySelectorAll(".form__campo");
  let isStepValid = true;

  fields.forEach(field => {
    if (!validateField(field)) isStepValid = false;
  });

  return isStepValid;
}

export function validateField(field) {
  const input = field.querySelector("input, textarea, select");
  if (!input) return true;

  const label = field.querySelector("label");
  const isCheckable = ['radio', 'checkbox'].includes(input.type);

  let valueToValidate = input.value;
  if (isCheckable) {
    const isChecked = field.querySelector(`input[name="${input.name}"]:checked`) !== null;
    valueToValidate = isChecked ? "checked" : "";
  }

  const isValid = Validator.validate(input.dataset.validation || input.type, valueToValidate, input.required);

  // Aplica classes visuais
  const targetForClass = isCheckable ? label : input;
  targetForClass.classList.toggle("is-valid", isValid);
  targetForClass.classList.toggle("is-not-valid", !isValid);

  return isValid;
}