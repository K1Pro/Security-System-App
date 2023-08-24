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

getJSON(`http://192.168.54.1:85/controller/task.php`).then((data) => {
  // console.log(data);
  data.data.retrieved_items.forEach((el) => {
    getJSON(`http://192.168.54.1:85/controller/task.php?directory=${el}`).then(
      (data) => {
        console.log(data.data);
      }
    );
  });
});
