const $mapContainer = $(".mapContainer");

const libs = await $fetch("./json/도서관현황.json");


const libState = libs.reduce((acc, lib) => {
  acc[lib["시도명"]] ??= {libCount: 0, seatCount: 0, bookCount: 0};
  acc[lib["시도명"]].libCount += 1;
  acc[lib["시도명"]].seatCount += +lib["열람좌석수"];
  acc[lib["시도명"]].bookCount += +lib["자료수(도서)"];
  return acc;
}, {})


const nameMap = {
  서울특별시: "서울",
  부산광역시: "부산",
  대구광역시: "대구",
  인천광역시: "인천",
  광주광역시: "광주",
  대전광역시: "대전",
  울산광역시: "울산",
  경기도: "경기",
  강원특별자치도: "강원",
  충청북도: "충북",
  충청남도: "충남",
  전라북도: "전북",
  전북특별자치도: "전북",
  전라남도: "전남",
  경상북도: "경북",
  경상남도: "경남",
  제주특별자치도: "제주",
  세종특별자치시: "세종", 
};

const posOffset = {
  경상북도: { dx: -100, dy: 20 },
  충청북도: { dx: -20, dy: -20 },
  경기도: { dx: 40, dy: 30 },
  전라남도: { dx: 25, dy: 5 }
};

const statsValues = Object.values(libState);
const stateKeys = ["libCount", "seatCount", "bookCount"];
const minMax = {};

for(const key of stateKeys) {
  const values = statsValues.map(s => s[key])
  minMax[key] = {min: Math.min(...values), max: Math.max(...values)}
}

const percent = (value, key) => {
  const {min, max} = minMax[key];
  return max === min ? 0 : ((value - min) / (max - min)) * 100;
}

const barColor = { libCount: "#3B82F6", bookCount: "#EF4444", seatCount: "#22C55E" };
const barLabel = { libCount: "도서관수", bookCount: "자료수(도서)", seatCount: "열람좌석수" };

const tooltip = $(".tooltip");

function renderMap() {
  const svg = $("svg");

  const barMaxHeight = 30;
  const barWidth = 4;
  const barGap = 1;
  const barGroupWidth = stateKeys.length * (barWidth + barGap);

  $$("path[title]").forEach(path => {
    const raw = path.getAttribute("title");
    const title = nameMap[raw] ?? raw;
    
    if(!title) return;

    const offset = posOffset[raw] || { dx: 0, dy: 0 };
    const bbox = path.getBBox();
    const cx = bbox.x + bbox.width / 2 + offset.dx
    const cy = bbox.y + bbox.height / 2 + offset.dy

    const state = libState[raw];
    if(state) {
      const g = $newSvg("g", {cursor: "pointer"});
      stateKeys.forEach((key, i) => {
        const pct = percent(state[key], key)
        const h = Math.max((pct / 100) * barMaxHeight, 1)
        const x = cx - barGroupWidth / 2 + i * (barWidth + barGap)
        const y = cy - 10 - h;

        const bar = $newSvg("rect", {
          x, y, width: barWidth, height: h, fill: barColor[key], rx: 1
        });
        g.appendChild(bar)
      })

      const topLines = stateKeys.map(key => `${barLabel[key]}: ${state[key].toLocaleString()}`);
      const tipText = `[${title}]\n${topLines.join("\n")}`;

      g.onmouseenter = (e) => {
        tooltip.textContent = tipText;
        tooltip.style.display = "block"
        tooltip.style.left = `${e.clientX + window.scrollX + 12}px`
        tooltip.style.top = `${e.clientY + window.scrollY + 12}px`
      }
      g.onmouseleave = () => tooltip.style.display = "none"
      
      const text = $newSvg("text", {
        x: cx, y: cy,
        "text-anchor": "middle",
        "dominant-baseline": "central",
        "font-size": "13",
        "font-weight": "bold",
        fill: "#333",
        "pointer-events": "none",
      });
      text.textContent = title;
      g.appendChild(text)
      svg.appendChild(g)
    }
    
  });
}
renderMap()


const columns = [
  "시도명",
  "도서관명",
  "시군구명",
  "도서관유형",
  "휴관일",
  "평일운영시작시각",
  "평일운영종료시각",
  "열람좌석수",
  "자료수(도서)",
  "대출가능권수",
  "대출가능일수",
  "소재지도로명주소",
];

const $tbody = $("tbody");
const searchInput = $(".searchInput")
const orderBy = $(".orderBy")

function renderTable() {
  const inputValue = searchInput.value.trim()
  const orderValue = orderBy.value;

  const sorted = [...libs].toSorted((a, b) => {
    if(orderValue) {
      const diff = (+a['자료수(도서)'] || 0) - (+b['자료수(도서)'] || 0);
      return orderValue === "asc" ? diff : -diff;
    }
    return (a["시도명"] || "").localeCompare(b["시도명"] || "");
  })

  const filter = inputValue ? sorted.filter(lib => lib['도서관명']?.includes(inputValue)) : sorted;

  $tbody.innerHTML = filter.map(lib => {
    const cells = columns.map(col => {
      const val = lib[col] ?? "";
      if(col === "도서관명" && inputValue) {
        return `<td>${val.replaceAll(inputValue, `<mark>${inputValue}</mark>`)}</td>`
      }
      return `<td>${val}</td>`
    }).join("");
    return `<tr>${cells}</tr>`
  }).join("");

}

orderBy.onchange = () => renderTable()
searchInput.oninput = () => renderTable()
renderTable()