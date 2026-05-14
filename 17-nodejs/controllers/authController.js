const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const db = require('../config/database');

const SECRET_KEY = 'your_secret';

// REGISTER
exports.register = async (req, res) => {
    const { username, password } = req.body;

    if (!username || !password) {
        return res.status(400).json({ error: 'Datos incompletos' });
    }

    try {
        const hashedPassword = await bcrypt.hash(password, 10);

        db.run(
            `INSERT INTO users (username, password) VALUES (?, ?)`,
            [username, hashedPassword],
            function (err) {
                if (err) {
                    return res.status(400).json({ error: 'Usuario ya existe' });
                }

                res.json({ message: 'Usuario registrado correctamente' });
            }
        );
    } catch (error) {
        res.status(500).json({ error: 'Error en el servidor' });
    }
};

// LOGIN
exports.login = (req, res) => {
    const { username, password } = req.body;

    db.get(
        `SELECT * FROM users WHERE username = ?`,
        [username],
        async (err, user) => {
            if (err) return res.status(500).json({ error: 'Database error' });
            if (!user) return res.status(400).json({ error: 'Credenciales inválidas' });

            const validPassword = await bcrypt.compare(password, user.password);
            if (!validPassword) {
                return res.status(400).json({ error: 'Credenciales inválidas' });
            }

            const token = jwt.sign(
                { id: user.id, username: user.username },
                SECRET_KEY,
                { expiresIn: '1h' }
            );

            res.json({ token });
        }
    );
};

// LOGOUT
exports.logout = (req, res) => {
    db.run(
        `INSERT INTO blacklisted_tokens (token, expires_at) VALUES (?, ?)`,
        [req.token, req.user.exp],
        (err) => {
            if (err) return res.status(400).json({ error: 'Sesión ya cerrada' });
            res.json({ message: 'Logout exitoso' });
        }
    );
};