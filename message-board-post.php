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
           
        <h3>新規投稿</h3>
        <div class="form-group">
        <form action="message-board.php" method="POST" enctype="multipart/form-data">
            <label for="title">タイトル:</label>
            <input class="form-control" type="text" name="post_title" placeholder="タイトルを入力" required>
            
            <label for="content">メッセージ:</label> 
            <input class="form-control" type="text" name="post_message" placeholder="メッセージを入力" required>
            
            <label for="content">画像:</label> 
            <input type="file" name="post_image">
            
            <input class="btn btn-default" type="submit" name="submit_add_post" value="投稿">
        </form>
        </div>
    </body>
</html>