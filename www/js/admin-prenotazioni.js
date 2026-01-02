const container = document.querySelector("#app-container");
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
    container.innerHTML = `
      <li class="h3 text-center mt-3 alert alert-info">
        Nessuna prenotazione per la data selezionata
      </li>`;
    return;
  }
  container.innerHTML = sessions.map(s => `
    <li class="card mb-3 px-2 bg-dark text-white" id="app-${s.id_prenotazione}">
      <div class="card-body row">
        <div class="col-md-2 d-flex align-items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" role="img" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16" aria-labelledby="ora-label">
            <title id="ora-label">Ora</title>
            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
          </svg>
          ${s.ora}
        </div>
        <div class="col-md-3 d-flex align-items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" role="img" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16" aria-labelledby="posizione-label">
            <title id="posizione-label">Posizione</title>
            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
          </svg>
          ${s.luogo}
        </div>
        <div class="col-md d-flex align-items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" role="img" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16" aria-labelledby="user-label">
            <title id="user-label">Utente</title>
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
          </svg>
          <a href="user.php?id=${s.utente}" class="link-warning">${s.email}</a>
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-end mt-md-0 mt-3">
          <button type="button" value="${s.id_prenotazione}" class="btn btn-danger delete-app" data-bs-toggle="modal" data-bs-target="#confirmModal">Elimina</button>
        </div>
      </div>
    </li>
  `).reduce((a, b) => a + b);
  document.querySelectorAll(".delete-app").forEach(btn => {
    btn.addEventListener("click", (e) => {
      appTodelete = e.target.value;
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
