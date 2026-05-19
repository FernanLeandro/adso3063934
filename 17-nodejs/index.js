const express = require('express');
const bcrypt  = require('bcryptjs');
const jwt     = require('jsonwebtoken');
const cors    = require('cors');
const db      = require('./database');
const auth    = require('./authMiddleware');
 
const app = express();
app.use(express.json());
app.use(cors());
 
const SECRET_KEY = 'your_secret';
const ALLOWED_WEAKNESSES = ['Fire', 'Electricity', 'Putrefaction'];
 
function normalizeWeaknesses(item) {
    if (!item || !item.weaknesses_json) {
        item.weaknesses = [];
        delete item.weaknesses_json;
        return item;
    }

    let parsed;
    try {
        parsed = JSON.parse(item.weaknesses_json);
    } catch (e) {
        parsed = [];
    }

    if (Array.isArray(parsed)) {
        item.weaknesses = parsed.map(w => {
            if (w && typeof w === 'object' && w.weakness_type) {
                return w.weakness_type;
            }
            return typeof w === 'string' ? w : null;
        }).filter(w => ALLOWED_WEAKNESSES.includes(w));
    } else {
        item.weaknesses = [];
    }

    delete item.weaknesses_json;
    return item;
}
 
// AUTH ENDPOINTS:
// ¨POST: /register
app.post('/register', async (req, res) => {
    const {username, password} = req.body;
    const hashedPassword = await bcrypt.hash(password, 10);
 
    db.run(`INSERT INTO users (username, password)
            VALUES(?, ?)`, [username, hashedPassword], (err) => {
                if(err) return res.status(400).json({error: 'User already exists!'});
                res.json({message: 'User Registered!'});
            }    
    );
});
 
// POST: /login
app.post('/login', async (req, res) => {
    const { username, password } = req.body;

    db.get(`SELECT * FROM users WHERE username = ?`, [username], async (err, user) => {
        if (err) return res.status(500).json({ error: 'Server error' });
        if (!user) return res.status(400).json({ error: 'Invalid credentials' });

        const isValid = await bcrypt.compare(password, user.password);
        if (!isValid) return res.status(400).json({ error: 'Invalid credentials' });

        const token = jwt.sign({ id: user.id, username: user.username }, SECRET_KEY, { expiresIn: '1h' });
        res.json({ message: 'Successfully logged in', token });
    });
});

// GET: /characters
app.get('/characters', auth, (req, res) => {
    db.all(`SELECT * FROM characters`, [], (err, rows) => {
        if (err) return res.status(500).json({ error: 'Server error' });
        const normalized = rows.map(normalizeWeaknesses);
        res.json(normalized);
    });
});

// GET: /characters/:id
app.get('/characters/:id', auth, (req, res) => {
    const { id } = req.params;
    db.get(`SELECT * FROM characters WHERE id = ?`, [id], (err, character) => {
        if (err) return res.status(500).json({ error: 'Server error' });
        if (!character) return res.status(404).json({ error: 'Character not found' });
        normalizeWeaknesses(character);
        res.json(character);
    });
});

// POST: /characters
app.post('/characters', auth, (req, res) => {
    const { name, category, description, location, weakness, weaknesses, image_url } = req.body;
    const weaknessValue = ALLOWED_WEAKNESSES.includes(weakness) ? weakness : null;
    const cleanWeaknesses = Array.isArray(weaknesses) ? weaknesses.filter(w => ALLOWED_WEAKNESSES.includes(w)) : [];
    const weaknessesJson = cleanWeaknesses.length ? JSON.stringify(cleanWeaknesses) : null;

    db.run(
        `INSERT INTO characters (name, category, description, location, weakness, weaknesses_json, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)`,
        [name, category, description, location, weaknessValue, weaknessesJson, image_url],
        function (err) {
            if (err) return res.status(400).json({ error: 'Could not add character' });
            res.json({ message: 'Character added', id: this.lastID });
        }
    );
});

