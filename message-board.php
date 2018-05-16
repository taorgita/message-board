<?php
    $username = 'root';
    $password = '';
    
    $database = new PDO('mysql:host=localhost;dbname=messageboard;charset=UTF8;',$username,$password);
   
    if($_POST['post_title'] && $_POST['post_message'] && $_FILES['post_image'])
    {
        $img_dir = './uploads/';
        
        $path_parts = pathinfo($_FILES['post_image']['name']);
        $extension = $path_parts['extension'];
        
        $path_parts = pathinfo($_FILES['post_image']['tmp_name']);
        $img_file_name = sha1($path_parts['basename']);
        
        $img_file_path = $img_dir.$img_file_name.".".$extension;
        move_uploaded_file($_FILES['post_image']['tmp_name'], $img_file_path);
            
        $sql = 'INSERT INTO messages (post_title, post_message, post_image) VALUES(:post_title,:post_message,:post_image)';
        $statement = $database->prepare($sql);
        $statement->bindParam(':post_title',$_POST['post_title']);
        $statement->bindParam(':post_message',$_POST['post_message']);
        $statement->bindParam(':post_image',$img_file_path);
        $statement->execute();
        $statement = null;
    }
    
    if($_POST['delete_id'])
    {
        $sql = 'DELETE FROM messageboard.messages WHERE id = :delete_id';
        $statement = $database->prepare($sql);
        $statement->bindParam(':delete_id',$_POST['delete_id']);
        $statement->execute();
        $statement = null;
    }
    
    if($_POST['edit_id'] && $_POST['edit_title'] && $_POST['edit_message'])
    {
        $sql = 'UPDATE messageboard.messages SET post_title = :edit_title,post_message = :edit_message WHERE id = :edit_id ';
        $statement = $database->prepare($sql);
        $statement->bindParam(':edit_title',$_POST['edit_title']);
        $statement->bindParam(':edit_message',$_POST['edit_message']);
        $statement->bindParam(':edit_id',$_POST['edit_id']);
        $statement->execute();
        $statement = null;
    }


    $sql = 'SELECT * FROM messages ORDER BY created_at DESC';
    
    $statement = $database->query($sql);
    $records = $statement->fetchAll();
    
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
        
<?php
    var_dump($img_file_path);
?>
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
        
        <h2>メッセージ一覧</h2>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タイトル</th>
                    <th>メッセージ</th>
                    <th>画像</th>
                </tr>
            </thead>
            <tbody>
<?php
            if($records)
            {
                foreach ($records as $records) 
                {
                    $post_id = $records['id'];
                    $post_title = $records['post_title'];
                    $post_message = $records['post_message'];
                    $post_image = $records['post_image'];
?>
                    <tr>
                        <form action="message-board-edit.php" method="POST">
                        <td><input type="submit" name="edit_id" value = <?php print $post_id;?>></td>
                        <td><?php print $post_title;?></td>
                        <td><?php print $post_message;?></td>
                        <td><img src="<?php print ($post_image); ?>" alt=""></td>
                        </form>
                    </tr>
<?php
                }
                
            }
?>
    </tbody>
    </table>
    </body>
</html>