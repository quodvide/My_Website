<?php
require_once("connect.php");
var_dump($_POST);

if($_POST['pw'] == '111111') { // 비밀번호가 맞을시
  if($_POST['select'] == 'study') { // select태그를 확인하여 어떤 DB에 넣을것인지 변수 설정
    $table = 'study';
    $address = '2';

    $temp = "SELECT `tag_no` FROM tag WHERE `tag_name` = '".$_POST['category']."';";
    $tag = mysqli_query($conn, $temp); // study 테이블에 넣기위해 tag값 추출
    $row = mysqli_fetch_assoc($tag);

    $_POST['content'] = nl2br($_POST['content']); // 컨텐트안의 엔터를 <br>로 바꾸어주는 함수
    $sql = "INSERT INTO ".$table." (`title`, `content`, `created`, `tag`) VALUES ('".$_POST['title']."', '".$_POST['content']."', now(),".$row['tag_no'].");";

  } else if($_POST['select'] == 'diary'){
    $table = 'diary';
    $address = '3';

    $_POST['content'] = nl2br($_POST['content']); // 컨텐트안의 엔터를 <br>로 바꾸어주는 함수
    $sql = "INSERT INTO ".$table." (`title`, `content`, `created`) VALUES ('".$_POST['title']."', '".$_POST['content']."', now());";

  } else if($_POST['select'] == 'book'){
    $table = 'book';
    $address = '4';

    $_POST['content'] = nl2br($_POST['content']); // 컨텐트안의 엔터를 <br>로 바꾸어주는 함수
    $sql = "INSERT INTO ".$table." (`title`, `content`, `created`) VALUES ('".$_POST['title']."', '".$_POST['content']."', now());";
  }



/*
if($_POST['pw'] == '111111') { // 비밀번호가 맞을시
  if($_POST['select'] == 'Study') { // select태그를 확인하여 어떤 DB에 넣을것인지 변수 설정
    $table = 'study';
    $address = '2';
  } else if($_POST['select'] == 'Diary'){
    $table = 'diary';
    $address = '3';
  } else {
    $table = 'book';
    $address = '4';
  }*/

/*
  $_POST['content'] = nl2br($_POST['content']); // 컨텐트안의 엔터를 <br>로 바꾸어주는 함수
  $sql = "INSERT INTO ".$table." (`title`, `content`, `created`) VALUES ('".$_POST['title']."', '".$_POST['content']."', now());";
*/
  mysqli_query($conn, $sql); // 쿼리로 DB에 데이터 추가

  header("Location:http://localhost:8080/studying.php?id=".$address); // 글을 등록한 카테고리 주소로 Redirection
} else { // 비밀번호 틀렸을때 Redirection.
  header("Location:http://localhost:8080/studying.php");
}
?>
