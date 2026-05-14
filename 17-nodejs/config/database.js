const sqlite3 = require("sqlite3").verbose();
const db = new sqlite3.Database("./subnauticadb.sqlite");

db.serialize(() => {
  // Leviatanes
  db.run(`CREATE TABLE IF NOT EXISTS leviatanes(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT UNIQUE,
    tipo TEXT,
    nivel_peligro INTEGER
)`);

  // Ubicaciones
  db.run(`CREATE TABLE IF NOT EXISTS ubicaciones(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT UNIQUE,
    profundidad INTEGER,
    descripcion TEXT
)`);
});

module.exports = db;
