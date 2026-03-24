<?php

get('/', function () {
  $popupData = DB::fetchAll("
    SELECT *
    FROM popup
    where startDay < CURDATE() and endDay > CURDATE()
  ");

  views("home", compact("popupData"));
});

get('/logout', function () {
  session_destroy();
  back("로그아웃 되었습니다.");
});

get('/sub01', function () {
  views("sub01");
});

get('/libraryLive', function () {
  if(!ss()) move('/');
  views("user/libraryLive");
});

get('/newBook', function () {
  if(!ss() -> id === "admin") move('/');
  views("admin/newBook");
});

get('/popup', function () {
  if(!ss() -> id === "admin") move('/');

  $popup = DB::fetchAll("
    SELECT *
    from popup
  ");

  views("admin/popup", compact("popup"));
});


get('/readingRoom', function () {
  if(!ss()) move('/');

  $reserved = DB::fetchAll("
    SELECT *
    from readingroom
    where date >= CURDATE()
    or (date = CURDATE() and end_time > CURTIME())
    order by date desc, start_time desc
  ");

  $res = [];

  foreach($reserved as $r) {
    $res[$r -> room_number][] = "{$r -> date} {$r -> start_time}~{$r -> end_time}";
  };

  views("user/readingRoom", compact("res"));
});


get('/selectPage', function () {
  if(!ss() && ss() -> id === "admin") move('/');

  $rentedBook = DB::fetchAll("
    SELECT d.book_title as bookTitle, d.book_author as bookAuthor, d.idx as idx, r.rent_date as rentDay, r.return_date as returnDay, r.user_id as userId,
    DATEDIFF(r.return_date, r.rent_date) as realDay
    from dataroom d
    join rent r
    on d.idx = r.book_id
  ");

  $reservedRoom = DB::fetchAll("
    select r.*, u.id as uid
    from readingroom r
    join user u
    on r.userId = u.idx
  ");

  views("admin/selectPage", compact("rentedBook", "reservedRoom"));
});


get('/dataRoom', function () {
  // if(!ss()) move('/');

  $bookData = DB::fetchAll("
    SELECT d.*, r.book_id as rented
    FROM dataroom d
    left join rent r
    on d.idx = r.book_id
    and r.return_date >= CURDATE()
  ");
  views("user/dataRoom", compact("bookData"));
});

get('/myPage', function () {
  if (!ss()) move('/');
  
  $ssId = ss()->idx;

  $myPage =  DB::fetchAll("
        SELECT d.*, r.rent_date as rentDay, r.return_date as returnDay,
        DATEDIFF(r.return_date, CURDATE()) as remainDay, book_id
        from rent r
        join dataroom d
        on r.book_id = d.idx
        where r.user_id = $ssId
      ");

  $myRoom = DB::fetchAll("
    select *
    from readingroom
    where userId = $ssId
  ");

  views("user/myPage", compact("myPage", "myRoom"));
});



post('/join', function () {
  extract($_POST);

  $user = DB::fetch("SELECT * from user where id = '$id'");

  if (!$user) {
    DB::exec("INSERT into user (id, pw, name) values ('$id', '$pw', '$name')");
    move("/", "회원가입 되었습니다.");
  } else {
    move("/", "이미 가입된 회원입니다.");
    return false;
  }
});

post('/login', function () {
  extract($_POST);

  $loginUser = DB::fetch("SELECT * from user where id = '$id' and pw = '$pw'");
  
  if (!$loginUser) {
    back("아이디 또는 비밀번호가 일치하지 않습니다.");
    return false;
  }

  $_SESSION['ss'] = $loginUser;
  back("로그인 되었습니다!");
});


post('/rentBook', function () {

  $idx = $_POST['idx'];
  $userId = ss()->idx;

  DB::exec("INSERT into rent (book_id, user_id, rent_date, return_date) values ('$idx', '$userId', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 9 DAY))");
  move("/dataRoom", "대출되었습니다.");
});

post('/returnBook', function () {
  extract($_POST);
  
  var_dump(extract($_POST));

  DB::exec("DELETE FROM rent where book_id = '$idx'");

  back("반납되었습니다.");
});


post("/addBook", function () {
  extract($_POST);

  $from = $_FILES['img']['tmp_name'];
  $img = $_FILES['img']['name'];

  move_uploaded_file($from, 'uploads/' . $img);

  DB::exec("INSERT INTO dataRoom (book_title, book_author, book_year, book_price, book_img, book_company) values ('$bookName', '$author', '$yaer', '$price', '$img', '$company')");

  move("/", "책이 등록 되었습니다.");
});


post("/popupAdd", function () {
  extract($_POST);

  $from = $_FILES['img']['tmp_name'];
  $img = $_FILES['img']['name'];

  move_uploaded_file($from, 'uploads/' . $img);

  DB::exec("INSERT into popup (title, content, startDay, endDay, img) values ('$title', '$content', '$startDay', '$endDay', '$img')");

  back("팝업 등록 완료!");
});


post("/popupFix", function () {
  extract($_POST);

  if ($_FILES['img']) {
    $from = $_FILES['img']['tmp_name'];
    $img = $_FILES['img']['name'];
  }

  if (!$from) {
    DB::exec("UPDATE popup set title = '$title', content = '$content', startDay = '$startDay', endDay = '$endDay' where idx = '$idx' ");
  } else {
    DB::exec("UPDATE popup set title = '$title', content = '$content', startDay = '$startDay', endDay = '$endDay', img = '$img' where idx = '$idx' ");
  }

  back("팝업 수정 완료!");
});


post("/popupDel", function () {
  extract($_POST);

  DB::exec("DELETE from popup where idx = '$idx' ");

  back("팝업 삭제");
});


post('/delRoom', function() {
  extract($_POST);

  DB::exec("DELETE from readingroom where idx = $delRoomIdx");

  bacK("예약을 취소 시켰습니다!");
});

post('/readingRoom', function () {
  extract($_POST);

  $userId = ss()->idx;
  $rooms = explode(',', $selectedRoom);

  if ($date < date("Y-m_d")) {
    back("오늘 날짜 이전 일시는 입력할 수 없습니다!");
    return;
  }
  
  foreach($rooms as $room) {
    $same = DB::fetch("
        SELECT *
        from readingRoom
        where room_number = '$room'
        and date = '$date'
        and start_time < '$endTime'
        and end_time > '$startTime'
    ");

    if($same) {
      back("예약 시간이 겹칩니다.");
      return;
    }
  };
  
  foreach ($rooms as $room){
    DB::exec("INSERT INTO readingroom (userId, room_number, date, start_time, end_time) values ('$userId', '$room', '$date', '$startTime', '$endTime')");
  };


  back("예약이 완료되었습니다.");
});
