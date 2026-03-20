<section id="selectPage">
  <div class="box1">
    <h2>도서대출현황</h2>
    <div class="userRentedBook">
      <?php foreach($rentedBook as $i => $rb): ?>
      <form action="/returnBook" method="post">
        <input type="hidden" name="idx" value="<?= $rb -> idx ?>">

        <ul class="usersBook usersBook<?= $i ?>">
          <li>도서명: <?= $rb -> bookTitle ?></li>
          <li>대출일자: <?= $rb -> bookAuthor ?></li>
          <li>대출일자: <?= $rb -> rentDay ?></li>
          <li>반납일: <?= $rb -> returnDay ?></li>
          <li>남은 기간: <?= $rb -> realDay ?></li>
          <li>대출자 ID: <?= $rb -> userId ?></li>
          <li><input type="submit" value="반납"></li>
        </ul>
      </form>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="box2">
    <h2>열람실 예약현황</h2>
    <div class="userRentedRoom">
      <?php foreach($reservedRoom as $i => $rr): ?>
        <form action="/delRoom" method="post">
          <input type="hidden" name="delRoomIdx" value="<?= $rr -> idx ?>">
          <div class="roomBox">
            <p>좌석번호: <strong><?= $rr -> room_number ?></strong></p>
            <p>예약일: <strong><?= $rr -> date ?></strong></p>
            <p>시작시간: <strong><?= $rr -> start_time ?></strong></p>
            <p>종료시간: <strong><?= $rr -> end_time ?></strong></p>
            <p>예약자 아이디: <strong><?= $rr -> uid ?></strong></p>
            <input type="submit" value="예약취소">
          </div>
        </form>
      <?php endforeach; ?>
    </div>
  </div>

</section>