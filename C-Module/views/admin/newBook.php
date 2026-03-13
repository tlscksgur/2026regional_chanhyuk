<section id="newBook">
  <div class="bookAdd center fd">
    <div class="addBookBox">
      <h3>도서 등록</h3>
    </div>
    <form action="/addBook" method="post" enctype="multipart/form-data">

      <div class="ab ab0">
        <p class="fz08em C555">도서명</p>
        <input type="text" name="bookName" class="borderNone" required>
      </div>

      <div class="ab ab1">
        <p class="fz08em C555">저자명</p>
        <input type="text" name="author" class="borderNone" required>
      </div>

      <div class="ab ab2">
        <p class="fz08em C555">출판사</p>
        <input type="text" name="company" class="borderNone" required>
      </div>

      <div class="ab ab3">
        <p class="fz08em C555">도서사진</p>
        <input type="file" accept=".jpg, .jpeg, .png" name="img" class="borderNone" required>
      </div>

      <div class="ab ab4">
        <p class="fz08em C555">발행년</p>
        <input type="text" name="yaer" class="borderNone" required>
      </div>

      <div class="ab ab5">
        <p class="fz08em C555">가격</p>
        <input type="text" name="price" class="borderNone" required>
      </div>

      <input type="submit" value="등록">
    </form>
  </div>
</section>