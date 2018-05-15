<?php
    $username = 'root';
    $password = '';
    
    $database = new PDO('mysql:host=localhost;dbname=messageboard;charset=UTF8;',$username,$password);
    
    $sql = 'SELECT * FROM messages WHERE id = :id';
    $statement = $database->prepare($sql);
    $statement->bindParam(':id',$_POST['edit_id']);
    $statement->execute();
    
    $record = $statement->fetch();
    
    $statement = null;
    $database = null;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>MessageBoard</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="message-board.php">MessageBoard</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="message-board-post.php">新規メッセージの投稿</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>    
        <div class="container">
            
        <h2>メッセージ内容</h2>
         <?php
                $edit_id = $record['id'];
                $edit_title = $record['post_title'];
                $edit_message = $record['post_message'];
        ?>
        <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td><?php print $edit_id;?></td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td><?php print $edit_title;?></td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td><?php print $edit_message;?></td>
        </tr>
    </table>
        <h2>投稿編集</h2>
        <form action="message-board.php" method="POST">
            <input type ="hidden" name = "edit_id" value = <?php print $edit_id;?>>
            <input class="form-control" type="text" name="edit_title" value= <?php print $edit_title;?> required>
            <input class="form-control" type="text" name="edit_message" value=<?php print $edit_message;?> required>
            <input class="btn btn-default" type="submit" name="submit_edit_post" value="編集">
        </form>
        
        <h2>投稿削除</h2>
        <form action="message-board.php" method="POST">
            <input type ="hidden" name = "delete_id" value = <?php print $edit_id;?>>
            <input class="btn btn-danger" type="submit" name="submit_delete_post" value="削除">
        </form>
        
        
    </body>
</html>