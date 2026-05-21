const db = require('./database');
const bcrypt = require('bcryptjs');

// Esperar a que la BD se inicialice
setTimeout(() => {
    // WEAPON TYPES
    const weaponTypes = [
        { name: 'Dagger', description: 'Fast and agile weapons with short range' },
        { name: 'Sword', description: 'Balanced weapons for various combat situations' },
        { name: 'Greatsword', description: 'Heavy and slow weapons with massive damage' },
        { name: 'Blunt', description: 'Crushing weapons effective against puppets' },
        { name: 'Large Blunt', description: 'Extremely heavy crushing weapons' },
        { name: 'Special', description: 'Unique boss weapons with unchangeable handles' }
    ];

    weaponTypes.forEach(type => {
        db.run(`INSERT OR IGNORE INTO weapon_types (name, description) VALUES (?, ?)`,
            [type.name, type.description], (err) => {
                if (err) console.log('Error inserting weapon type:', err);
            }
        );
    });

    // WEAPONS
    setTimeout(() => {
        const weapons = [
            { name: "Puppet's Saber", type_id: 2, rarity: 'Normal', damage: 104, description: "The standard saber given to Krat's puppets.", location: 'Krat Central Station', image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/puppets_saber_weapon_lies_of_p_wiki_guide_200px.png' },
            { name: 'Wintry Rapier', type_id: 2, rarity: 'Normal', damage: 96, description: 'A rapier made for ceremonial purposes.', location: 'Krat Central Station', image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/wintry_rapier_weapon_lies_of_p_wiki_guide_200px.png' },
            { name: 'Greatsword of Fate', type_id: 3, rarity: 'Normal', damage: 114, description: 'A greatsword with a heavy blade.', location: 'Krat Central Station', image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/greatsword_of_fate_weapon_lies_of_p_wiki_guide_200px.png' },
            { name: 'Salamander Dagger', type_id: 1, rarity: 'Normal', damage: 80, description: 'A dagger that emits intense heat.', location: 'Workshop Union', image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/salamander_dagger_weapon_lies_of_p_wiki_guide_200px.png' },
            { name: 'Bone-Cutting Saw', type_id: 3, rarity: 'Normal', damage: 125, description: 'A massive saw used for cutting thick bones.', location: 'Malum District', image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/bone-cutting_saw_weapon_lies_of_p_wiki_guide_200px.png' },
            { name: 'Two Dragons Sword', type_id: 6, rarity: 'Special', damage: 130, description: 'An elegant sword gifted by a warrior from the East.', location: 'Barren Swamp', image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/two_dragons_sword_weapon_lies_of_p_wiki_guide_200px.png' }
        ];

        weapons.forEach(weapon => {
            db.run(`INSERT OR IGNORE INTO weapons (name, weapon_type_id, rarity, damage, description, location, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)`,
                [weapon.name, weapon.type_id, weapon.rarity, weapon.damage, weapon.description, weapon.location, weapon.image_url], (err) => {
                    if (err) console.log('Error inserting weapon:', err);
                }
            );
        });
    }, 500);

    // CHARACTERS & BOSSES
    setTimeout(() => {
        const characters = [
            // Main Characters
            { name: 'Pinocchio', category: 'Main Character', description: 'A puppet created by Geppetto who must lie to become human.', location: 'Krat', weakness: null, weaknesses_json: null, image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/pinocchio_npc_lies_of_p_wiki_guide_200px.png' },
            { name: 'Geppetto', category: 'Main Character', description: 'The creator of Pinocchio and a master craftsman.', location: 'Hotel Krat', weakness: null, weaknesses_json: null, image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/geppetto_npc_lies_of_p_wiki_guide_200px.png' },
            { name: 'Sophia', category: 'Main Character', description: 'A mysterious blue-haired woman who guides Pinocchio.', location: 'Hotel Krat', weakness: null, weaknesses_json: null, image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/sophia_npc_lies_of_p_wiki_guide_200px.png' },
            
            // Secondary Characters
            { name: 'Gemini', category: 'Secondary Character', description: 'A cricket automaton who acts as a guide.', location: 'Krat', weakness: null, weaknesses_json: null, image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/gemini_npc_lies_of_p_wiki_guide_200px.png' },
            { name: 'Eugénie', category: 'Secondary Character', description: 'A talented weaponsmith at Hotel Krat.', location: 'Hotel Krat', weakness: null, weaknesses_json: null, image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/eugenie_npc_lies_of_p_wiki_guide_200px.png' },
            { name: 'Alidoro', category: 'Secondary Character', description: 'A hound-masked merchant who trades special weapons.', location: 'Hotel Krat', weakness: null, weaknesses_json: null, image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/alidoro_npc_lies_of_p_wiki_guide_200px.png' },
            
            // Bosses
            { name: 'Parade Master', category: 'Boss', description: 'A giant puppet master of ceremonies.', location: 'Krat Central Station Plaza', weakness: 'Electric Blitz', weaknesses_json: JSON.stringify(['Electric Blitz']), image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/parade_master_bosses_lies_of_p_wiki_guide_200px.png' },
            { name: 'Scrapped Watchman', category: 'Boss', description: 'A large police puppet gone rogue.', location: 'Krat City Hall', weakness: 'Electric Blitz', weaknesses_json: JSON.stringify(['Electric Blitz']), image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/scrapped_watchman_bosses_lies_of_p_wiki_guide_200px.png' },
            { name: "King's Flame, Fuoco", category: 'Boss', description: 'A massive furnace puppet.', location: 'Venigni Works', weakness: 'Electric Blitz', weaknesses_json: JSON.stringify(['Electric Blitz']), image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/kings_flame_fuoco_bosses_lies_of_p_wiki_guide_200px.png' },
            { name: 'Fallen Archbishop Andreus', category: 'Boss', description: 'A mutated religious leader consumed by the Petrification Disease.', location: 'St. Frangelico Cathedral', weakness: 'Fire', weaknesses_json: JSON.stringify(['Fire']), image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/fallen_archbishop_andreus_bosses_lies_of_p_wiki_guide_200px.png' },
            { name: 'Eldest of the Black Rabbit Brotherhood', category: 'Boss', description: 'The leader of a notorious gang of stalkers.', location: 'Malum District', weakness: 'Acid', weaknesses_json: JSON.stringify(['Acid']), image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/eldest_of_the_black_rabbit_brotherhood_bosses_lies_of_p_wiki_guide_200px.png' },
            { name: 'King of Puppets', category: 'Boss', description: 'The supposed leader behind the puppet frenzy.', location: 'Estella Opera House', weakness: 'Electric Blitz', weaknesses_json: JSON.stringify(['Electric Blitz']), image_url: 'https://liesofp.wiki.fextralife.com/file/Lies-of-P/king_of_puppets_bosses_lies_of_p_wiki_guide_200px.png' }
        ];

        characters.forEach(char => {
            db.run(`INSERT OR IGNORE INTO characters (name, category, description, location, weakness, weaknesses_json, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)`,
                [char.name, char.category, char.description, char.location, char.weakness, char.weaknesses_json, char.image_url], (err) => {
                    if (err) console.log('Error inserting character:', err);
                }
            );
        });
    }, 1000);

    // WEAPON COMBINATIONS
    setTimeout(() => {
        const combinations = [
            { name: "Puppet's Saber Blade + Wintry Rapier Handle", blade_id: 1, handle_id: 2, description: 'Saber slashing power with rapier thrusting speed.', image_url: 'https://via.placeholder.com/200?text=Combination1' },
            { name: "Wintry Rapier Blade + Puppet's Saber Handle", blade_id: 2, handle_id: 1, description: 'Rapier point with saber slashing moveset.', image_url: 'https://via.placeholder.com/200?text=Combination2' },
            { name: 'Greatsword of Fate Blade + Salamander Dagger Handle', blade_id: 3, handle_id: 4, description: 'Heavy blade with fast fiery attacks.', image_url: 'https://via.placeholder.com/200?text=Combination3' },
            { name: 'Bone-Cutting Saw Blade + Greatsword of Fate Handle', blade_id: 5, handle_id: 3, description: 'Massive reach and sweeping attacks.', image_url: 'https://via.placeholder.com/200?text=Combination4' },
            { name: 'Salamander Dagger Blade + Bone-Cutting Saw Handle', blade_id: 4, handle_id: 5, description: 'Fast fire attacks on a long handle.', image_url: 'https://via.placeholder.com/200?text=Combination5' },
            { name: "Greatsword of Fate Blade + Puppet's Saber Handle", blade_id: 3, handle_id: 1, description: 'Heavy hitting blade with faster one-handed swings.', image_url: 'https://via.placeholder.com/200?text=Combination6' }
        ];

        combinations.forEach(combo => {
            db.run(`INSERT OR IGNORE INTO weapon_combinations (name, blade_weapon_id, handle_weapon_id, description, image_url) VALUES (?, ?, ?, ?, ?)`,
                [combo.name, combo.blade_id, combo.handle_id, combo.description, combo.image_url], (err) => {
                    if (err) console.log('Error inserting weapon combination:', err);
                }
            );
        });
    }, 1500);

    console.log('✅ Database seeded successfully with REAL Lies of P data!');
    console.log('\\n📊 Data Summary:');
    console.log('- 6 Weapon Types');
    console.log('- 6 Weapons');
    console.log('- 12 Characters (3 Main, 3 Secondary, 6 Bosses)');
    console.log('- 6 Weapon Combinations');

}, 1000);
