<section id="readingRoom">
  <div class="readingRoomIn">
    <h2 class="right mfont smallblue">readingRoom</h2>
      <div class="barBox">
        <span></span>
        <p>◆</p>
        <span></span>
      </div>
    <p class="reserveRoom">예약선택: --</p>
    <div class="seatAll">
      <?php for($i = 1; $i <= 75; $i++): ?>
        <div class="seat <?= in_array($i, $reservedRoom) ? 'reserved' : '' ?>">
          <?= $i ?>
        </div>
      <?php endfor; ?>
    </div>

    <div class="reservation">
      <form action="/readingRoom" method="post"></form>
    </div>

  </div>
</section>

<script src="./js/lib.js"></script>

<script>
  let isDrag = false;
  let maxSelected = 4
  let selected = new Set()

  const $seats = $$(".seat")
  

  function render() {
    $(".reserveRoom").textContent = "예약선택: ";
    $seats.forEach((seat, i) => {
      seat.classList.toggle("select", selected.has(i + 1));
    });
    $(".reserveRoom").textContent += [...selected] + "번";
  }

  $seats.forEach(seat => {
    seat.onmousedown = () => {
      if(seat.classList.contains('reserved')) return;
      isDrag = true;
      const id = Number(seat.textContent)
      selected.has(id) ? selected.delete(id) : selected.size < maxSelected && selected.add(id)

      selected.size > 0 ? $(".reservation form").innerHTML =
      `<div class="reservationInput">
        <div class="inputBox">
            <input type="hidden" name="selectedRoom" value="${[...selected]}">
            <input type="date" name="date">
            <input type="time" name="startTime" placeholder="시작시간">
            <input type="time" name="endTime" placeholder="종료시간">
          </div>
          <input type="submit" class="reserveBtn" value="예약하기">
      </div>` :
      $(".reservation form").innerHTML = "";

      render()
    }
  });

  $seats.forEach(seat => {
    seat.onmouseenter = () => {
      if(!isDrag || seat.classList.contains('reserved')) return;
      if(selected.size >= maxSelected) return;
      selected.add(Number(seat.textContent))

      $("input[name='selectedRoom']").value = [...selected]

      render()
    }
  })

  document.onmouseup = () => isDrag = false

  if($(".reserveBtn")) {
    $(".reserveBtn").onclick = () => {
      if(selected.size == 0) return;
      selected.clear()
      render()
    }
  }


</script>