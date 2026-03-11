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