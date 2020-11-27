<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/resources/trix/trix.css">
    <link rel="stylesheet" href="/resources/pnotify/PNotify.css">
    <link rel="stylesheet" href="/resources/pnotify/BrightTheme.css">
    <link rel="stylesheet" href="/css/style.css">

    <title>Painel adminstrativo da school of net</title>
  </head>
  <body class="d-flex flex-column">
    <div id="header">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="" class="navbar-brand">AdminSON</a>
        <span class="navbar-text">
          Painel adminstrativo da school of net
        </span>
    </div>
    <div id="main">
      <div class="row">
        <div class="col">
          <ul id="main-menu" class="nav flex-column nav-pills bg-secondary text-white p-2">
            <li class="nav-item">
              <span href="" class="nav-link text-white-50"><small>MENU</small></span>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link active">Páginas</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">Usuários</a>
            </li>
          </ul>
        </div>
        <div id="content" class="col-10">
          <?php include $content ?>
        </div>
      </div>  
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="/resources/trix/trix.js"></script>
    <script src="/resources/pnotify/PNotify.js"></script>
   
    <script>
        document.addEventListener('trix-attachment-add', function () {
          const attachment = event.attachment;
          if (!attachment.file) {
              return;
          }
          const form = new FormData();
          form.append('file', attachment.file);
          $.ajax({
              url: '/admin/upload/image',
              method: 'POST',
              data: form,
              contentType: false,
              processData: false,
              xhr: function () {
                const xhr = $.ajaxSettings.xhr();
                xhr.upload.addEventListener('progress', function (e) {
                  let progress = e.loaded / e.total * 100;
                  attachment.setUploadProgress(progress);
                })
                return xhr;
              }
          }).done(function (response){
              console.log(response);
              attachment.setAttributes({
                  url: response,
                  href: response
              });
          }).fail(function () {
              console.log('deu errado');
          });
        });

      <?php flash(); ?>

      const confirmEl = document.querySelector('.confirm');

      if (confirmEl) {
          confirmEl.addEventListener('click', function(e) {
            e.preventDefault();
            if(confirm('Tem certeza que quer realizar esta ação?')) {
            window.location = e.target.getAttribute('href');
            }
        });
      }
      
    </script>
  </body>
</html>