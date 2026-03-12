<section id="myPage">
  <?php foreach($myPage as $mp): ?>
    <div>
      <p><?= $mp -> book_title ?></p>
      <p><?= $mp -> book_author ?></p>
      <p><?= $mp -> book_year ?></p>
      <p><?= $mp -> book_price ?></p>
    </div>
  <?php endforeach; ?>
</section>