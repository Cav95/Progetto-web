function generaCard(petCard) {
    let result = "";
    let disponibile = "";
    let buttom = "";
    let addPetbuttom = "";
    result += `
    <section>
        <h2 class="h2 text-center mt-4">Conosci i nostri Pet!</h2>
        <div class="container my-4">
            <div class="row justify-content-center g-3">
    `;
    if (petCard["isadmin"] && petCard["islogedin"]) {
        addPetbuttom = `
            <div class="container text-center p-3">
                <div class="row justify-content-md-center">
                    <a href="add-pet.php" class="col-md-auto btn btn-primary allign-center">Aggiungi Pet</a>
                </div>
            </div>
        `;
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
            disponibile = "Attualmente non disponibile";
            card +=`<div class="opacity-50 card float-start p-2" style="width: 18rem;">` ;
        }

        card += `
            <img src="${petCard["pet"][i]["Immagine"]}" class="card-img-top img-rounded " id="cane" alt="${petCard["pet"][i]["Descrizioneimmagine"]}"/>
            <div class="card-body align-content-lg-end">
                <h3 class="card-title h5">${petCard["pet"][i]["Nomepet"]}</h3>
                <p class="card-text">${petCard["pet"][i]["Descrizione"]}</p>
                <ul>
                    <li><strong>Specie</strong>: ${petCard["pet"][i]["Nomespecie"]}</li>
                    <li><strong>Razza</strong>: ${petCard["pet"][i]["Nomerazza"]}</li>
                    <li><strong>${disponibile}</strong></li>
                </ul>
        `;
        if (petCard["isadmin"] && petCard["islogedin"]) {
            card += `
                <div class="container text-center p-3">
                    <div class="row justify-content-md-center">
                        <a href="add-pet.php?pet-id=${petCard["pet"][i]["ID_Pet"]}" value="${petCard["pet"][i]["ID_Pet"]}" id=pet-btn" class="btn btn-primary">Modifica Pet</a>
                    </div>
                </div>
            `;
        }
        card += `</div></div>`;
        result += card;
    }
    result += `</div></div></div></section>`;
    return result;
}

async function getPetData() {
    const url = "api/api-getpets.php";
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