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
      <div class="seat">1</div>
      <div class="seat">2</div>
      <div class="seat">3</div>
      <div class="seat">4</div>
      <div class="seat">5</div>
      <div class="seat">6</div>
      <div class="seat">7</div>
      <div class="seat">8</div>
      <div class="seat">9</div>
      <div class="seat">10</div>
      <div class="seat">11</div>
      <div class="seat">12</div>
      <div class="seat">13</div>
      <div class="seat">14</div>
      <div class="seat">15</div>
      <div class="seat">16</div>
      <div class="seat">17</div>
      <div class="seat">18</div>
      <div class="seat">19</div>
      <div class="seat">20</div>
      <div class="seat">21</div>
      <div class="seat">22</div>
      <div class="seat">23</div>
      <div class="seat">24</div>
      <div class="seat">25</div>
      <div class="seat">26</div>
      <div class="seat">27</div>
      <div class="seat">28</div>
      <div class="seat">29</div>
      <div class="seat">30</div>
      <div class="seat">31</div>
      <div class="seat">32</div>
      <div class="seat">33</div>
      <div class="seat">34</div>
      <div class="seat">35</div>
      <div class="seat">36</div>
      <div class="seat">37</div>
      <div class="seat">38</div>
      <div class="seat">39</div>
      <div class="seat">40</div>
      <div class="seat">41</div>
      <div class="seat">42</div>
      <div class="seat">43</div>
      <div class="seat">44</div>
      <div class="seat">45</div>
      <div class="seat">46</div>
      <div class="seat">47</div>
      <div class="seat">48</div>
      <div class="seat">49</div>
      <div class="seat">50</div>
      <div class="seat">51</div>
      <div class="seat">52</div>
      <div class="seat">53</div>
      <div class="seat">54</div>
      <div class="seat">55</div>
      <div class="seat">56</div>
      <div class="seat">57</div>
      <div class="seat">58</div>
      <div class="seat">59</div>
      <div class="seat">60</div>
      <div class="seat">61</div>
      <div class="seat">62</div>
      <div class="seat">63</div>
      <div class="seat">64</div>
      <div class="seat">65</div>
      <div class="seat">66</div>
      <div class="seat">67</div>
      <div class="seat">68</div>
      <div class="seat">69</div>
      <div class="seat">70</div>
      <div class="seat">71</div>
      <div class="seat">72</div>
      <div class="seat">73</div>
      <div class="seat">74</div>
      <div class="seat">75</div>
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

  const resevedData = <?= json_encode($res) ?>;

  function render() {
    $(".reserveRoom").textContent = "예약선택: ";
    $seats.forEach((seat, i) => {
      seat.classList.toggle("select", selected.has(i + 1));
    });
    $(".reserveRoom").textContent += [...selected] + "번";
  }

  // 툴팁
  $seats.forEach((seat, i) => {
    const info = resevedData[i + 1];
    
    if(!info) return;
    seat.dataset.tooltip = info.join('\n');
  })

  $seats.forEach(seat => {
    seat.onmousedown = () => {
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
      if(!isDrag) return;
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