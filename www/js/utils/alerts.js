const alertWarning = document.querySelector("#alert-warning");
const alertSuccess = document.querySelector("#alert-success");

function displayAlertSuccess(message) {
  alertSuccess.innerHTML = message;
  alertWarning.classList.add("d-none");
  alertSuccess.classList.remove("d-none");
  alertWarning.scrollIntoView();
  alertSuccess.focus();
}

function displayAlertWarning(message) {
  alertWarning.innerHTML = message;
  alertSuccess.classList.add("d-none");
  alertWarning.classList.remove("d-none");
  alertWarning.scrollIntoView();
  alertWarning.focus();
}

function resetAlert() {
  alertWarning.classList.add("d-none");
  alertSuccess.classList.add("d-none");
}