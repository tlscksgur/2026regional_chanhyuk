<section id="myPage" class="center">

  <div class="flexBox">
    <h2>내 책</h2>
    <div class="myRentBook">
      <?php foreach($myPage as $i => $mp): ?>
        <div class="rentBook rentBook<?= $i ?>">
          <img src="./image/<?= $mp -> book_img ?>">
          <p>제목: <?= $mp -> book_title ?></p>
          <p>작가: <?= $mp -> book_author ?></p>
          <p>대출일: <?= $mp -> rentDay ?></p>
          <p>반납 예정일: <?= $mp -> returnDay ?></p>

          <?php if($mp -> remainDay < 0): ?>
            <p>연체 기간: <?= $mp -> remainDay ?></p>
          <?php else: ?>
            <p>남은 기간: <?= $mp -> remainDay ?></p>
          <?php endif; ?>

          <form action="/returnBook" method="post">
            <input type="submit" value="반납">
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="myRentRoom">
    <h2>내 열람실</h2>
    <div class="gridBox">
      <?php foreach($myRoom as $i => $mr): ?>
        <div class="mRoom mr<?= $i ?>">
          <p>좌석번호: <strong><?= $mr -> room_number ?></strong></p>
          <p>예약일: <strong><?= $mr -> date ?></strong></p>
          <p>시작시간: <strong><?= $mr -> start_time ?></strong></p>
          <p>종료시간: <strong><?= $mr -> end_time ?></strong></p>
          <p>예약자 아이디: <strong><?= ss() -> idx ?></strong></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</section>
