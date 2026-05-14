const db = require('../config/database');

exports.getAll = (req, res) => {
    db.all(`SELECT * FROM leviatanes`, [], (err, rows) => {
        if (err) return res.status(500).json({ error: 'Database error' });
        res.json(rows);
    });
};

exports.getById = (req, res) => {
    db.get(`SELECT * FROM leviatanes WHERE id = ?`, [req.params.id], (err, row) => {
        if (err) return res.status(500).json({ error: 'Database error' });
        if (!row) return res.status(404).json({ error: 'No encontrado' });
        res.json(row);
    });
};

exports.create = (req, res) => {
    const { nombre, tipo, nivel_peligro } = req.body;

    db.run(`INSERT INTO leviatanes (nombre, tipo, nivel_peligro)
            VALUES (?, ?, ?)`,
        [nombre, tipo, nivel_peligro],
        function (err) {
            if (err) return res.status(400).json({ error: 'Error al crear' });

            res.json({
                id: this.lastID,
                nombre,
                tipo,
                nivel_peligro
            });
        }
    );
};