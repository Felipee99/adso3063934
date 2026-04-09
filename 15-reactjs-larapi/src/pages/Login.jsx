import { useNavigate } from "react-router-dom";
import { useState, useEffect } from "react";
import axios from "axios";
import Swal from "sweetalert2";

function Login() {
    const navigate = useNavigate();

    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    useEffect(() => {
        const token = localStorage.getItem("token");

        if (token) {
            navigate("/dashboard");
        }
    }, [navigate]);

    const handleLogin = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post(
                "http://localhost:8000/api/login",
                {
                    email: email,
                    password: password,
                }
            );

            const token = response.data.token;

            localStorage.setItem("token", token);

            Swal.fire({
                icon: "success",
                title: "Bienvenido",
                text: "Login exitoso",
                timer: 1500,
                showConfirmButton: false,
            });

            setTimeout(() => {
                navigate("/dashboard");
            }, 1500);

        } catch (error) {

            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Credenciales incorrectas",
                confirmButtonText: "Intentar de nuevo",
            });

        }
    };

    return (
        <main id="login">
            <header>
                <img src="/img/title-login.png" alt="" />
            </header>

            <form onSubmit={handleLogin}>
                <label>
                    Email
                    <input
                        type="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />
                </label>

                <label>
                    Password
                    <input
                        type="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />
                </label>

                <button type="submit">Login</button>
            </form>
        </main>
    );
}

export default Login;
