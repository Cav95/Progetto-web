const appTable = document.querySelector("#app-table");
const appAlert = document.querySelector("#no-app-alert");
const appContainer = document.querySelector("#app-container");
const form = document.querySelector("main form");
const dateChooser = document.querySelector("#data");

const dateFwd = document.querySelector("#date-fwd");
const dateBwd = document.querySelector("#date-bwd");

let cachePTS = {
  sessions: [],
  currDate: "",
  prevDate: "",
  nextDate: ""
};

form.addEventListener("submit", (e) => {
  e.preventDefault();
  dateInputHandler();
});

dateChooser.addEventListener("input", dateInputHandler);

function dateInputHandler() {
  if (dateChooser.checkValidity() && dateChooser.value !== "") {
    changeDate(dateChooser.value);
  }
}

dateBwd.addEventListener("click", () => {
  if (cachePTS.prevDate == cachePTS.currDate) {
    return;
  }
  changeDate(cachePTS.prevDate);
});

dateFwd.addEventListener("click", () => {
  if (cachePTS.nextDate == cachePTS.currDate) {
    return;
  }
  changeDate(cachePTS.nextDate);
});

async function changeDate(newDate) {
  dateChooser.value = newDate;
  await getPTSessions(newDate);
  buildSessions(cachePTS.sessions.filter(s => s.data == cachePTS.currDate));
}

async function getPTSessions(date) {
  const url = `api/api-appuntamenti.php?action=get&of-date=${date}`;
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Response status: " + response.status);
    }
    const json = await response.json();
    if (json["sessions"] == null) {
      throw new Error("Error while retrieving available times");
    }
    window.history.replaceState({date: date}, "", `?date=${date}`);

    cachePTS.sessions = json.sessions;
    cachePTS.currDate = date;
    cachePTS.prevDate = json.min_date;
    cachePTS.nextDate = json.max_date;
    dateFwd.disabled = cachePTS.currDate >= cachePTS.nextDate;
    dateBwd.disabled = cachePTS.currDate <= cachePTS.prevDate;

    console.log(cachePTS);
  } catch (error) {
    console.log(error.message);
  }
}

function buildSessions(sessions) {
  if (sessions.length == 0) {
    appAlert.classList.remove("d-none");
    appTable.classList.add("d-none");
    return;
  }
  const now = new Date().toISOString();
  const date = cachePTS.currDate;
  appAlert.classList.add("d-none");
  appTable.classList.remove("d-none");
  appContainer.innerHTML = sessions.map(s => `
    <tr id="app-${s.id_prenotazione}">
      <td headers="ora" data-label="Ora">
        <div class="d-flex align-items-center gap-2">
          <svg class="icon" aria-hidden="true"><use href="#icon-clock"></use></svg>
          ${s.ora}
        </div>
      </td>
      <td headers="luogo" data-label="Luogo">
        <div class="d-flex align-items-center gap-2">
          <svg class="icon" aria-hidden="true"><use href="#icon-position"></use></svg>
          ${s.luogo}
        </div>
      </td>
      <td headers="utente" data-label="Utente">
        <div class="d-flex align-items-center gap-2">
          <svg class="icon" aria-hidden="true"><use href="#icon-user"></use></svg>
          <a href="utente.php?id=${s.utente}" class="link-warning">${s.email}</a>
        </div>
      </td>
      <td headers="elimina">
        <div class="d-flex align-items-center justify-content-center justify-content-md-end pt-2 pt-md-0">
          <button type="button" data-appid="${s.id_prenotazione}" class="btn btn-danger delete-app" data-bs-toggle="modal" data-bs-target="#confirmModal" ${(date + "T" + s.ora) <= now ? `disabled aria-disabled="true"` : ``}>Annulla sessione</button>
        </div>
      </td>
    </tr>
  `).reduce((a, b) => a + b);
  document.querySelectorAll(".delete-app").forEach(btn => {
    btn.addEventListener("click", (e) => {
      appTodelete = e.target.dataset.appid;
    });
  });
}

const title = document.querySelector("h2");
let appTodelete = -1;

document.querySelector("#delete-app-confirm").addEventListener("click", () => {
  if (appTodelete >= 0) {
    cancelSession(appTodelete);
  }
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
      title.focus();
      setTimeout(() => {
        toDelete.remove();
        if (appContainer.childElementCount == 0) {
          appAlert.classList.remove("d-none");
          appTable.classList.add("d-none");
        }
      }, 150);
      console.log("Prenotazione eliminata!");
    } else {
      throw new Error("Unable to delete session");
    }
  } catch (error) {
    console.log(error.message);
  }
}

const urlParams = new URLSearchParams(window.location.search);
const dataUrl = urlParams.get('date');

if (dataUrl) {
  changeDate(dataUrl);
} else {
  changeDate(new Date().toISOString().split('T')[0]);
}
