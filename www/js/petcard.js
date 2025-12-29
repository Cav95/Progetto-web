function generaCard(petCard) {
    let result = "";
    let disponibile = "";

    result += `<div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 p-4" ></div>`
    for (let i = 0; i < petCard.length; i++) {

        if (petCard[i]["Disponibile"] == 1) {
            disponibile = "Animale disponibile";
        }
        else {
            disponibile = "Animale non disponibile";
        }

        let card = `
<div class="card float-start p-2" style="width: 18rem;">
  <img src="${petCard[i]["Immagine"]}" class="card-img-top" alt="..." alt="${petCard[i]["Descrizioneimmagine"]}">
  <div class="card-body">
    <h5 class="card-title">${petCard[i]["Nomepet"]}</h5>
    <p class="card-text">${petCard[i]["Descrizione"]}</p>
    <ul>
    <li><strong>Razza</strong>: ${petCard[i]["Nomerazza"]}</li>
    <li><strong>Spiece</strong>: ${petCard[i]["Nomespecie"]}</li>
    <li><strong>Disponibilità</strong>: ${disponibile} </li>
    </ul>
    <a href="#" class="btn btn-primary">Go somewhere</a>
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