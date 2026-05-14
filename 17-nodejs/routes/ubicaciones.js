const express = require('express');
const router = express.Router();
const auth = require('../midllewares/authMiddleware');
const controller = require('../controllers/ubicacionesController');

// GET ALL
router.get('/', auth, controller.getAll);

// GET BY ID
router.get('/:id', auth, controller.getById);

// POST
router.post('/', auth, controller.create);

module.exports = router;