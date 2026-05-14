const db = require('../config/database');

// GET ALL
exports.getAll = (req, res) => {
    db.all(`SELECT * FROM ubicaciones`, [], (err, rows) => {
        if (err) return res.status(500).json({ error: 'Database error' });
        res.json(rows);
    });
};

// GET BY ID
exports.getById = (req, res) => {
    db.get(`SELECT * FROM ubicaciones WHERE id = ?`, [req.params.id], (err, row) => {
        if (err) return res.status(500).json({ error: 'Database error' });
        if (!row) return res.status(404).json({ error: 'Ubicación no encontrada' });
        res.json(row);
    });
};

// POST
exports.create = (req, res) => {
    const { nombre, profundidad, descripcion } = req.body;

    db.run(
        `INSERT INTO ubicaciones (nombre, profundidad, descripcion)
         VALUES (?, ?, ?)`,
        [nombre, profundidad, descripcion],
        function (err) {
            if (err) return res.status(400).json({ error: 'Error al crear ubicación' });

            res.json({
                id: this.lastID,
                nombre,
                profundidad,
                descripcion
            });
        }
    );
};