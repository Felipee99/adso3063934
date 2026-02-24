// ===================================
// CONFIG
// ===================================
const API = "http://127.0.0.1:8000/api/";
const STORAGE = "http://127.0.0.1:8000/"; // URL base para Laravel public
let token = localStorage.getItem("authToken");
let currentEditId = null;
let currentPetId = null;

// ===================================
// VIEWS
// ===================================
const views = document.querySelectorAll("main");
const petList = document.querySelector(".list");

// Forms
const addForm = document.querySelector("#add form");
const editForm = document.querySelector("#edit form");

// Buttons
const btnLogout = document.querySelector(".btnLogout");
const btnAdd = document.querySelector(".btnAdd");
const btnBack = document.querySelectorAll(".btnBack");
const btnCancel = document.querySelectorAll(".btnCancel");

// SweetAlert2 library (ensure it's loaded in HTML)
// Add this in index.html if not present:
// <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

// ===================================
// VIEW CONTROL
// ===================================
function showView(index) {
  views.forEach(v => v.style.display = "none");
  views[index].style.display = "block";

  // Save current view to localStorage
  localStorage.setItem("currentView", index);

  if (index === 1) getPets();
}

// 0 = login
// 1 = dashboard
// 2 = add
// 3 = show
// 4 = edit

// Initialize app
function initApp() {
  if (token) {
    // Get the last view the user was on
    const lastView = localStorage.getItem("currentView");
    const lastPetId = localStorage.getItem("currentPetId");
    
    if (lastView) {
      const viewIndex = parseInt(lastView);
      
      // Restore the previous view
      if (viewIndex === 3 && lastPetId) {
        // Show view
        showPet(lastPetId);
      } else if (viewIndex === 4 && lastPetId) {
        // Edit view
        loadEditPet(lastPetId);
      } else if (viewIndex === 2) {
        // Add view
        showView(2);
      } else {
        // Dashboard (default for authenticated users)
        showView(1);
      }
    } else {
      // First time, show dashboard
      showView(1);
    }
  } else {
    // Not authenticated, show login
    localStorage.removeItem("currentView");
    localStorage.removeItem("currentPetId");
    showView(0);
  }
}

// Start the app
initApp();

// ===============================
// LOGIN FORM
// ===============================
const loginForm = document.querySelector("#loginForm");

loginForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  try {
    const email = document.querySelector("#loginForm input[name='email']").value.trim();
    const password = document.querySelector("#loginForm input[name='password']").value.trim();

    // Validate inputs
    if (!email || !password) {
      Swal.fire("Validation Error", "Please fill in all fields", "warning");
      return;
    }

    // Disable button during request
    const btnLogin = loginForm.querySelector("button[type='submit']");
    btnLogin.disabled = true;
    const originalText = btnLogin.textContent;
    btnLogin.textContent = "Logging in...";

    const response = await fetch(API + "login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify({ email, password }),
    });

    const data = await response.json();

    if (response.ok && data.token) {
      // Save token
      localStorage.setItem("authToken", data.token);
      token = data.token;
      
      Swal.fire("Success!", data.message || "Login successful", "success").then(() => {
        // Clear form and show dashboard
        loginForm.reset();
        showView(1);
      });
    } else {
      Swal.fire("Error", data.message || "Invalid credentials", "error");
    }
  } catch (error) {
    console.error("Login error:", error);
    Swal.fire("Error", "An error occurred. Please try again.", "error");
  } finally {
    // Restore button state
    const btnLogin = loginForm.querySelector("button[type='submit']");
    btnLogin.disabled = false;
    btnLogin.textContent = "login";
  }
});

// ===================================
// LOGOUT
// ===================================
btnLogout.addEventListener("click", async () => {
  try {
    const response = await fetch(API + "logout", {
      method: "POST",
      headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "application/json"
      }
    });

    // Clear all stored data
    localStorage.removeItem("authToken");
    localStorage.removeItem("currentView");
    localStorage.removeItem("currentPetId");
    token = null;
    
    // Show login view
    showView(0);
    
    // Clear form
    loginForm.reset();
    
    if (response.ok) {
      Swal.fire("Logged Out", "You have been successfully logged out.", "success");
    }
  } catch (error) {
    console.error("Logout error:", error);
    // Still logout locally
    localStorage.removeItem("authToken");
    localStorage.removeItem("currentView");
    localStorage.removeItem("currentPetId");
    token = null;
    showView(0);
  }
});

// ===================================
// GET PETS
// ===================================
async function getPets() {
  try {
    const response = await fetch(API + "pets/list", {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });

    const data = await response.json();

    if (response.ok) {
      renderPets(data.pets || data);
    } else {
      console.error("Error fetching pets:", data);
    }
  } catch (error) {
    console.error("Error fetching pets:", error);
  }
}

