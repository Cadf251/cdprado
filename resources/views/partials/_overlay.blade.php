<div
  class="overlay"
  x-data="{
    isOpen: false,
    content: '',
    loadView(viewName) {
      console.log('Buscando view:', viewName);
      fetch(`/get-view/${viewName}`)
        .then(res => res.text())
        .then(html => {
          this.content = html;
          this.isOpen = true;
        })
        .catch(err => console.error('Erro ao carregar:', err));
    }
  }"
  :class="isOpen && 'is-open'" 
  x-show="isOpen"
  @open-modal.window="loadView($event.detail)"
  x-cloak
>
  <button 
    class="overlay__close" 
    @click="isOpen = false; content = ''"
  >
    <i class="fa-solid fa-xmark"></i>
  </button>

  <div class="overlay__content js--overlay-content" x-html="content"></div>
</div>