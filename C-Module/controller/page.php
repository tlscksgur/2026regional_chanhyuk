<?php

get('/', function() {
  views("home");
});

get('/logout', function() {
  session_destroy();
  back("로그아웃 되었습니다.");
});

get('/sub01', function() {
  views("sub01");
});

get('/libraryLive', function() {
  views("user/libraryLive");
});


get('/dataRoom', function() {
  $bookData = DB::fetchAll("
    SELECT d.*, r.book_id as rented
    FROM dataroom d
    left join rent r
    on d.idx = r.book_id
    and r.return_date >= CURDATE()
  ");
  views("user/dataRoom", compact("bookData"));
});

get('/myPage', function() {
  $ssId = ss() -> idx;

  $myPage =  DB::fetch("SELECT * from rent where user_id = $ssId");

  views("user/myPage", compact("myPage"));
});



post('/join', function() {
  extract($_POST);

  $user = DB::fetch("SELECT * from user where id = '$id'");

  if(!$user) {
    DB::exec("INSERT into user (id, pw, name) values ('$id', '$pw', '$name')");
    move("/", "회원가입 되었습니다.");
  }else{
    move("/", "이미 가입된 회원입니다.");
    return false;
  }

});

post('/login', function() {
  extract($_POST);

  $loginUser = DB::fetch("SELECT * from user where id = '$id' and pw = '$pw'");
  if(!$loginUser) { back("아이디 또는 비밀번호가 일치하지 않습니다."); return false; }
  $_SESSION['ss'] = $loginUser;
  back("로그인 되었습니다!");
});


post('/rentBook', function() {

  $idx = $_POST['idx'];
  $userId = ss()->idx;

  DB::exec("INSERT into rent (book_id, user_id, rent_date, return_date) values ('$idx', '$userId', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 9 DAY))");
  move("/dataRoom", "대출되었습니다.");
});

post('/returnBook', function() {
  extract($_POST);

  DB::exec("DELETE FROM rent where book_id = '$idx'");
  
  move("/dataRoom", "반납되었습니다.");

});