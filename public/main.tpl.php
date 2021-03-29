<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/css/main-styles.css">
</head>
<body>
    <h1>Все файлы</h1>
    <?php foreach($pageData['users'] as $user): ?>
        <p><b><?=htmlspecialchars($user['email'])?></b>:</p>
        <p><?=htmlspecialchars($user['date_create'])?></p>
        <p><?=htmlspecialchars($user['password'])?></p>
        <hr />
    <?php endforeach; ?>
</body>
</html>