<section id="myPage" class="center">
  <div class="rentBook">
    <div class="lineBox">
      <p>도서 현황</p>
      <p class="line"></p>
      <p class="symbol">◆</p>
    </div>
    <table>
      <thead>
        <tr>
          <th>도서사진</th>
          <th>도서명</th>
          <th>저자명</th>
          <th>대출일자</th>
          <th>반납일</th>
          <th>남은기간</th>
          <th>반납</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($myPage as $mp): ?>
        <tr>
          <td><img src="./image/<?= $mp -> book_img ?>" alt="<?= $mp -> book_title ?>" tilte="<?= $mp -> book_title ?>"></td>
          <td><?= $mp -> book_title ?></td>
          <td><?= $mp -> book_author ?></td>
          <td><?= $mp -> rentDay ?></td>
          <td><?= $mp -> returnDay ?></td>
          <td><?= $mp -> remainDay ?></td>
          <td>
            <form action="/returnBook" method="post">
              <input type="hidden" name="idx" value="<?= $mp -> book_id ?>">
              <input type="submit" value="반납">
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
