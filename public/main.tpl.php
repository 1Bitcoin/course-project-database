<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Главная страница</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <!-- Custom styles -->
    <link href="../css/jquery.dm-uploader.min.css" rel="stylesheet">
    <link href="../css/styles-main.css" rel="stylesheet">
    <link href="../css/styles-button-files.css" rel="stylesheet">
  </head>

  <body>

    <main role="main" class="container">

      <h1>Добро пожаловать. Снова.</h1>
      <p class="lead mb-4">
        Для асинхронной загрузки файла на сервер воспользуйтесь формой ниже.
      </p>

      <a href="list" class="button24">Список файлов</a>

      <div class="row">
        <div class="col-md-6 col-sm-12">
          
          <!-- Our markup, the important part here! -->
          <div id="drag-and-drop-zone" class="dm-uploader p-5">
            <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

            <div class="btn btn-primary btn-block mb-5">
                <span>Open the file Browser</span>
                <input type="file" title='Click to add Files' />
            </div>
          </div><!-- /uploader -->

        </div>
        <div class="col-md-6 col-sm-12">
          <div class="card h-100">
            <div class="card-header">
              File List
            </div>

            <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
              <li class="text-muted text-center empty">No files uploaded.</li>
            </ul>
          </div>
        </div>
      </div><!-- /file list -->

      <div class="row">
        <div class="col-12">
           <div class="card h-100">
            <div class="card-header">
              Debug Messages
            </div>

            <ul class="list-group list-group-flush" id="debug">
              <li class="list-group-item text-muted empty">Loading plugin....</li>
            </ul>
          </div>
        </div>
      </div> <!-- /debug -->

    </main> <!-- /container -->

    <footer class="text-center">
        <p><a href="https://www.iu7.ru">www.iu7.ru</a></p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

    <script src="../js/jquery.dm-uploader.min.js"></script>
    <script src="../js/demo-ui.js"></script>
    <script src="../js/demo-config.js"></script>

    <!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
      <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>
  </body>
</html>
