import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";
import api from "../services/api";
import Swal from "sweetalert2";

function Dashboard() {
    const navigate = useNavigate();
    const [pets, setPets] = useState([]);

    useEffect(() => {
        obtenerMascotas();
    }, []);

    const obtenerMascotas = async () => {
        const token = localStorage.getItem("token");

        try {
            const response = await api.get("/pets/list");

            setPets(response.data.pets); 
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
                    text: "No se pudieron cargar las mascotas",
                });
            }
        }
    };

    const logout = () => {
        localStorage.removeItem("token");
        navigate("/");
    };

    const eliminarMascota = async (id) => {
        const result = await Swal.fire({
            title: "¿Eliminar mascota?",
            text: "Esta acción no se puede deshacer",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        });

        if (result.isConfirmed) {
            try {
                await api.delete(`/pets/delete/${id}`);

                Swal.fire({
                    icon: "success",
                    title: "Mascota eliminada",
                    timer: 1500,
                    showConfirmButton: false,
                });

                obtenerMascotas(); // vuelve a cargar la lista
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "No se pudo eliminar la mascota",
                });
            }
        }
    };

    return (
        <main id="dashboard">
            <header>
                <img src="/img/title-dashboard.png" alt="dashboard" />
            </header>

            <section className="list">
                {pets.map((pet) => (
                    <div className="row" key={pet.id}>
                        <img src="/img/no-image.png" alt="pet" />

                        <div className="data">
                            <h3>{pet.name}</h3>
                            <h4>{pet.kind}</h4>
                        </div>

                        <nav className="actions">
                            <a
                                className="btnShow"
                                onClick={() => navigate(`/show/${pet.id}`)}
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="32"
                                    fill="#000000"
                                    viewBox="0 0 256 256"
                                >
                                    <path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"></path>
                                </svg>
                            </a>

                            <a
                                className="btnEdit"
                                onClick={() => navigate(`/edit/${pet.id}`)}
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="32"
                                    fill="#000000"
                                    viewBox="0 0 256 256"
                                >
                                    <path d="M200,32H163.74a47.92,47.92,0,0,0-71.48,0H56A16,16,0,0,0,40,48V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V48A16,16,0,0,0,200,32Zm-72,0a32,32,0,0,1,32,32H96A32,32,0,0,1,128,32Zm72,184H56V48H82.75A47.93,47.93,0,0,0,80,64v8a8,8,0,0,0,8,8h80a8,8,0,0,0,8-8V64a47.93,47.93,0,0,0-2.75-16H200Z"></path>
                                </svg>
                            </a>

                            <a
                                className="btnDelete"
                                onClick={() => eliminarMascota(pet.id)}
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="32"
                                    fill="#000000"
                                    viewBox="0 0 256 256"
                                >
                                    <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                </svg>
                            </a>
                        </nav>
                    </div>
                ))}
            </section>

            <nav>
                <a onClick={logout}>
                    <img src="img/boton.png" alt="" />
                </a>

                <a onClick={() => navigate("/add")}>
                    <img src="img/boton2.png" alt="" />
                </a>
            </nav>
        </main>
    );
}

export default Dashboard;
