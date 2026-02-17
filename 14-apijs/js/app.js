// all views(main)
const views = document.querySelectorAll("main");

// currentView

if (localStorage.getItem("currentView") != null) {
  showView();
} else {
  localStorage.setItem("currentView", 0);
  showView();
}

// buttons & anchors
const btnLogout = document.querySelector(".btnLogout");
const btnAdd = document.querySelector(".btnAdd");
const btnBack = document.querySelectorAll(".btnBack");
const btnShow = document.querySelectorAll(".btnShow");
const btnEdit = document.querySelectorAll(".btnEdit");
const btnCancel = document.querySelectorAll(".btnCancel");
const petList = document.querySelector("#petList");

// loginform(POST)
const loginForm = document.querySelector("#loginForm");
loginForm.addEventListener("submit", async function (e) {
  e.preventDefault();
  try {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const response = await fetch("http://127.0.0.1:8000/api/login", {
      method: "POST",
      headers: {
        "Content-type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({
        email: email,
        password: password,
      }),
    });

    const data = await response.json();
    if (response.ok) {
      Swal.fire({
        title: "Success!",
        text: data.message,
        icon: "success",
        showConfirmButton: false,
        timer: 1500,
      });
      currentView = 1;
      showView();
      localStorage.setItem("authToken", data.token);
      localStorage.setItem("currentView", 1);
      showView();
    } else {
      Swal.fire({
        title: "Error",
        text: data.message,
        icon: "error",
      });
    }
  } catch (error) {
    console.error(error.message);
  }
});

async function getPets() {
  try {
    const token = localStorage.getItem("authToken");

    const response = await fetch("http://127.0.0.1:8000/api/pets/list", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`,
      },
    });

    const data = await response.json();
    console.log(data);

    if (response.ok) {
      renderPets(data.pets);
    } else {
      console.log(data.message);
    }
  } catch (error) {
    console.log(error);
  }
}

function renderPets(pets) {
  petList.innerHTML = ""; // limpia antes de pintar

  pets.forEach((pet) => {
    petList.innerHTML += `
      <div class="row">
        <img src="img/pet.png" alt="pet" />
        <div class="data">
          <h3>${pet.name}</h3>
          <h4>${pet.kind}</h4>
        </div>
        <nav class="actions">
          <a href="javascript:;" class="btnShow"></a>
          <a href="javascript:;" class="btnEdit"></a>
          <a href="javascript:;" class="btnDelete"></a>
        </nav>
      </div>
    `;
  });
}

btnLogout.addEventListener("click", () => {
  localStorage.removeItem("authToken");
  localStorage.setItem("currentView", 0);
  showView();
});

btnAdd.addEventListener("click", () => {
  localStorage.setItem("currentView", 2);
  showView();
});

btnBack.forEach((element) => {
  element.addEventListener("click", () => {
    localStorage.setItem("currentView", 1);
    showView();
  });
});

btnShow.forEach((element) => {
  element.addEventListener("click", () => {
    localStorage.setItem("currentView", 3);
    showView();
  });
});

btnEdit.forEach((element) => {
  element.addEventListener("click", () => {
    localStorage.setItem("currentView", 4);
    showView();
  });
});

btnCancel.forEach((element) => {
  element.addEventListener("click", () => {
    localStorage.setItem("currentView", 1);
    showView();
  });
});

function showView() {
  views.forEach((element) => {
    element.classList.remove("animateView");
    element.style.display = "none";
  });

  const current = localStorage.getItem("currentView");

  views[current].classList.add("animateView");
  views[current].style.display = "block";

  if (current == 1) {
    getPets();
  }
}
