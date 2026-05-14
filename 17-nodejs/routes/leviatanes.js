const express = require('express');
const router = express.Router();
const auth = require('../midllewares/authMiddleware');
const controller = require('../controllers/leviatanesController');

router.get('/', auth, controller.getAll);
router.get('/:id', auth, controller.getById);
router.post('/', auth, controller.create);

module.exports = router;