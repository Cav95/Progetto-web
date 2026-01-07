import("./utils/alerts.js");

const form = document.querySelector("main form");
const deleteAppBtn = document.querySelector("#delete-app-confirm");

const nome = document.querySelector("#nome");
const data = document.querySelector("#data");
const nomespecie = document.querySelector("#spec-sel");
const nomerazza = document.querySelector("#razza-sel");
const descrizione = document.querySelector("#descrizione");
const img = document.querySelector("#pet-img");
const oldimg = document.querySelector("#oldimg");
const descrizioneimg = document.querySelector("#descrizione-img");
const disponibile = document.querySelector("#disponibile");

deleteAppBtn.addEventListener("click", (e) => {
  deletePet(e.target.dataset.petid);
});

form.addEventListener("submit", e => {
  if (form.checkValidity()) {
    e.preventDefault();
    const submitter = e.submitter || document.activeElement;
    const action = submitter && submitter.value ? submitter.value : null;
    const id_pet = submitter && submitter.id ? submitter.id : null;

    if (action === "Elimina") {
    } else if (action === "Aggiungi") {
      addPet(
        nome.value,
        data.value,
        nomerazza.value,
        descrizione.value,
        img.files && img.files[0] ? img.files[0] : null,
        descrizioneimg.value
      );
    } else if (action === "Modifica") {
      modifyPet(
        nome.value,
        data.value,
        nomerazza.value,
        descrizione.value,
        img.files && img.files[0] ? img.files[0] : null,
        oldimg.value,
        descrizioneimg.value,
        disponibile.checked,
        id_pet
      );
      
    }
  }

});

nomespecie.addEventListener("change", () => setRaces(nomespecie.value));

async function addPet(nome, data,nomerazza, descrizione, img, descrizioneimg) {
  const url = "api/api-pet.php?action=create";
  const formData = new FormData();
  formData.append("nome", nome);
  formData.append("data", data);
  formData.append("nomerazza", nomerazza);
  formData.append("descrizione", descrizione);
  if (img instanceof File) {
    console.log("selected file name:", img.name);
    formData.append("img", img, img.name);
  }

  formData.append("descrizioneimg", descrizioneimg);
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
        window.location.href = 'pet.php'
      } else {
        displayAlertWarning(json["msg"]);
      }
    }
  } catch (error) {
    console.log(error.message);
  }
}

async function modifyPet(nome, data, nomerazza, descrizione, img,oldimg, descrizioneimg, disponibile, id_pet) {
  const url = "api/api-pet.php?action=modify";
  const formData = new FormData();
  formData.append("nome", nome);
  formData.append("data", data);
  formData.append("nomerazza", nomerazza);
  formData.append("descrizione", descrizione);
    formData.append("ID_Pet", id_pet);
    formData.append("disponibile", disponibile);
  if (img instanceof File) {
    console.log("selected file name:", img.name);
    formData.append("img", img, img.name);
  } else if (oldimg) {
    formData.append("oldimg", oldimg);
  }

  formData.append("descrizioneimg", descrizioneimg);
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
        window.location.href = 'pet.php'
      } else {
        displayAlertWarning(json["msg"]);
      }
    }
  } catch (error) {
    console.log(error.message);
  }
}

async function deletePet(id_pet) {
  const url = "api/api-pet.php?action=delete";
  const formData = new FormData();
  formData.append("ID_Pet", id_pet);
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
        window.location.href = 'pet.php'
      } else {
        displayAlertWarning(json["msg"]);
      }
    }
  } catch (error) {
    console.log(error.message);
  }
}

async function setRaces(id_specie) {
  const url = `api/api-pet.php?action=razze&specie=${id_specie}`;
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Response status: " + response.status);
    }
    const json = await response.json();
    if (json["ok"]) {
      currentRace = nomerazza.dataset.current;
      nomerazza.innerHTML = json.razze.map(razza => `
        <option value="${razza.ID_Razza}" ${razza.Nomerazza === currentRace ? "selected" : ""}>${razza.Nomerazza}</option>
        `
      ).reduce((a, b) => a + b);
    } else {
      displayAlertWarning(json["msg"]);
    }
  } catch (error) {
    console.log(error.message);
  }
}

setRaces(nomespecie.value);
