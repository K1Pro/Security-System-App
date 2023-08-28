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

class Camera {
  constructor(sourceName, folderName, repAmount) {
    this.sourceName = sourceName;
    this.folderName = folderName;
    this.seconds = 0;
    this.repAmount = repAmount;
  }

  changeFrame() {
    document.getElementById(this.folderName).innerHTML = `<img src="${
      this.sourceName[this.seconds]
    }" class="camPTZ1Class">`;

    document.getElementById(this.folderName).style.backgroundImage = `url(${
      this.sourceName[this.seconds + 1]
    })`;

    if (this.seconds < this.repAmount - 1) {
      this.seconds++;
    } else {
      this.seconds = 0;
    }
  }
}

let rep = 0;
let row;

getJSON(`http://192.168.54.1:85/controller/task.php`).then((data) => {
  data.data.retrieved_items.forEach((el) => {
    getJSON(`http://192.168.54.1:85/controller/task.php?directory=${el}`).then(
      (data) => {
        const newCamera = new Camera(
          data.data.retrieved_items,
          data.data.parent_directory,
          data.data.number_of_retrieved_items
        );
        if (rep % 3 === 0) {
          row = document.createElement("div");
          row.classList.add("row");
        }
        column = document.createElement("div");
        column.setAttribute(
          "class",
          "col-12 col-md-4 thirdPageHeight bg-light"
        );
        column.id = newCamera.folderName;
        column.style.padding = "5px";
        column.style.backgroundSize = "100% 100%";
        column.style.backgroundRepeat = "no-repeat";
        column.style.backgroundOrigin = "content-box";
        column.style.backgroundImage = `url(${newCamera.sourceName[0]})`;

        row.appendChild(column);

        if (rep % 3 === 0) {
          document.getElementById(`app`).appendChild(row);
        }

        rep++;

        setInterval(function () {
          newCamera.changeFrame();
        }, 1500);
      }
    );
  });
});
