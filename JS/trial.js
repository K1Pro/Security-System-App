// let controller = new AbortController();
// let signal = controller.signal;

// function abortCalendarDatesFillIn() {
//   controller.abort();
//   controller = new AbortController();
//   signal = controller.signal;
// }

async function getJSON(url, errorMsg = "Something went wrong") {
  try {
    const response = await fetch(url);
    const contactData = await response.json();
    return contactData;
  } catch (error) {
    if (error.name === "AbortError") {
      // console.log('Fetch was aborted');
    }
    // console.log(errorMsg);
  }
}
let rep = 0;
let row;

getJSON(`http://192.168.54.1:85/controller/task.php`).then((data) => {
  console.log(data);
  data.data.retrieved_items.forEach((el) => {
    getJSON(`http://192.168.54.1:85/controller/task.php?directory=${el}`).then(
      (data) => {
        if (rep % 3 === 0) {
          row = document.createElement("div");
          row.classList.add("row");
        }
        column = document.createElement("div");
        column.setAttribute(
          "class",
          "col-12 col-md-4 thirdPageHeight bg-light"
        );
        column.style.padding = "5px";
        column.innerHTML = data.data.retrieved_items[0].slice(0, 30);
        if (data.data.retrieved_items[0].includes("/")) {
          console.log(
            data.data.retrieved_items[0].slice(
              data.data.retrieved_items[0].indexOf(data.data.parent_directory) -
                1
            )
          );
        } else {
          console.log(
            `/${data.data.parent_directory}/${data.data.retrieved_items[0]}`
          );
        }

        row.appendChild(column);
        if (rep % 3 === 0) {
          document.getElementById(`app`).appendChild(row);
        }

        rep++;
      }
    );
  });
});