// PUT: /characters/:id
app.put('/characters/:id', auth, (req, res) => {
    const { id } = req.params;
    const { name, category, description, location, weakness, weaknesses, image_url } = req.body;
    const weaknessValue = ALLOWED_WEAKNESSES.includes(weakness) ? weakness : null;
    const cleanWeaknesses = Array.isArray(weaknesses) ? weaknesses.filter(w => ALLOWED_WEAKNESSES.includes(w)) : [];
    const weaknessesJson = cleanWeaknesses.length ? JSON.stringify(cleanWeaknesses) : null;

    db.run(
        `UPDATE characters SET name = ?, category = ?, description = ?, location = ?, weakness = ?, weaknesses_json = ?, image_url = ? WHERE id = ?`,
        [name, category, description, location, weaknessValue, weaknessesJson, image_url, id],
        function (err) {
            if (err) return res.status(500).json({ error: 'Server error' });
            if (this.changes === 0) return res.status(404).json({ error: 'Character not found' });
            res.json({ message: 'Character updated' });
        }
    );
});

// DELETE: /characters/:id
app.delete('/characters/:id', auth, (req, res) => {
    const { id } = req.params;

    db.run(`DELETE FROM characters WHERE id = ?`, [id], function (err) {
        if (err) return res.status(500).json({ error: 'Server error' });
        if (this.changes === 0) return res.status(404).json({ error: 'Character not found' });
        res.json({ message: 'Character deleted' });
    });
});

// WEAPON TYPES

// GET: /weapon-types
app.get('/weapon-types', auth, (req, res) => {
    db.all(`SELECT * FROM weapon_types`, [], (err, rows) => {
        if (err) return res.status(500).json({ error: 'Server error' });
        res.json(rows);
    });
});

// GET: /weapon-types/:id
app.get('/weapon-types/:id', auth, (req, res) => {
    const { id } = req.params;
    db.get(`SELECT * FROM weapon_types WHERE id = ?`, [id], (err, type) => {
        if (err) return res.status(500).json({ error: 'Server error' });
        if (!type) return res.status(404).json({ error: 'Weapon type not found' });
        res.json(type);
    });
});

// POST: /weapon-types
app.post('/weapon-types', auth, (req, res) => {
    const { name, description } = req.body;
    db.run(
        `INSERT INTO weapon_types (name, description) VALUES (?, ?)`,
        [name, description],
        function (err) {
            if (err) return res.status(400).json({ error: 'Could not add weapon type' });
            res.json({ message: 'Weapon type added', id: this.lastID });
        }
    );
});

// PUT: /weapon-types/:id
app.put('/weapon-types/:id', auth, (req, res) => {
    const { id } = req.params;
    const { name, description } = req.body;

    db.run(
        `UPDATE weapon_types SET name = ?, description = ? WHERE id = ?`,
        [name, description, id],
        function (err) {
            if (err) return res.status(500).json({ error: 'Server error' });
            if (this.changes === 0) return res.status(404).json({ error: 'Weapon type not found' });
            res.json({ message: 'Weapon type updated' });
        }
    );
});

// DELETE: /weapon-types/:id
app.delete('/weapon-types/:id', auth, (req, res) => {
    const { id } = req.params;
    db.run(`DELETE FROM weapon_types WHERE id = ?`, [id], function (err) {
        if (err) return res.status(500).json({ error: 'Server error' });
        if (this.changes === 0) return res.status(404).json({ error: 'Weapon type not found' });
        res.json({ message: 'Weapon type deleted' });
    });
});

// WEAPONS

// GET: /weapons
app.get('/weapons', auth, (req, res) => {
    db.all(`SELECT w.*, wt.name as weapon_type_name FROM weapons w LEFT JOIN weapon_types wt ON w.weapon_type_id = wt.id`, [], (err, rows) => {
        if (err) return res.status(500).json({ error: 'Server error' });
        res.json(rows);
    });
});

// GET: /weapons/:id
app.get('/weapons/:id', auth, (req, res) => {
    const { id } = req.params;
    db.get(`SELECT w.*, wt.name as weapon_type_name FROM weapons w LEFT JOIN weapon_types wt ON w.weapon_type_id = wt.id WHERE w.id = ?`, [id], (err, weapon) => {
        if (err) return res.status(500).json({ error: 'Server error' });
        if (!weapon) return res.status(404).json({ error: 'Weapon not found' });
        res.json(weapon);
    });
});

// POST: /weapons
app.post('/weapons', auth, (req, res) => {
    const { name, weapon_type_id, rarity, damage, description, location, image_url } = req.body;
    db.run(
        `INSERT INTO weapons (name, weapon_type_id, rarity, damage, description, location, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)`,
        [name, weapon_type_id, rarity, damage, description, location, image_url],
        function (err) {
            if (err) return res.status(400).json({ error: 'Could not add weapon' });
            res.json({ message: 'Weapon added', id: this.lastID });
        }
    );
});

