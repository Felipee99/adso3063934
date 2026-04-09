import { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../services/api";
import Swal from "sweetalert2";

function AddPet() {
    const navigate = useNavigate();

    const [name, setName] = useState("");
    const [kind, setKind] = useState("");
    const [weight, setWeight] = useState("");
    const [age, setAge] = useState("");
    const [breed, setBreed] = useState("");
    const [location, setLocation] = useState("");
    const [description, setDescription] = useState("");

    const guardarMascota = async (e) => {
        e.preventDefault();

        const data = {
            name,
            kind,
            weight,
            age,
            breed,
            location,
            description,
        };

        try {
            await api.post("/pets/store", data);

            Swal.fire({
                icon: "success",
                title: "Tu mascota fue creada",
                showConfirmButton: false,
                timer: 1500,
            });

            navigate("/dashboard");
        } catch (error) {
            if (error.response && error.response.status === 401) {
                localStorage.removeItem("token");

                Swal.fire({
                    icon: "warning",
                    title: "Sesión expirada",
                    text: "Debes iniciar sesión nuevamente",
                });

                navigate("/");
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Error creando mascota",
                });
            }
        }
    };

    return (
        <main id="add">
            <header>
                <img src="img/title-add.png" alt="" />
            </header>

            <form onSubmit={guardarMascota}>
                <label>
                    Nombre
                    <input
                        type="text"
                        onChange={(e) => setName(e.target.value)}
                    />
                </label>

                <label>
                    Tipo
                    <input
                        type="text"
                        onChange={(e) => setKind(e.target.value)}
                    />
                </label>

                <label>
                    Peso
                    <input
                        type="text"
                        onChange={(e) => setWeight(e.target.value)}
                    />
                </label>

                <label>
                    Edad
                    <input
                        type="text"
                        onChange={(e) => setAge(e.target.value)}
                    />
                </label>

                <label>
                    Raza
                    <input
                        type="text"
                        onChange={(e) => setBreed(e.target.value)}
                    />
                </label>

                <label>
                    Ubicacion
                    <input
                        type="text"
                        onChange={(e) => setLocation(e.target.value)}
                    />
                </label>

                <label>
                    descripción
                    <input
                        type="text"
                        onChange={(e) => setDescription(e.target.value)}
                    />
                </label>

                <div className="buttons">
                    <button type="submit">Guardar</button>

                    <button
                        type="button"
                        onClick={() => navigate("/dashboard")}
                    >
                        Volver
                    </button>
                </div>
            </form>
        </main>
    );
}

export default AddPet;
