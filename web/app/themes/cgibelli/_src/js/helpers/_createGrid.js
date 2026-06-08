/**
 * Create a grid
 */
export default function createGrid() {
  const nbColumns = 12;
  const body = document.querySelector("body");
  const divParent = document.createElement("div");

  divParent.id = "grid";
  divParent.classList.add("teq-container");

  let divRow = document.createElement("div");
  divRow.classList.add("teq-row");
  divRow.classList.add("max-w");

  divParent.appendChild(divRow);

  for (let i = 1; i <= nbColumns; i++) {
    let divOne = document.createElement("div");
    let divTwo = document.createElement("div");

    divOne.classList.add("col-1");

    divOne.appendChild(divTwo);
    divRow.appendChild(divOne);
  }

  body.appendChild(divParent);
}