// PUT: /weapons/:id
app.put('/weapons/:id', auth, (req, res) => {
    const { id } = req.params;
    const { name, weapon_type_id, rarity, damage, description, location, image_url } = req.body;

    db.run(
        `UPDATE weapons SET name = ?, weapon_type_id = ?, rarity = ?, damage = ?, description = ?, location = ?, image_url = ? WHERE id = ?`,
        [name, weapon_type_id, rarity, damage, description, location, image_url, id],
        function (err) {
            if (err) return res.status(500).json({ error: 'Server error' });
            if (this.changes === 0) return res.status(404).json({ error: 'Weapon not found' });
            res.json({ message: 'Weapon updated' });
        }
    );
});

// DELETE: /weapons/:id
app.delete('/weapons/:id', auth, (req, res) => {
    const { id } = req.params;
    db.run(`DELETE FROM weapons WHERE id = ?`, [id], function (err) {
        if (err) return res.status(500).json({ error: 'Server error' });
        if (this.changes === 0) return res.status(404).json({ error: 'Weapon not found' });
        res.json({ message: 'Weapon deleted' });
    });
});

// WEAPON COMBINATIONS

// GET: /weapon-combinations
app.get('/weapon-combinations', auth, (req, res) => {
    db.all(`SELECT wc.id, wc.name, wc.description, wc.image_url, 
                   wb.name as blade_name, wb.damage as blade_damage,
                   wh.name as handle_name, wh.damage as handle_damage
            FROM weapon_combinations wc 
            LEFT JOIN weapons wb ON wc.blade_weapon_id = wb.id 
            LEFT JOIN weapons wh ON wc.handle_weapon_id = wh.id`, [], (err, rows) => {
        if (err) return res.status(500).json({ error: 'Server error' });
        res.json(rows);
    });
});

// GET: /weapon-combinations/:id
app.get('/weapon-combinations/:id', auth, (req, res) => {
    const { id } = req.params;
    db.get(`SELECT wc.id, wc.name, wc.description, wc.image_url, 
                   wb.name as blade_name, wb.damage as blade_damage,
                   wh.name as handle_name, wh.damage as handle_damage
            FROM weapon_combinations wc 
            LEFT JOIN weapons wb ON wc.blade_weapon_id = wb.id 
            LEFT JOIN weapons wh ON wc.handle_weapon_id = wh.id
            WHERE wc.id = ?`, [id], (err, combination) => {
        if (err) return res.status(500).json({ error: 'Server error' });
        if (!combination) return res.status(404).json({ error: 'Weapon combination not found' });
        res.json(combination);
    });
});

// POST: /weapon-combinations
app.post('/weapon-combinations', auth, (req, res) => {
    const { name, blade_weapon_id, handle_weapon_id, description, image_url } = req.body;
    db.run(
        `INSERT INTO weapon_combinations (name, blade_weapon_id, handle_weapon_id, description, image_url) VALUES (?, ?, ?, ?, ?)`,
        [name, blade_weapon_id, handle_weapon_id, description, image_url],
        function (err) {
            if (err) return res.status(400).json({ error: 'Could not add weapon combination' });
            res.json({ message: 'Weapon combination added', id: this.lastID });
        }
    );
});

// PUT: /weapon-combinations/:id
app.put('/weapon-combinations/:id', auth, (req, res) => {
    const { id } = req.params;
    const { name, blade_weapon_id, handle_weapon_id, description, image_url } = req.body;

    db.run(
        `UPDATE weapon_combinations SET name = ?, blade_weapon_id = ?, handle_weapon_id = ?, description = ?, image_url = ? WHERE id = ?`,
        [name, blade_weapon_id, handle_weapon_id, description, image_url, id],
        function (err) {
            if (err) return res.status(500).json({ error: 'Server error' });
            if (this.changes === 0) return res.status(404).json({ error: 'Weapon combination not found' });
            res.json({ message: 'Weapon combination updated' });
        }
    );
});

// DELETE: /weapon-combinations/:id
app.delete('/weapon-combinations/:id', auth, (req, res) => {
    const { id } = req.params;
    db.run(`DELETE FROM weapon_combinations WHERE id = ?`, [id], function (err) {
        if (err) return res.status(500).json({ error: 'Server error' });
        if (this.changes === 0) return res.status(404).json({ error: 'Weapon combination not found' });
        res.json({ message: 'Weapon combination deleted' });
    });
});
 
app.listen(3000, () => console.log('Server running on http://localhost:3000'))