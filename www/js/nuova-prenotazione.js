const alertWarning = document.querySelector("#alert-warning");
const alertSuccess = document.querySelector("#alert-success");
const form = document.querySelector("main form");

form.addEventListener("submit", e => {
  if (form.checkValidity()) {
    e.preventDefault();
    // TODO
  }
});

async function newPTSession(date, time) {
  const url = "api/api-appuntamenti.php";
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