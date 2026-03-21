const $ = (e) => document.querySelector(e)
const $$ = (e) => [...document.querySelectorAll(e)]
const $fetch = (path) => fetch(path).then(res => res.json())

const $newEl = (e, a = {}) => Object.assign(document.createElement(e), a)

const $newSvg = (e, a = {}) => {
  const el = document.createElementNS("http://www.w3.org/2000/svg", e);
  Object.entries(a).forEach(([k, v]) => el.setAttribute(k, v));
  return el;
}