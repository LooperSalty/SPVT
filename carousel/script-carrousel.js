const Questions = [
    "Question 1",
    "Question 2",
    "Question 3",
    "Question 4",
    "Question 5",
    "Question 6",
    "Question 7",
    "Question 8",
    "Question 9",
    "Question 10",
    "Question 11",
    "Question 12",
    "Question 13",
    "Question 14",
    "Question 15",
    "Question 16",
    "Question 17",
    "Question 18",
    "Question 19",
    "Question 20",
    "Question 21",
    "Question 22",
    "Question 23",
    "Question 24",
    "Question 25",
    "Question 26",
    "Question 27",
    "Question 28",
];

const ulEl = document.querySelector("ul");
const d = new Date();
let nombre = d.getMonth() == 1 ? d.getDate() - 1 : 0;
let activeIndex = nombre;
const rotate = -360 / Questions.length;
init();

function init() {
    Questions.forEach((selectionner, idx) => {
        const liEl = document.createElement("li");
        liEl.style.setProperty("--day_idx", idx);
        liEl.innerHTML = `<time datetime="2022-02-${idx + 1}">${
            idx + 1
        }</time><span>${selectionner}</span>`;
        ulEl.append(liEl);
    });
    ulEl.style.setProperty("--rotateDegrees", rotate);
    ajouteQuestion(0);
}

function ajouteQuestion(nr) {
    nombre += nr;
    ulEl.style.setProperty("--currentDay", nombre);

    const activeEl = document.querySelector("li.active");
    if (activeEl) activeEl.classList.remove("active");

    activeIndex = (activeIndex + nr + Questions.length) % Questions.length;
    const newActiveEl = document.querySelector(`li:nth-child(${activeIndex + 1})`);
    document.body.style.backgroundColor = window.getComputedStyle(
        newActiveEl
    ).backgroundColor;

    newActiveEl.classList.add("active");
}

window.addEventListener("keydown", (e) => {
    switch (e.key) {
        case "ArrowUp":
            adjustDay(-1);
            break;
        case "ArrowDown":
            adjustDay(1);
            break;
        default:
            return;
    }
});