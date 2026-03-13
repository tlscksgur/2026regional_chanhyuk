<section id="selectPage">
  <div class="box1">
    <h2>유저들이 빌려간 책</h2>
    <div class="userRentedBook">
      <?php foreach($rentedBook as $i => $rb): ?>
      <ul class="usersBook usersBook<?= $i ?>">
        <li>도서명: <?= $rb -> bookTitle ?></li>
        <li>대출일자: <?= $rb -> bookAuthor ?></li>
        <li>대출일자: <?= $rb -> rentDay ?></li>
        <li>반납일: <?= $rb -> returnDay ?></li>
        <li>남은 기간: <?= $rb -> realDay ?></li>
        <li>대출자 ID: <?= $rb -> userId ?></li>
      </ul>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="box2">
    <h2>유저가 예약한 방</h2>
    <div class="userRentedRoom">
      
    </div>
  </div>

</section>