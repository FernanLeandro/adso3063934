const sqlite3 = require('sqlite3').verbose();
const db      = new sqlite3.Database('./liesofpdb.sqlite');
 
db.serialize(() => {
    // Users Table
    db.run(`CREATE TABLE IF NOT EXISTS users(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE,
        password TEXT    
    )`);
    
    // Weapon Types Table
    db.run(`CREATE TABLE IF NOT EXISTS weapon_types(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT UNIQUE,
        description TEXT
    )`);
    
    // Weapons Table
    db.run(`CREATE TABLE IF NOT EXISTS weapons(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT UNIQUE,
        weapon_type_id INTEGER,
        rarity TEXT,
        damage INTEGER,
        description TEXT,
        location TEXT,
        image_url TEXT,
        FOREIGN KEY (weapon_type_id) REFERENCES weapon_types(id)
    )`);
    
    // Weapon Combinations Table
    db.run(`CREATE TABLE IF NOT EXISTS weapon_combinations(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        blade_weapon_id INTEGER,
        handle_weapon_id INTEGER,
        description TEXT,
        image_url TEXT,
        FOREIGN KEY (blade_weapon_id) REFERENCES weapons(id),
        FOREIGN KEY (handle_weapon_id) REFERENCES weapons(id)
    )`);
    
    // Characters Table
    db.run(`CREATE TABLE IF NOT EXISTS characters(
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT UNIQUE,
        category TEXT,
        description TEXT,
        location TEXT,
        weakness TEXT,
        weaknesses_json TEXT,
        image_url TEXT
    )`);
});
 
module.exports = db;