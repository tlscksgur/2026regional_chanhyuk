<section id="myPage" class="center">

  <div class="myRentBook">
    <?php foreach($myPage as $mp): ?>
      <div>
        <img src="./image/<?= $mp -> book_img ?>">
        <p><?= $mp -> book_title ?></p>
        <p><?= $mp -> book_author ?></p>
        <p><?= $mp -> rentDay ?></p>
        <p><?= $mp -> returnDay ?></p>
        <p><?= $mp -> remainDay ?></p>
      </div>
    <?php endforeach; ?>
    <form action="/returnBook" method="post">
      <input type="submit" value="반납">
    </form>
  </div>

  <div class="myRentRoom">

  </div>

</section>
