import { useState, useEffect } from "react";
import { useNavigate, useParams } from "react-router-dom";
import api from "../services/api";
import Swal from "sweetalert2";

function EditPet() {
    const { id } = useParams();
    const navigate = useNavigate();

    const [name, setName] = useState("");
    const [kind, setKind] = useState("");
    const [weight, setWeight] = useState("");
    const [age, setAge] = useState("");
    const [breed, setBreed] = useState("");
    const [location, setLocation] = useState("");
    const [description, setDescription] = useState("");

    useEffect(() => {
        obtenerMascota();
    }, []);

    const obtenerMascota = async () => {
        try {
            const response = await api.get(`/pets/show/${id}`);

            const pet = response.data.pet;

            setName(pet.name);
            setKind(pet.kind);
            setWeight(pet.weight);
            setAge(pet.age);
        } catch (error) {
            if (error.response && error.response.status === 401) {
                localStorage.removeItem("token");

                Swal.fire({
                    icon: "warning",
                    title: "Sesión expirada",
                    text: "Debes iniciar sesión nuevamente",
                });

                navigate("/");
                
            } else if (error.response && error.response.status === 404) {
                Swal.fire({
                    icon: "warning",
                    title: "Mascota no encontrada",
                    text: "La mascota que buscas no existe",
                });

                navigate("/dashboard");
            }
                
                else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Error cargando mascotas",
                    confirmButtonText: "Intentar de nuevo",
                });
            }
        }
    };

    const actualizarMascota = async (e) => {
        e.preventDefault();

        const data = {
            name,
            kind,
            weight,
            age,
        };

        try {
            await api.put(`/pets/edit/${id}`, data);

            Swal.fire({
                icon: "success",
                title: "Tu mascota fue actualizada",
                showConfirmButton: false,
                timer: 1500,
            });

            navigate("/dashboard");
        } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Error actualizando mascotas",
                });
            }
    };

    return (
        <main id="edit">
            <img className="titleEditar" src="/img/title.editar.png" alt="" />
            <header>
                <a onClick={() => navigate("/dashboard")}>
                    <img src="/img/btnBack.svg" alt="edit" />
                </a>
            </header>

            <form onSubmit={actualizarMascota}>
                <label>
                    Nombre
                    <input
                        type="text"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                    />
                </label>

                <label>
                    Tipo
                    <input
                        type="text"
                        value={kind}
                        onChange={(e) => setKind(e.target.value)}
                    />
                </label>

                <label>
                    Peso
                    <input
                        type="text"
                        value={weight}
                        onChange={(e) => setWeight(e.target.value)}
                    />
                </label>

                <label>
                    Edad
                    <input
                        type="text"
                        value={age}
                        onChange={(e) => setAge(e.target.value)}
                    />
                </label>

                <div className="buttons">
                    <button type="submit">Actualizar</button>

                    <button
                        type="button"
                        id="btnCancelar"
                        onClick={() => navigate("/dashboard")}
                    >
                        Cancelar
                    </button>
                </div>
            </form>
        </main>
    );
}

export default EditPet;
