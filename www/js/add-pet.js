const alertWarning = document.querySelector("#alert-warning");
const alertSuccess = document.querySelector("#alert-success");
const form = document.querySelector("main form");

form.addEventListener("submit", e => {
  if (form.checkValidity()) {
    e.preventDefault();
    const nome = document.querySelector("#nome").value;
    const datanascita = document.querySelector("#data-nascita").value;
    const nomespecie = document.querySelector("#nomespecie").value;
    const nomerazza = document.querySelector("#nomerazza").value;
    const descrizione = document.querySelector("#Descrizione").value; 
    const img = document.querySelector("#pet-img").value;
    const descrizioneimg = document.querySelector("#Descrizione-img").value;
    register(nome, datanascita, nomespecie, nomerazza, descrizione,img,descrizioneimg)
  }
});

async function register(nome, datanascita, nomespecie, nomerazza, descrizione,img,descrizioneimg) {
  const url = "api/api-addpet.php";
  const formData = new FormData();
  formData.append("nome", nome);
  formData.append("datanascita", datanascita);
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