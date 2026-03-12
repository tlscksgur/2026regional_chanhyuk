<section id="dataRoom">
  <table class="data">
    <tr>
      <th>도서사진</th>
      <th>도서명</th>
      <th>저자명</th>
      <th>발행년</th>
      <th>가격</th>
      <th>대출</th>
      <th>반납</th>
    </tr>

    <?php foreach ($bookData as $ud): ?>
      
      <tr>
        <td><img src="./image/<?= $ud->book_img ?>" alt=""></td>
        <td><?= $ud->book_title ?></td>
        <td><?= $ud->book_author ?></td>
        <td><?= $ud->book_year ?>년</td>
        <td><?= $ud->book_price ?>원</td>
        <td>
          <form action="/rentBook" method="post">
            <input type="hidden" name="idx" value="<?= $ud -> idx ?>">
            <input type="submit" value="<?= $ud -> rented ? '대출중' : '대출' ?>" style="color:<?= $ud -> rented ? 'red' : '' ?>;">
          </form>
        </td>
        <td>
          <form action="/returnBook" method="post">
            <input type="hidden" name="idx" value="<?= $ud -> idx ?>">
            <input type="submit" value="반납">
          </form>
        </td>
      </tr>

    <?php endforeach; ?>

  </table>
</section>