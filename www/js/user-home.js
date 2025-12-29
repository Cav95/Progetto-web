const deleteAppBtn = document.querySelector("#delete-app");

deleteAppBtn.addEventListener("click", e => {
  cancelSession(e.target.value);
});

document.querySelectorAll("main button").forEach(btn => {
  btn.addEventListener("click", e => {
    deleteAppBtn.value = e.target.value;
  });
});

async function cancelSession(id) {
  const url = "api/api-appuntamenti.php";
  const formData = new FormData();
  formData.append("app-id", id);
  try {
    const response = await fetch(url, {
      method: "POST",
      body: formData
    });
    if (!response.ok) {
      throw new Error("Response status: " + response.status);
    }
    document.querySelector("#app-" + id).remove();
  } catch (error) {
    console.log(error.message);
  }
}