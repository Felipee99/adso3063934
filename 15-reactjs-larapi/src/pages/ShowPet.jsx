import { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import api from "../services/api";
import Swal from "sweetalert2";

function ShowPet() {
    const { id } = useParams();
    const navigate = useNavigate();

    const [pet, setPet] = useState({});

    useEffect(() => {
        obtenerMascota();
    }, []);

    const obtenerMascota = async () => {
        try {
            const response = await api.get(`/pets/show/${id}`);

            setPet(response.data.pet);
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
            } else {
                Swal.fire({  
                    icon: "error",
                    title: "Error",
                    text: "Error cargando mascotas",
                    confirmButtonText: "Intentar de nuevo",
                });
            }
        }
    };

    return (
        <main id="show">
            <img src="/img/title-info.png" alt="" />
            <header>
                <img src="" alt="" />
                <a onClick={() => navigate("/dashboard")} className="btnBack">
                    <img src="/img/btnBack.svg" alt="" />
                </a>
            </header>

            <form>
                <label>
                    Nombre
                    <input type="text" value={pet.name || ""} readOnly />
                </label>

                <label>
                    Peso
                    <input type="text" value={pet.weight || ""} readOnly />
                </label>

                <label>
                    Edad
                    <input type="text" value={pet.age || ""} readOnly />
                </label>

                <label>
                    Tipo
                    <input type="text" value={pet.breed || ""} readOnly />
                </label>

                <label>
                    Ubicacion
                    <input type="text" value={pet.location || ""} readOnly />
                </label>
            </form>
        </main>
    );
}

export default ShowPet;