// ===================================
// RENDER PETS
// ===================================
function renderPets(pets) {
  petList.innerHTML = "";

  pets.forEach(pet => {
    console.log("Pet data:", pet); // Debug: ver los datos
    
    // Build image URL from filename
    // let petImage = "img/no-image.png"; // Default image
    
    if (pet.image) {
      // Construct full URL - Si ya tiene http, usala tal cual; si no, agrégale el dominio
      if (pet.image.startsWith('http')) {
        petImage = pet.image;
      } else {
        petImage = STORAGE + pet.image;
      }
    } else if (pet.imagen) {
      if (pet.imagen.startsWith('http')) {
        petImage = pet.imagen;
      } else {
        petImage = STORAGE + pet.imagen;
      }
    }
    
    console.log("Final image URL:", petImage); // Debug: ver la URL final
    
    petList.innerHTML += `
      <div class="row">
        <img src="${petImage}" alt="${pet.nombre || pet.name}" onerror="this.src='img/no-image.png'; console.log('Image failed:', '${petImage}');" />
        <div class="data">
          <h3>${pet.nombre || pet.name}</h3>
          <h4>${pet.tipo || pet.kind}</h4>
        </div>
        <nav class="actions">
          <a href="#" class="btnShow" data-id="${pet.id}"></a>
          <a href="#" class="btnEdit" data-id="${pet.id}"></a>
          <a href="#" class="btnDelete" data-id="${pet.id}"></a>
        </nav>
      </div>
    `;
  });
}

// ===================================
// EVENT DELEGATION
// ===================================
petList.addEventListener("click", (e) => {
  e.preventDefault();

  const showBtn = e.target.closest(".btnShow");
  const editBtn = e.target.closest(".btnEdit");
  const deleteBtn = e.target.closest(".btnDelete");

  if (showBtn) showPet(showBtn.dataset.id);
  if (editBtn) loadEditPet(editBtn.dataset.id);
  if (deleteBtn) deletePet(deleteBtn.dataset.id);
});

// ===================================
// SHOW PET
// ===================================
async function showPet(id) {

  const response = await fetch(API + "pets/show/" + id, {
    headers: { Authorization: `Bearer ${token}` }
  });

  const data = await response.json();
  const pet = data.pet || data;

  console.log("Show pet data:", pet); // Debug

  // Fill form fields
  document.querySelector("#show input[name='nombre']").value = pet.nombre || pet.name || '';
  document.querySelector("#show input[name='peso']").value = pet.peso || pet.weight || '';
  document.querySelector("#show input[name='edad']").value = pet.edad || pet.age || '';
  document.querySelector("#show input[name='raza']").value = pet.raza || pet.breed || '';
  document.querySelector("#show input[name='ubicacion']").value = pet.ubicacion || pet.location || '';

  // Load pet image
  const petImage = document.querySelector("#petImage");
  
  // Build image URL from filename
  let imageUrl = "img/pet.png"; // Default
  
  if (pet.image) {
    imageUrl = pet.image.startsWith('http') ? pet.image : STORAGE + pet.image;
  } else if (pet.imagen) {
    imageUrl = pet.imagen.startsWith('http') ? pet.imagen : STORAGE + pet.imagen;
  }
  
  console.log("Final show image URL:", imageUrl); // Debug
  petImage.src = imageUrl;
  
  // Fallback if image fails to load
  petImage.onerror = function() {
    console.log("Image failed to load:", imageUrl);
    this.src = "img/pet.png";
  };

  // Make all inputs readonly
  document.querySelectorAll("#show input").forEach(input => {
    input.setAttribute("readonly", "true");
  });

  // Save pet ID for restoration on reload
  currentPetId = id;
  localStorage.setItem("currentPetId", id);

  showView(3);
}

// ===================================
// ADD PET
// ===================================
btnAdd.addEventListener("click", () => showView(2));

addForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  // Get form values
  const nombre = addForm.nombre.value.trim();
  const tipo = addForm.tipo.value.trim();
  const peso = addForm.peso.value.trim();
  const edad = addForm.edad.value.trim();
  const raza = addForm.raza.value.trim();
  const ubicacion = addForm.ubicacion.value.trim();
  const descripcion = addForm.descripcion.value.trim();

  // Basic validation
  if (!nombre || !tipo || !peso || !edad || !raza || !ubicacion || !descripcion) {
    Swal.fire("Validation Error", "Please fill all the fields", "warning");
    return;
  }

  try {
    // Map Spanish field names to English (what API expects)
    const formData = {
      name: nombre,
      kind: tipo,
      weight: peso,
      age: edad,
      breed: raza,
      location: ubicacion,
      description: descripcion
    };

    console.log("Sending pet data:", formData);

    const response = await fetch(API + "pets/store", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`
      },
      body: JSON.stringify(formData)
    });

    const data = await response.json();
    console.log("Response:", response.status, data);

    if (response.ok) {
      Swal.fire("Success!", "Pet added successfully", "success").then(() => {
        addForm.reset();
        // Clear saved pet ID when adding new
        currentPetId = null;
        localStorage.removeItem("currentPetId");
        showView(1);
      });
    } else {
      Swal.fire("Error", data.message || "Failed to add pet", "error");
    }
  } catch (error) {
    console.error("Add pet error:", error);
    Swal.fire("Error", "An error occurred while adding the pet", "error");
  }
});

// ===================================
// LOAD EDIT
// ===================================
async function loadEditPet(id) {

  const response = await fetch(API + "pets/show/" + id, {
    headers: { Authorization: `Bearer ${token}` }
  });

  const data = await response.json();
  const pet = data.pet || data;

  currentEditId = id;
  currentPetId = id;

  // Map API fields (English) to form fields (Spanish)
  editForm.nombre.value = pet.nombre || pet.name || '';
  editForm.tipo.value = pet.tipo || pet.kind || '';
  editForm.peso.value = pet.peso || pet.weight || '';
  editForm.edad.value = pet.edad || pet.age || '';
  editForm.raza.value = pet.raza || pet.breed || '';
  editForm.ubicacion.value = pet.ubicacion || pet.location || '';
  editForm.descripcion.value = pet.descripcion || pet.description || '';

  // Save pet ID for restoration on reload
  localStorage.setItem("currentPetId", id);

  showView(4);
}

// ===================================
// UPDATE PET
// ===================================
editForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  // Get form values
  const nombre = editForm.nombre.value.trim();
  const tipo = editForm.tipo.value.trim();
  const peso = editForm.peso.value.trim();
  const edad = editForm.edad.value.trim();
  const raza = editForm.raza.value.trim();
  const ubicacion = editForm.ubicacion.value.trim();
  const descripcion = editForm.descripcion.value.trim();

  // Basic validation
  if (!nombre || !tipo || !peso || !edad || !raza || !ubicacion || !descripcion) {
    Swal.fire("Validation Error", "Please fill all the fields", "warning");
    return;
  }

  try {
    // Map Spanish field names to English (what API expects)
    const formData = {
      name: nombre,
      kind: tipo,
      weight: peso,
      age: edad,
      breed: raza,
      location: ubicacion,
      description: descripcion
    };

    console.log("Updating pet", currentEditId, "with data:", formData);

    const response = await fetch(API + "pets/edit/" + currentEditId, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${token}`
      },
      body: JSON.stringify(formData)
    });

    const data = await response.json();
    console.log("Update response:", response.status, data);

    if (response.ok) {
      Swal.fire("Success!", "Pet updated successfully", "success").then(() => {
        // Clear saved pet ID when updating
        currentPetId = null;
        localStorage.removeItem("currentPetId");
        showView(1);
      });
    } else {
      Swal.fire("Error", data.message || "Failed to update pet", "error");
    }
  } catch (error) {
    console.error("Update pet error:", error);
    Swal.fire("Error", "An error occurred while updating the pet", "error");
  }
});

// ===================================
// DELETE PET
// ===================================
async function deletePet(id) {

  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to recover this pet!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete it!"
  }).then(async (result) => {
    if (result.isConfirmed) {
      try {
        const response = await fetch(API + "pets/delete/" + id, {
          method: "DELETE",
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        if (response.ok) {
          Swal.fire("Deleted!", "Your pet has been deleted.", "success");
          // Clear saved pet ID when deleting
          currentPetId = null;
          localStorage.removeItem("currentPetId");
          getPets();
        } else {
          Swal.fire("Error", "Failed to delete pet", "error");
        }
      } catch (error) {
        console.error("Delete error:", error);
        Swal.fire("Error", "An error occurred while deleting", "error");
      }
    }
  });
}

// ===================================
// BACK BUTTONS
// ===================================
btnBack.forEach(btn => {
  btn.addEventListener("click", () => {
    // Clear saved pet ID when going back to dashboard
    currentPetId = null;
    localStorage.removeItem("currentPetId");
    showView(1);
  });
});

btnCancel.forEach(btn => {
  btn.addEventListener("click", () => {
    // Clear saved pet ID when canceling
    currentPetId = null;
    localStorage.removeItem("currentPetId");
    showView(1);
  });
});
