const alertWarning = document.querySelector("#alert-warning");
const alertSuccess = document.querySelector("#alert-success");
const form = document.querySelector("main form");

form.addEventListener("submit", e => {
  resetAlert();
  if (form.checkValidity()) {
    e.preventDefault();
    const password = document.querySelector("#password").value;
    const passwordRepeat = document.querySelector("#password-repeat").value;
    if (password !== passwordRepeat) {
      displayWarning("Le password inserite non corrispondono!");
      return;
    }
    const email = document.querySelector("#email").value;
    const name = document.querySelector("#nome").value;
    const surname = document.querySelector("#cognome").value;
    register(email, name, surname, password, passwordRepeat);
  }
});

async function register(email, name, surname, password, passwordRepeat) {
  const url = "api/api-register.php";
  const formData = new FormData();
  formData.append("email", email);
  formData.append("nome", name);
  formData.append("cognome", surname);
  formData.append("password", password);
  formData.append("password-repeat", passwordRepeat);
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
}

function displayWarning(message) {
  alertWarning.innerHTML = message;
  alertSuccess.classList.add("d-none");
  alertWarning.classList.remove("d-none");
}

function resetAlert() {
  alertWarning.classList.add("d-none");
  alertSuccess.classList.add("d-none");
}