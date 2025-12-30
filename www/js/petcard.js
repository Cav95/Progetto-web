function generaCard(petCard) {
    let result = "";
    let disponibile = "";
    let buttom = "";
    let addPetbuttom = "";

    if (petCard["isadmin"] && petCard["islogedin"]) {
        addPetbuttom = `<div class="container text-center">
        <div class="row justify-content-md-center">
        <a href="#" class="col-md-auto btn btn-primary allign-center">Aggiungi Pet</a>
          </div>
</div>`

        buttom = `<a href="#" class="btn btn-primary">Modifica Pet</a>`
    }

    result += addPetbuttom;
    result += `<div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 p-4" ></div>`
    for (let i = 0; i < petCard["pet"].length; i++) {

        if (petCard["pet"][i]["Disponibile"] == 1) {
            disponibile = "Animale disponibile";
        }
        else {
            disponibile = "Animale non disponibile";
        }

        let card = `
<div class="card float-start p-2" style="width: 18rem;">
  <img src="${petCard["pet"][i]["Immagine"]}" class="card-img-top" alt="..." alt="${petCard["pet"][i]["Descrizioneimmagine"]}">
  <div class="card-body">
    <h5 class="card-title">${petCard["pet"][i]["Nomepet"]}</h5>
    <p class="card-text">${petCard["pet"][i]["Descrizione"]}</p>
    <ul>
    <li><strong>Razza</strong>: ${petCard["pet"][i]["Nomerazza"]}</li>
    <li><strong>Specie</strong>: ${petCard["pet"][i]["Nomespecie"]}</li>
    <li><strong>Disponibilità</strong>: ${disponibile} </li>
    </ul>
    ${buttom}
  </div>
</div>
        `;

        result += card;

    }
    result += `</div>`;
    return result;
}

async function getPetData() {
    const url = "api//api-petpage.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error("Response status: " + response.status);
        }
        const json = await response.json();
        console.log(json);
        const articoli = generaCard(json);
        const main = document.querySelector("main");
        main.innerHTML = articoli;

    }
    catch (error) {
        console.log(error.message);
    }

}

getPetData();