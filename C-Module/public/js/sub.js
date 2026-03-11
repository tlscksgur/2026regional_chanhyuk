const $joinModal = $("#join")
const $loginModal = $("#login")

const $openJoin = $(".openJoin")
const $openLogin = $(".openLogin")

const $close = $$(".close")

$openJoin.onclick = () => {
  $joinModal.style.display = "block"
  document.body.style.overflow = "hidden"
}

$openLogin.onclick = () => {
  $loginModal.style.display = "block"
  document.body.style.overflow = "hidden"
}

$close.forEach(closeBtn => {
  closeBtn.onclick = () => {
    closeBtn.closest("#join, #login").style.display = "none"
    document.body.style.overflow = "visible"
  }
});