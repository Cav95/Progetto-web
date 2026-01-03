const alertWarning = document.querySelector("#alert-warning");
const alertSuccess = document.querySelector("#alert-success");
const form = document.querySelector("main form");

const psw = document.querySelector("#password");


form.addEventListener("submit", e => {
  if (form.checkValidity()) {
    e.preventDefault();
    const submitter = e.submitter || document.activeElement;
    const action = submitter && submitter.value ? submitter.value : null;
    const id_user = submitter && submitter.id ? submitter.id : null;

    if (action === "Banna" || action === "Abilita" ) {
      userban(id_user);
    }

    if (action === "Modifica") {
      modifyPsw(
        psw.value,
        id_user
      );
    }
  }

});



async function modifyPsw(psw, id_user) {
  const url = "api/api-profile.php?action=modifica";
  const formData = new FormData();
  formData.append("psw", psw);
  formData.append("ID_User", id_user);
  for (const pair of formData.entries()) {
    console.log("formData", pair[0], pair[1]);
  }
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
      if (json["ok"]) {
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


async function userban(id_user) {
  const url = "api/api-profile.php?action=banna";
  const formData = new FormData();
  formData.append("ID_User", id_user);
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
      if (json["ok"]) {
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