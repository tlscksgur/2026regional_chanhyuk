<section id="popup">
  <div class="popupAdd">
    <h3>팝업 등록</h3>
    <form action="/popupAdd" method="post" enctype="multipart/form-data">

      <div class="popup pop0">
        <p class="fz08em C555">제목</p>
        <input type="text" name="title" class="borderNone" required>
      </div>

      <div class="popup pop1">
        <p class="fz08em C555">내용</p>
        <input type="text" name="content" class="borderNone" required>
      </div>

      <div class="popup pop2">
        <p class="fz08em C555">이미지</p>
        <input type="file" name="img" class="borderNone" required>
      </div>

      <div class="popup pop3">
        <p class="fz08em C555">팝업시작일</p>
        <input type="date" name="startDay" class="borderNone" required>
      </div>

      <div class="popup pop4">
        <p class="fz08em C555">팝업종료일</p>
        <input type="date" name="endDay" class="borderNone" required>
      </div>

      <input type="submit" value="팝업 등록">
    </form>
  </div>

  <div class="popupFixDel">
    <h3>팝업 관리</h3>
    <div class="popupData">
      <?php foreach ($popup as $pop): ?>
        <form action="" method="post">
          <input type="hidden" name="idx" value="<?= $pop->idx ?>">

          <div class="popup pop0">
            <p class="fz08em C555">제목</p>
            <input type="text" name="title" value="<?= $pop->title ?>" class="borderNone" readonly>
          </div>

          <div class="popup pop1">
            <p class="fz08em C555">내용</p>
            <input type="text" name="content" value="<?= $pop->content ?>" class="borderNone" readonly>
          </div>

          <div class="popup pop2">
            <p class="fz08em C555">이미지</p>
            <input type="file" name="img" value="<?= $pop->img ?>" class="borderNone" readonly>
          </div>

          <div class="popup pop3">
            <p class="fz08em C555">팝업시작일</p>
            <input type="date" name="startDay" value="<?= $pop->startDay ?>" class="borderNone" readonly>
          </div>

          <div class="popup pop4">
            <p class="fz08em C555">팝업종료일</p>
            <input type="date" name="endDay" value="<?= $pop->endDay ?>" class="borderNone" readonly>
          </div>
          <div>
            <input type="submit" value="수정" class="fix">
          </div>
          <div>
        </form>

        <form action="/popupDel" method="post" enctype="multipart/form-data">
          <input type="hidden" name="idx" value="<?= $pop->idx ?>">
          <input type="submit" value="삭제">
        </form>
    </div>
  <?php endforeach; ?>
  </div>

</section>
<script src="./js/lib.js"></script>
<script>
  const fixes = $$(".fix")

fixes.forEach(btn => {

  let edit = false

  btn.onclick = (e) => {

    const form = btn.closest("form")
    const inputs = $$("input")

    if(!edit){
      e.preventDefault()

      inputs.forEach(input=>{
        if(input.type !== "submit"){
          input.readOnly = false
        }
      })

      form.action = "/popupFix"

      edit = true
    }

  }

})
</script>