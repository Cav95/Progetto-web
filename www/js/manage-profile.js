const alertWarning = document.querySelector("#alert-warning");
const alertSuccess = document.querySelector("#alert-success");
const form = document.querySelector("main form");

form.addEventListener("submit", e => {
  if (form.checkValidity()) {
    e.preventDefault();
    switch (e.submitter.id) {
      case "chg_pwd":
        const formElements = e.target.elements;
        const oldPassword = formElements["old-password"].value;
        const newPassword = formElements["new-password"].value;
        const newPasswordRepeat = formElements["password-repeat"].value;
        if (newPassword !== newPasswordRepeat) {
          displayWarning("Le nuove password inserite non corrispondono!");
          return;
        }
        changePassword(oldPassword, newPassword, newPasswordRepeat);
        break;
      
      case "chg_ban":
        toggleUserban(e.submitter.dataset.userid);
        break;
    
      default:
        break;
    }
    
  }
});

async function changePassword(oldPassword, newPassword, newPasswordRepeat) {
  const url = "api/api-profile.php?action=modifica";
  const formData = new FormData();
  formData.append("old-pwd", oldPassword);
  formData.append("new-pwd", newPassword);
  formData.append("pwd-repeat", newPasswordRepeat);
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


async function toggleUserban(id_user) {
  const url = "api/api-profile.php?action=ban";
  const formData = new FormData();
  formData.append("userID", id_user);
  try {
    const response = await fetch(url, {
      method: "POST",
      body: formData
    });
    if (!response.ok) {
      throw new Error("Response status: " + response.status);
    }
    const json = await response.json();
    if (json["ok"]) {
      window.location.reload();
      return;
    } 
    if (json["msg"] != null) {
      displayWarning(json["msg"]);
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