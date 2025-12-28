const alertWarning = document.querySelector("#alert-warning");
const form = document.querySelector("main form");

form.addEventListener("submit", e => {
  if (form.checkValidity()) {
    e.preventDefault();
    const email = document.querySelector("#email").value;
    const password = document.querySelector("#password").value;
    register(email, password);
  }
});

async function register(email, password) {
  const url = "api/api-login.php";
  const formData = new FormData();
  formData.append("email", email);
  formData.append("password", password);
  try {
    const response = await fetch(url, {
      method: "POST",
      body: formData
    });
    if (!response.ok) {
      throw new Error("Response status: " + response.status);
    }
    const json = await response.json();
    if (json["ok"]){
      window.location.reload();
    } else {
      if (json["msg"] != null) {
        displayWarning(json["msg"]);
      }
    }
  } catch (error) {
    console.log(error.message);
  }
}

function displayWarning(message) {
  alertWarning.innerHTML = message;
  alertWarning.classList.remove("d-none");
  alertWarning.focus(true);
}

function resetAlert() {
  alertWarning.classList.add("d-none");
}
