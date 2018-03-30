<?php
require_once("connect.php"); // MySQL 접속을 위한 connect.php 과정
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/studying.css" rel="stylesheet">
    <!-- 추가 CSS -->
    <style media="screen">
    article {
      padding:10px;
    }
    div.panel{
      padding:20px;
    }
    </style>
  </head>

  <body>
    <div class="container">
      <header class="jumbotron"> <!-- 헤더 부분의 제목과 그림 표시부분 -->
        <div class="row">
          <div class="col-md-3">
            <img src="img2/title2.PNG" class="img-thumbnail" alt="이미지를 불러올수 없습니다." height="100px">
          </div>
          <div class="col-md-9">
            <a href="http://localhost:8080/studying.php"><p class="text-center"><br><br><h1><strong>     I'm still Studying..</strong></h1><br></p></a>
          </div>
        </div>
      </header>
      <div class="row">
        <div class="col-md-3">
          <nav> <!-- 메뉴 부분을 위한 Navigation 태그 및 링크 -->
            <ul class="nav nav-pills nav-stacked">
              <li role="presentation"><a href="http://localhost:8080/studying.php?id=1"> About me </a></li>
              <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                  Study <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="http://localhost:8080/studying.php?id=2">ALL</a></li>
                  <li><a href="http://localhost:8080/studying.php?id=2&tag=1">Life</a></li>
                  <li><a href="http://localhost:8080/studying.php?id=2&tag=2">CSE</a></li>
                  <li><a href="http://localhost:8080/studying.php?id=2&tag=3">HTML</a></li>
                  <li><a href="http://localhost:8080/studying.php?id=2&tag=4">CSS</a></li>
                  <li><a href="http://localhost:8080/studying.php?id=2&tag=5">JavaScript</a></li>
                  <li><a href="http://localhost:8080/studying.php?id=2&tag=6">DB</a></li>
                  <li><a href="http://localhost:8080/studying.php?id=2&tag=7">PHP</a></li>
                  <li><a href="http://localhost:8080/studying.php?id=2&tag=8">ETC</a></li>
                </ul>
              </li>
              <li role="presentation"><a href="http://localhost:8080/studying.php?id=3"> Diary </a></li>
              <li role="presentation"><a href="http://localhost:8080/studying.php?id=4"> Book </a></li>
              <li role="presentation"><a href="http://localhost:8080/studying.php?id=5"> Travel </a></li>
            </ul>
          </nav>
        </div>
        <div class="col-md-9">
          <article>
            <?php
            if(empty($_GET['id']) === false) {
              if($_GET['id'] == 3 | $_GET['id'] == 4) { // Diary, Book 부분에 표시할 글 등록 버튼 생성
                $_temp = $_GET['id'];
                echo '<input class="btn btn-default" type="button" value="글 등록" onclick={location.href="http://localhost:8080/studying.php?id=6&cat='.$_temp.'"}><br><br>';
              } else if($_GET['id'] == 2) { // Study 부분에 표시할 글 등록 버튼 생성
                echo '<input class="btn btn-default" type="button" value="글 등록" onclick={location.href="http://localhost:8080/studying.php?id=7"}><br><br>';
              }
            }

            if(empty($_GET['id']) === true) { // 첫 화면
              echo '<strong>Hello, Thank you for visiting here!!<br> Please try to use navigation of left side. thanks. </strong>';
            } else if($_GET['id'] == 1) { // DB에서 About 테이블을 쿼리하여 글 화면에 출력
              echo '<img src="img2/minseok.png" class="center-block">';
              $result = mysqli_query($conn, "SELECT * FROM about");
              $row = mysqli_fetch_assoc($result);
              echo '<h2>'.$row['title'].'</h2>';
              echo '<h4>'.$row['created'].'</h4>';
              echo $row['description'];
              echo '<br><br><br><br><br><br><br>';
            } else if($_GET['id'] == 2) { // DB에서 Study 테이블을 쿼리하여 글 화면에 출력
              if(empty($_GET['tag']) == true) {
                $result = mysqli_query($conn, "SELECT * FROM study ORDER BY id desc");
                while( $row = mysqli_fetch_assoc($result)){
                  echo '<div class="panel panel-default">';
                  echo '<div class="panel-heading">';
                  echo '<h2><p class="text-center">'.$row['title'].'</p></h2>';
                  echo '<h5><p class="text-left">'.$row['created'].'</p></h5>';
                  echo '<h4><p class="text-right">'.$row['author'].'</p></h4>';
                  echo '</div><br>';
                  echo $row['content'];
                  echo '<br><br><br><br><br><br><br>';
                  echo '</div>';
                }
              } else {
                $temp = "SELECT * FROM study WHERE tag = ".$_GET['tag']." ORDER BY id desc";
                $result = mysqli_query($conn, $temp);
                while( $row = mysqli_fetch_assoc($result)){
                  echo '<div class="panel panel-default">';
                  echo '<div class="panel-heading">';
                  echo '<h2><p class="text-center">'.$row['title'].'</p></h2>';
                  echo '<h5><p class="text-left">'.$row['created'].'</p></h5>';
                  echo '<h4><p class="text-right">'.$row['author'].'</p></h4>';
                  echo '</div><br>';
                  echo $row['content'];
                  echo '<br><br><br><br><br><br><br>';
                  echo '</div>';
                }
              }
            } else if($_GET['id'] == 3) { // DB에서 Diary 테이블을 쿼리하여 글 화면에 출력
              $result = mysqli_query($conn, "SELECT * FROM diary ORDER BY id desc");
              while( $row = mysqli_fetch_assoc($result)){
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading">';
                echo '<h2><p class="text-center">'.$row['title'].'</p></h2>';
                echo '<h5><p class="text-left">'.$row['created'].'</p></h5>';
                echo '<h4><p class="text-right">'.$row['author'].'</p></h4>';
                echo '</div><br>';
                echo $row['content'];
                echo '<br><br><br><br><br><br><br>';
                echo '</div>';
              }
            } else if($_GET['id'] == 4) { // DB에서 Book 테이블을 쿼리하여 글 화면에 출력
              $result = mysqli_query($conn, "SELECT * FROM book ORDER BY id desc");
              while( $row = mysqli_fetch_assoc($result)){
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading">';
                echo '<h2><p class="text-center">'.$row['title'].'</p></h2>';
                echo '<h5><p class="text-left">'.$row['created'].'</p></h5>';
                echo '<h4><p class="text-right">'.$row['author'].'</p></h4>';
                echo '</div><br>';
                echo $row['content'];
                echo '<br><br><br><br><br><br><br>';
                echo '</div>';
              }
            } else if($_GET['id'] == 5) { // 업데이트 돼야할 Travel 부분
              echo 'Travel to be continued .....';
              echo '<br><br><br><br><br><br><br>';
            } else if($_GET['id'] == 6) { // 글등록 세션
              if($_GET['cat'] == 3){
                echo'<form action="process.php" method="post">';
                echo'<select name="select" class="form-control">';
                echo'  <option>diary</option>';
                echo'</select>';
              } else {
                echo'<form action="process.php" method="post">';
                echo'<select name="select" class="form-control">';
                echo'  <option>book</option>';
                echo'</select>';
              }
              ?>

              <!-- process.php 에서 처리하도록 한다 -->
                <div class="form-group"> <!-- 글 등록을 위한 Form -->
                  <br>
                  <label for="title">Title</label>
                  <input name="title" class="form-control" type="text" id="title"><br>
                  <label for="content">Content</label>
                  <textarea name="content" class="form-control" id="content" rows="8" cols="80"></textarea><br>
                  <label for="pw">Password</label>
                  <input name="pw" class="form-control" type="text" id="pw"><br>
                  <input class="btn btn-default" type="submit" value="Submit">
                </div>
              </form>

              <?php
            } else if($_GET['id'] == 7) { // 글등록 세션
              ?>

              <form action="process.php" method="post"> <!-- process.php 에서 처리하도록 한다 -->
                <div class="form-group"> <!-- 글 등록을 위한 Form -->
                  <select name="select" class="form-control">
                    <option>study</option>
                  </select>
                <br>
                  <label for="category">Category</label>
                  <select name="category" class="form-control">
                    <option>Life</option>
                    <option>CSE</option>
                    <option>HTML</option>
                    <option>CSS</option>
                    <option>JavaScript</option>
                    <option>DB</option>
                    <option>PHP</option>
                    <option>ETC</option>
                  </select>
                  <br>
                  <label for="title">Title</label>
                  <input name="title" class="form-control" type="text" id="title"><br>
                  <label for="content">Content</label>
                  <textarea name="content" class="form-control" id="content" rows="8" cols="80"></textarea><br>
                  <label for="pw">Password</label>
                  <input name="pw" class="form-control" type="text" id="pw"><br>
                  <input class="btn btn-default" type="submit" value="Submit">
                </div>
              </form>

              <?php
            } else { // id값 잘못되었을때 출력되는 부분
              echo '<strong> This Shouldn\'t be executed !!!! </strong><br>';
              echo '<strong> Wrong Access Way. </strong>';
            }
            ?>
          </article>
        </div>
      </div>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
    </div>
  </body>
</html>
