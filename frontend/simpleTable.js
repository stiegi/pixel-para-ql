function findElements() {
  return new Promise(resolve => {
    const interval = setInterval(() => {
      let elements = document.querySelectorAll(".wtparameterinfo");
      if (elements.length > 0) {
        clearInterval(interval);
        resolve(elements);
      }
    }, 500);
  });
}

async function buildTable() {
  const response = await fetch("http://localhost:3000/graphql.php", {
    method: "POST",
    cache: "no-cache",
    mode: "cors",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json"
    },
    body: JSON.stringify({
      query: '{ parameter(type: "page") { parameter key descEn frontendEn } }'
    })
  });
  const result = await response.json();
  const elements = await findElements();
  elements.forEach(element => {
    element.appendChild(document.createElement("table"));
    const header = element.appendChild(document.createElement("tr"));
    Object.keys(result.data.parameter[0]).forEach(head => {
      const headCell = document.createElement("th");
      headCell.innerText = head;
      header.appendChild(headCell);
    });
    result.data.parameter.forEach(row => {
      element.appendChild(document.createElement("tr"));
      const columns = Object.keys(row);
      columns.forEach(column => {
        const cell = element.appendChild(document.createElement("td"));
        cell.innerText = row[column];
      });
    });
  });
}

buildTable();
