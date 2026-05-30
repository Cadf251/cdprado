export const Validator = {
  rules: {
    email: (value) => value.includes("@") && value.includes("."),
    phone: (value) => value.replace(/\D/g, '').length >= 10,
    required: (value) => value.trim() !== "",
    checked: (value) => value === "checked"
  },

  validate(type, value, isRequired) {
    if (!isRequired && value === "") return true;
    const rule = this.rules[type] || this.rules.required;
    return rule(value);
  }
};