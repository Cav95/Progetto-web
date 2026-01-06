import("./utils/alerts.js");

const form = document.querySelector("main form");

form.addEventListener("submit", e => {
  if (form.checkValidity()) {
    e.preventDefault();
    const password = document.querySelector("#password").value;
    const passwordRepeat = document.querySelector("#password-repeat").value;
    if (password !== passwordRepeat) {
      displayAlertWarning("Le password inserite non corrispondono!");
      return;
    }
    const email = document.querySelector("#email").value;
    const name = document.querySelector("#nome").value;
    const surname = document.querySelector("#cognome").value;
    register(email, name, surname, password, passwordRepeat)
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
        displayAlertSuccess(json["msg"]);
        form.reset();
      } else {
        displayAlertWarning(json["msg"]);
      }
    }
  } catch (error) {
    console.log(error.message);
  }
}
