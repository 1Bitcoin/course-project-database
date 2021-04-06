<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageData['title'];?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/simplePagination.css" />
    <script src="../js/simplePagination.js"></script>
</head>
<body>
    <table class="table table-bordered">  
        <thead>  
        <tr>  
            <th>Имя файла</th>  
            <th>Дата загрузки</th> 
            <th>Рейтинг</th> 
            <th>Размер</th> 
        </tr>  
        </thead>  
        <tbody>   
            <?php foreach($pageData['files'] as $file): ?>
                <tr>  
                    <td><?php echo $file["name"]; ?></td>  
                    <td><?php echo $file["date_upload"]; ?></td>   
                    <td><?php echo $file["raiting"]; ?></td>   
                    <td><?php echo $file["size"]; ?></td>   
                </tr>
            <?php endforeach; ?> 
        </tbody>  
    </table>
        
    <?php  
    $total_records = $pageData['count'];  
    $total_pages = ceil($total_records / $pageData['limit']);  
    $pagLink = "<nav><ul class='pagination'>";  

    for ($i = 1; $i <= $total_pages; $i++) 
    {  
        $pagLink .= "<li><a href='list?page=".$i."'>".$i."</a></li>";  
    };
    echo $pagLink . "</ul></nav>";  
    ?>

<script>
$(document).ready(function(){
    $('.pagination').pagination({
        items: <?php echo $total_records;?>,
        itemsOnPage: <?php echo $pageData['limit'];?>,
        cssStyle: 'light-theme',
        currentPage : <?php echo $pageData['page'];?>,
        hrefTextPrefix : 'list?page='
    });
});
</script>


</body>
</html>