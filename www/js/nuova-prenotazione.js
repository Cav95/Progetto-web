const alertWarning = document.querySelector("#alert-warning");
const alertSuccess = document.querySelector("#alert-success");
const form = document.querySelector("main form");

const timeChooser = document.querySelector("#ora");
const dateChooser = document.querySelector("#data");

dateChooser.addEventListener('input', (e) => {
  if (e.target.checkValidity() && e.target.value !== "") {
    setTimesForDate(e.target.value);
  } else {
    timeChooser.disabled = true;
    timeChooser.innerHTML = `
      <option selected>Prima scegli una data</option>
    `
  }
});

form.addEventListener("submit", e => {
  if (form.checkValidity()) {
    e.preventDefault();
    newPTSession(dateChooser.value, timeChooser.value);
  }
});

function buildTimes(times) {
  if (times.length == 0) {
    timeChooser.innerHTML = '<option>Nessun orario disponibile</option>';
    timeChooser.disabled = true;
    return;
  }
  buffer = '';
  times.forEach(time => {
    buffer += `<option value="${time}">${time}</option>`;
  });
  timeChooser.innerHTML = buffer;
  timeChooser.disabled = false;
}

async function setTimesForDate(date) {
  const url = `api/api-appuntamenti.php?action=time&date=${date}`;
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Response status: " + response.status);
    }
    const json = await response.json();
    if (json["times"] == null) {
      throw new Error("Error while retrieving available times");
    }
    buildTimes(json["times"]);
  } catch (error) {
    console.log(error.message);
  }
}

async function newPTSession(date, time) {
  const url = "api/api-appuntamenti.php?action=create";
  const formData = new FormData();
  formData.append("app-date", date);
  formData.append("app-time", time);
  try {
    const response = await fetch(url, {
      method: "POST",
      body: formData
    });
    if (!response.ok) {
      throw new Error("Response status: " + response.status);
    }
    const json = await response.json();
    if (json["msg"] != null) {
      if (json["ok"]){
        displaySuccess(json["msg"]);
        form.reset();
      } else {
        displayWarning(json["msg"]);
      }
    }
  } catch (error) {
    console.log(error.message);
  }
}

function displaySuccess(message) {
  alertSuccess.innerHTML = message;
  alertWarning.classList.add("d-none");
  alertSuccess.classList.remove("d-none");
  alertSuccess.focus();
}

function displayWarning(message) {
  alertWarning.innerHTML = message;
  alertSuccess.classList.add("d-none");
  alertWarning.classList.remove("d-none");
  alertWarning.focus();
}

function resetAlert() {
  alertWarning.classList.add("d-none");
  alertSuccess.classList.add("d-none");
}