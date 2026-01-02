const container = document.querySelector("#app-container");
const deleteAppBtn = document.querySelector("#delete-app-confirm");
const newAppLink = document.querySelector("#new-app");

let appTodelete = -1;

deleteAppBtn.addEventListener("click", () => {
  if (appTodelete >= 0) {
    cancelSession(appTodelete);
  }
});

document.querySelectorAll(".delete-app").forEach(btn => {
  btn.addEventListener("click", e => {
    appTodelete = e.target.value;
  });
});

async function cancelSession(id) {
  const url = `api/api-appuntamenti.php?action=delete&app-id=${id}`;
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Response status: " + response.status);
    }
    const json = await response.json();
    if (json["ok"]) {
      const toDelete = document.querySelector("#app-" + id)
      toDelete.classList.add("fade");
      newAppLink.focus();
      setTimeout(() => {
        toDelete.remove();
        if (document.querySelector("main ul").childElementCount == 0) {
          container.innerHTML = `<li class="h3 text-center mt-3 alert alert-info">Non hai nessuna prenotazione</li>`;
        }
      }, 150);
    } else {
      throw new Error("Unable to delete session");
    }
  } catch (error) {
    console.log(error.message);
  }
}