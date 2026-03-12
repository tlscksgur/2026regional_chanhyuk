<?php 
  $json = file_get_contents("./json/도서정보.json");
  $jsonData = json_decode($json, true);

  foreach($jsonData as $Jdata):
    $title = addslashes($Jdata['서명']);
    $author = addslashes($Jdata['저자']);
    $year = $Jdata['발행년'];
    $price = $Jdata['가격'];
    $img = $Jdata['이미지'];

    DB::exec("INSERT into dataroom (book_title, book_author, book_year, book_price, book_img) values ('$title', '$author', '$year', '$price', '$img')");
  endforeach;

?>