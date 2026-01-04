function generaCard(petCard) {
    let result = "";
    let disponibile = "";
    let buttom = "";
    let addPetbuttom = "";
    result += `<div class="container">
                <div class="row justify-content-md-center">`
    if (petCard["isadmin"] && petCard["islogedin"]) {
        addPetbuttom = `<div class="container text-center p-3">
                            <div class="row justify-content-md-center">
                             <a href="add-pet.php" class="col-md-auto btn btn-primary allign-center">Aggiungi Pet</a>
                             </div>
                        </div>`
    }

    result += addPetbuttom;

    for (let i = 0; i < petCard["pet"].length; i++) {
        let card = "";
        let dispo = petCard["pet"][i]["Disponibile"] == 1
        if (dispo) {
            disponibile = "Disponibile";
            card +=`<div class="card float-start p-2" style="width: 18rem;">` ;
        }
        else {
            disponibile = "Non disponibile";
            card +=`<div class="opacity-25 card float-start p-2" style="width: 18rem;">` ;
        }

        card += `
  <img src="${petCard["pet"][i]["Immagine"]}" class="card-img-top img-rounded " id="cane" alt="${petCard["pet"][i]["Descrizioneimmagine"]}">
  <div class="card-body align-content-lg-end">
    <h5 class="card-title">${petCard["pet"][i]["Nomepet"]}</h5>
    <p class="card-text">${petCard["pet"][i]["Descrizione"]}</p>
    <ul>
    <li><strong>Razza</strong>: ${petCard["pet"][i]["Nomerazza"]}</li>
    <li><strong>Specie</strong>: ${petCard["pet"][i]["Nomespecie"]}</li>
    <li><strong>Disponibilità</strong>: ${disponibile} </li>
    </ul>
`;
        if (petCard["isadmin"] && petCard["islogedin"]) {


            card += `<div class="container text-center p-3">
        <div class="row justify-content-md-center">
        <a href="add-pet.php?pet-id=${petCard["pet"][i]["ID_Pet"]}" value="${petCard["pet"][i]["ID_Pet"]}" id=pet-btn" class="btn btn-primary">Modifica Pet</a>
            </div>
    </div>`
        }
        card += `  </div>
                        </div>`     

        result += card;
    }
    result += `</div>
                </div>
                </div>`;
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