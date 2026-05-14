const express = require('express');
const cors = require('cors');

const app = express();

// MIDDLEWARES
app.use(express.json());
app.use(cors());

// RUTAS
app.use('/auth', require('./routes/auth'));
app.use('/ubicaciones', require('./routes/ubicaciones'));
app.use('/leviatanes', require('./routes/leviatanes'));

// SERVER
app.listen(3000, () => {
    console.log('Servidor corriendo en http://localhost:3000');
});