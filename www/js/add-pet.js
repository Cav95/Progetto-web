const alertWarning = document.querySelector("#alert-warning");
const alertSuccess = document.querySelector("#alert-success");
const form = document.querySelector("main form");

const nome = document.querySelector("#nome");
const data = document.querySelector("#data");
const nomespecie = document.querySelector("#nomespecie");
const nomerazza = document.querySelector("#nomerazza");
const descrizione = document.querySelector("#descrizione");
const img = document.querySelector("#pet-img");
const descrizioneimg = document.querySelector("#descrizione-img");


form.addEventListener("submit", e => {
  if (form.checkValidity()) {
    e.preventDefault();
    newPetSession(nome.value, data.value,nomespecie.value ,nomerazza.value , descrizione.value ,img.value , descrizioneimg.value  );
  }
});



async function newPetSession(nome, data ,nomespecie,nomerazza, descrizione,img, descrizioneimg  ) {
  const url = "api/api-addpet.php?action=create";
  const formData = new FormData();
  formData.append("nome", nome);
  formData.append("data", data);
  formData.append("nomespecie", nomespecie);
  formData.append("nomerazza", nomerazza);
  formData.append("descrizione", descrizione);
  formData.append("img", img);  
  formData.append("descrizioneimg", descrizioneimg);
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

async function deletePetSession(nome, dateChooser,nomespecie,nomerazza, descrizione,img, descrizioneimg ) {
  const url = "api/api-addpet.php?action=delete";
  const formData = new FormData();
  formData.append("nome", nome);
  formData.append("data", data);
  formData.append("nomespecie", nomespecie);
  formData.append("nomerazza", nomerazza);
  formData.append("descrizione", descrizione);
  formData.append("img", img);  
  formData.append("descrizioneimg", descrizioneimg);
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