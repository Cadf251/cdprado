import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

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