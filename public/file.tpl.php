<link rel="stylesheet" href="https://bootstraptema.ru/plugins/2015/bootstrap3/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="../css/file.css" />
<link rel="stylesheet" href="../css/style-like-button.css" />
<link href="../css/style-header.css" rel="stylesheet">
<link href="../css/style-logo.css" rel="stylesheet">
<link href="../css/styles-button.css" rel="stylesheet">
<script src="https://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>
<script src="https://bootstraptema.ru/plugins/2015/b-v3-3-6/bootstrap.min.js"></script>
<title>Информация о файле</title>

<div id = "wrap">
    <header>
    <p class="logo">
    <a href="/">
        <img src="/public/logo.png" alt="Логотип в шапке" width="80" height="80" />
    </a>
    </p>
    </header>

</div>

<div class="container">
  <div id="main">
    <div class="row" id="real-estates-detail">
      <div class="col-lg-4 col-md-4 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              <div class="text-center">
                <strong>Пользователь сайта</strong>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="text-center" id="author">
              <img src="/public/avatar.png">
              <h3><?php echo $pageData['user']['name']; ?></h3>
              <?php if ($pageData['user']['role_id'] == 1): ?>
                <small class="label label-primary"><?php echo $pageData['role']['name']; ?></small>
              <?php endif; ?> 

              <?php if ($pageData['user']['role_id'] == 2): ?>
                <small class="label label-warning"><?php echo $pageData['role']['name']; ?></small>
              <?php endif; ?> 

              <?php if ($pageData['user']['role_id'] == 3): ?>
                <small class="label label-danger"><?php echo $pageData['role']['name']; ?></small>
              <?php endif; ?> 
              <br>
              <br>
                <?php if ($pageData['session']['role_id'] == 3 && $pageData['user']['role_id'] != 3): ?>
                        <form method="post" action="/file?hash=<?php echo $pageData['file']['hash']; ?>">
                            <button type="submit" class="label label-danger" name="delete_user" 
                                            value="<?php echo $pageData['user']['id']; ?>">Удалить аккаунт</button>
                        </form>
                    <?php endif; ?> 
              <tr>
                <td class="active">Рейтинг пользователя:</td>
                <span class="colortext"></span>
                <?php echo $pageData['user']['raiting']; ?> &nbsp;
                <form method="post" action="/file?hash=<?php echo $pageData['file']['hash']; ?>">
                    <button class="dislike" type="submit" name="score_user" value="-1">
                        <i class="fa fa-thumbs-o-down" aria-hidden="flas"></i>
                        <li><?php echo $pageData['user']['score']['count_dislikes']; ?></li>
                    </button>

                    <button class="like" type="submit" name="score_user" value="1">
                        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                        <li><?php echo $pageData['user']['score']['count_likes']; ?></li>
                    </button>
                </form> 
            </tr>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-8 col-xs-12">
        <div class="panel">
          <div class="panel-body">
            <ul id="myTab" class="nav nav-pills">
              <li class="active"><a href="#detail" data-toggle="tab">О файле</a></li>
              <li class=""><a href="list?page=1">К списку файлов</a></li>

              <li class=""><a href="#contact" data-toggle="tab">Написать комментарий</a></li>

              <?php if ($pageData['session']['role_id'] > 1): ?>
                        <form method="post" action="/file?hash=<?php echo $pageData['file']['hash']; ?>">
                            &#8195;<button type="submit" class="label label-danger" style="height:40px;width:100px" name="delete_file" 
                                        value="<?php echo $pageData['file']['id']; ?>">Удалить файл</button>
                        </form>
              <?php endif; ?> 

            </ul>
            <div id="myTabContent" class="tab-content">
              <hr>
              <div class="tab-pane fade active in" id="detail">
                <h4>Информация о файле</h4>
                <table class="table table-th-block">
                  <tbody>
                    <tr>
                      <td class="active">Загружен:</td>
                      <td><?php echo $pageData['file']['date_upload']; ?></td>
                    </tr>
                    <tr>
                      <td class="active">Название:</td>
                      <td><?php echo $pageData['file']['name']; ?></td>
                    </tr>
                    <tr>
                      <td class="active">md5:</td>
                      <td><?php echo $pageData['file']['hash']; ?></td>
                    </tr>
                    <tr>
                      <td class="active">Тип:</td>
                      <td><?php echo $pageData['file']['type']; ?></td>
                    </tr>
                    <tr>
                      <td class="active">Размер:</td>
                      <td><?php echo $pageData['file']['size']; ?></td>
                    </tr>
                    <tr>
                      <td class="active">Рейтинг файла:</td>
                      <span class="colortext"></span>
                      <td><?php echo $pageData['file']['raiting']; ?> &nbsp;
                      </td>
                    </tr>
                    <tr>
                      <td height="80" class="active">Оценивание:</td>
                      <form method="post" action="/file?hash=<?php echo $pageData['file']['hash']; ?>">
                      <td><button class="dislike" type="submit" name="score_file" value="-1">
                            <i class="fa fa-thumbs-o-down" aria-hidden="flas"></i>
                            <li><?php echo $pageData['file']['score']['count_dislikes']; ?></li>
                        </button>
                       
                        <button class="like" type="submit" name="score_file" value="1">
                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            <li><?php echo $pageData['file']['score']['count_likes']; ?></li>
                        </button>
                        </td>
                    </form>
                    </tr>
                    <tr>
                      <td class="active">Ссылка для скачивания:</td>
                      <td>
                      <form method="post" action="/download">
                            <button type="submit" name="download" value="<?php echo $pageData['file']['hash']; ?>">Скачать</button>
                      </form>                  
                      </td>                                           
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="contact">
                <p></p>
                <form method="post" action="/file?hash=<?php echo $pageData['file']['hash']; ?>">
                  <div class="form-group">
                    <label>Текст Вашего комментария</label>
                    <textarea type="text" class="form-control rounded" name="comment" style="height: 100px;"></textarea>
                    <p class="help-block">Текст комментария будет отправлен на страницу файла</p>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success" data-original-title="" title="">Отправить</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php foreach($pageData['comment'] as $comment): ?>
    <div class ="panel panel-default">
    <h5>&nbsp;Дата комментария: <?php echo $comment['date_create']; ?></h3>
    <h4>&#8195;<?php echo $comment['role_name']; ?>: <?php echo $comment['name']; ?> </h4>
    <h3>&#8195;<?php echo $comment['content']; ?></h3>
    <?php if ($pageData['session']['role_id'] > 1): ?>
        <form method="post" action="/file?hash=<?php echo $pageData['file']['hash']; ?>">
            &#8195;<button type="submit" class="label label-danger" name="delete_comment" 
                        value="<?php echo $comment['id']; ?>">Удалить</button>
        </form>
    <?php endif; ?> 
    </div>
<?php endforeach; ?> 

</div>
<!-- /.main -->
</div>
<!-- /.container -->