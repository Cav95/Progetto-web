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
      document.querySelector("#app-" + id).remove();
      newAppLink.focus();
      console.log("Prenotazione eliminata!");
    } else {
      throw new Error("Unable to delete session");
    }
  } catch (error) {
    console.log(error.message);
  }
}