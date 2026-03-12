<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="widdiv=device-widdiv, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./공통제공파일/fontawesome/css/all.min.css">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <header>
       <div class="headerIn">
        <a href="/home"><img src="./logo/logo.png" alt="logo" title="logo"></a>
          <div class="push">
            <div class="dropdown">
                <div class="drop1">
                  <input class="focusTrigger1">
                  <div class="mainTxt1">
                    <a href="#">도서관소개</a>
                    <span class="plus">+</span>
                    <span class="minus">-</span>
                  </div>
                  <ul>
                    <li><a href="/sub01" style="z-index: 100;">도서관소개</a></li>
                    <li><a href="/libraryLive">도서관현황</a></li>
                  </ul>
                </div>

                <div class="drop2">
                  <input class="focusTrigger2">
                  <div class="mainTxt2">
                    도서자료실
                    <span class="plus">+</span>
                    <span class="minus">-</span>
                  </div>
                  <ul>
                    <?php if(ss()): ?>
                      <li><a href="/dataRoom">자료실</a></li>
                      <li><a href="#">열람실예약</a></li>
                    <?php else: ?>
                      <li><a href="#">자료실</a></li>
                      <li><a href="#">열람실예약</a></li>
                    <?php endif; ?>
                  </ul>
                </div>

                <div class="drop3">
                  <input class="focusTrigger3">
                  <div class="mainTxt3">
                    회원서비스
                    <span class="plus">+</span>
                    <span class="minus">-</span>
                  </div>
                  <ul>
                    <li><a href="#">회원가입</a></li>
                    <li><a href="#">마이페이지</a></li>
                  </ul>
                </div>

              <div class="headerBtns">
                <?php if(!ss()): ?>
                  <a href="#" class="openLogin">로그인</a>
                  <a href="#" class="openJoin">회원가입</a>
                <?php elseif(ss() -> id === "admin"): ?>
                  <p><?= ss() -> name ?></p>
                  <a href="/logout">로그아웃</a>
                <?php else: ?>
                  <p><?= ss() -> name ?></p>
                  <p><?= ss() -> id ?></p>
                  <a href="/logout">로그아웃</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
      </div>
    </header>
  
    <div id="join">
      <div class="joinBackground"></div>
      <div class="joinIn">
        <div class="joinTextBox">
          <h3>회원가입 / Sign Up</h3>
          <span class="dottedBar"></span>
          <button class="close">X</button>
        </div>
        <form action="/join" method="post">

          <div class="join1">
            <p class="fz08em C555">아이디를 입력해주세요.</p>
            <input type="text" name="id" class="borderNone" required>
          </div>

          <div class="join2">
            <p class="fz08em C555">비밀번호를 입력해주세요.</p>
            <input type="password" name="pw" class="borderNone" required>
          </div>

          <div class="join3">
            <p class="fz08em C555">이름을 입력해주세요.</p>
            <input type="text" name="name" class="borderNone" required>
          </div>
          <input type="submit" value="회원가입">
        </form>
      </div>
    </div>

    <div id="login">
      <div class="loginBackground"></div>
      <div class="loginIn">
        <div class="loginTextBox">
          <h3>로그인 / Login</h3>
          <span class="dottedBar"></span>
          <button class="close">X</button>
        </div>
        <form action="/login" method="post">

          <div class="login1">
            <p class="fz08em C555">아이디를 입력해주세요.</p>
            <input type="text" name="id" class="borderNone" required>
          </div>

          <div class="login2">
            <p class="fz08em C555">비밀번호를 입력해주세요.</p>
            <input type="password" name="pw" class="borderNone" required>
          </div>

          <input type="submit" value="로그인">
        </form>
      </div>
    </div>