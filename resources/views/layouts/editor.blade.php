<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Editor | My Application</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.scss', 'resources/js/app.js'])
  <style>
    body {
      display: flex;
    }

    .painel {
      width: 25%;
      height: 100vh;
      padding: 32px;
      display: flex;
      flex-direction: column;
      gap: 24px;
      background-color: #fff;
    }

    .site {
      width: 75%;
    }

    .site iframe {
      width: 100% !important;
      max-height: none;
      height: 100vh;
      border: none;
    }

  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  {{-- Preciso do iframe como wrapper do HTML do cliente --}}
  {{-- <iframe src="" frameborder="0"> --}}
  <div class="site">
    @yield("html")
  </div>
  {{-- </iframe> --}}

  {{-- Preciso incluir o HTML do painel --}}
  <aside class="painel">
    <h2 class="titulo titulo--2">Painel de edição</h2>

    <p id='current-key-display'></p>
    <form method="POST" class="form">
      @csrf
      
      <textarea name="content" class="input js--text" rows="4"></textarea>
      <input type="hidden" name="identifier" class="js--identifier" value="">
      <button class="small-btn">Salvar</button>
    </form>

    <form method="POST" action="/projetos/{{ $project->id }}/publicar">
      @csrf
      <button class="small-btn small-btn--blue">Publicar</button>
    </form>
  </aside>
  {{-- Posso jogar o script aqui tbm --}}

</body>
</html>