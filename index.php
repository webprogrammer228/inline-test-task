<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test </title>
</head>
<body>
  <?
  $postsUrl = "https://jsonplaceholder.typicode.com/posts";
  $commentsUrl = "https://jsonplaceholder.typicode.com/comments";

  $hostname = "localhost";
  $username = "root";
  $password = 123456;
  $dbname = "somebase";

  $connect = mysqli_connect($hostname, $username, $password, $dbname);

  $newDataPosts = json_decode(file_get_contents($postsUrl), true);
  $newDataComments = json_decode(file_get_contents($commentsUrl), true);


  $isEmptyPosts = mysqli_query($connect, "SELECT 1 FROM datas WHERE id LIKE 1");
  $isEmptyComments = mysqli_query($connect, "SELECT 1 FROM posts WHERE id LIKE 1");

?>

  <form action="#">
    <input type="text" name="search" placeholder="Введите комментарий">
    <button type="submit">Найти</button>
  </form>
  
  <?
  echo 'Поиск по запросу: '. ($_GET['search']);
  echo '<br>';

  //'%laudanti%'
  //'%".$_GET['search']."%' - запрос

$filteredPosts = mysqli_query($connect, "SELECT * FROM datas JOIN posts ON datas.id = posts.id WHERE datas.body LIKE '%".$_GET['search']."%'");
$length = strlen($_GET['search']);

if ($filteredPosts && $length > 3) {

  foreach ($filteredPosts as $f) {
    echo ('<div class="post" style="background: green; padding: 10px 15px; margin: 10px 0;">
      <p>'.'Комментарий - '.$f['body'].'</p>'.'<p>'.'Заголовок - '.$f['title'].'</p>'.'</div>');
  }
}
else {
  echo 'Данных по постам нет';
  return false;
}

?>

<?
   //для постов
  foreach ($newDataPosts as $n) {
      $sql = "INSERT INTO datas (userId, title, body) VALUES ('".$n['userId']."', '".$n['title']."', '".$n['body']."')";

      if ($isEmptyPosts->num_rows <= 0) {
        mysqli_query($connect, $sql);
      }
      else {
        // Данные уже загружены
        return false;
      }
  }

  // для комментариев
  foreach ($newDataComments as $n) {
    $sql = "INSERT INTO posts (postId, name, email, body) VALUES ('".$n['postId']."', '".$n['name']."', '".$n['email']."', '".$n['body']."')";

    if ($isEmptyComments->num_rows <= 0) {
      mysqli_query($connect, $sql);
    }
    else {
      // Данные уже загружены
      return false;
    }
}


  // Должна отрабатывать только при первом запуске
  echo 'Записей получено:'.count($newDataPosts).'<br>'. 'Комментариев получено: '.count($newDataComments);
  echo '<br>';
  //
  
  mysqli_close($connect);
  ?>

</body>
</html>