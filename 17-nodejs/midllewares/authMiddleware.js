const jwt = require('jsonwebtoken');
const db  = require('../config/database');
const SECRET_KEY = 'your_secret';
 
module.exports = (req, res, next) => {
    const authHeader = req.header('Authorization');
 
    if(!authHeader) return res.status(401).json({error: 'Access Denied!'});

    const token = authHeader.replace('Bearer ', '');
 
    try {
        const verified = jwt.verify(token, SECRET_KEY);

        db.get(`SELECT id FROM blacklisted_tokens WHERE token = ?`, [token], (err, row) => {
            if(err) return res.status(500).json({error: 'Database error!'});
            if(row) return res.status(401).json({error: 'Session closed. Login again!'});

            req.user = verified;
            req.token = token;
            next();
        });
    } catch (err) {
        res.status(400).json({error: 'Invalid Token!'});
    }
 
};