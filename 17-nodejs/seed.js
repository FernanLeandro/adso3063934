const db = require('./database');
const bcrypt = require('bcryptjs');

// Esperar a que la BD se inicialice
setTimeout(() => {
    // Locations information (solo para referencia, no se guardan como tabla separada)
    const locationsInfo = {
        'Krat': 'The main city where Pinocchio awakens',
        'Malum District': 'A corrupted and dark area filled with danger and despair',
        'Workshop Union': 'A factory filled with machinery and workers producing puppets',
        'Sunset Tower': 'A tall tower with sunset views and tragic memories',
        'Grand Central Station': 'A transportation hub with secrets and power struggles',
        'Lorenzini Auction House': 'An elegant mansion where auctions take place',
        'Crimson Gutter': 'A dark red industrial area with toxic elements',
        'Dormitory': 'A residential building with disturbing secrets',
        'Slums Area': 'A poor and dangerous slum district',
        'Pine Longitudes': 'A vast forest-like area with unique creatures',
        'Forsaken Strands': 'A mysterious beach with dark secrets',
        'Monad Headquarters': 'The main headquarters of the mysterious organization'
    };

    // WEAPON TYPES
    const weaponTypes = [
        { name: 'Dexterity', description: 'Fast and agile weapons for quick attacks and mobility' },
        { name: 'Strength', description: 'Heavy weapons for powerful strikes and damage' },
        { name: 'Balance', description: 'Well-rounded weapons combining speed and power' },
        { name: 'Special', description: 'Unique and rare weapons with special effects' },
        { name: 'Throwable', description: 'Ranged weapons to throw at enemies' },
        { name: 'Gun', description: 'Firearms with projectile attacks' }
    ];

    weaponTypes.forEach(type => {
        db.run(`INSERT OR IGNORE INTO weapon_types (name, description) VALUES (?, ?)`,
            [type.name, type.description], (err) => {
                if (err) console.log('Error inserting weapon type:', err);
            }
        );
    });

    // WEAPONS - Completas del juego
    setTimeout(() => {
        const weapons = [
            // Dexterity Weapons
            { name: 'Nameless Blade', type_id: 1, rarity: 'Common', damage: 48, description: 'A simple but reliable blade', location: 'Krat', image_url: 'https://via.placeholder.com/200?text=NamelessBlade' },
            { name: 'Puppet Knife', type_id: 1, rarity: 'Uncommon', damage: 55, description: 'A knife crafted from puppet material', location: 'Malum District', image_url: 'https://via.placeholder.com/200?text=PuppetKnife' },
            { name: 'Officer Dagger', type_id: 1, rarity: 'Uncommon', damage: 58, description: 'A refined dagger used by officers', location: 'Grand Central Station', image_url: 'https://via.placeholder.com/200?text=OfficerDagger' },
            { name: 'Felled Monster Claw', type_id: 1, rarity: 'Rare', damage: 72, description: 'Claw from a defeated creature', location: 'Pine Longitudes', image_url: 'https://via.placeholder.com/200?text=MonsterClaw' },
            { name: 'Puppet Fang', type_id: 1, rarity: 'Rare', damage: 70, description: 'Sharp fang from an ancient puppet', location: 'Sunset Tower', image_url: 'https://via.placeholder.com/200?text=PuppetFang' },
            
            // Strength Weapons
            { name: 'Greatsword', type_id: 2, rarity: 'Common', damage: 85, description: 'A powerful two-handed sword', location: 'Krat', image_url: 'https://via.placeholder.com/200?text=Greatsword' },
            { name: 'Heavy Wrench', type_id: 2, rarity: 'Uncommon', damage: 78, description: 'A heavy tool that can be used as a weapon', location: 'Workshop Union', image_url: 'https://via.placeholder.com/200?text=HeavyWrench' },
            { name: 'War Hammer', type_id: 2, rarity: 'Uncommon', damage: 82, description: 'A traditional war hammer', location: 'Crimson Gutter', image_url: 'https://via.placeholder.com/200?text=WarHammer' },
            { name: 'Executioner Axe', type_id: 2, rarity: 'Rare', damage: 95, description: 'A large executioner axe', location: 'Dormitory', image_url: 'https://via.placeholder.com/200?text=ExecutionerAxe' },
            { name: 'King Bee Stinger', type_id: 2, rarity: 'Rare', damage: 92, description: 'Massive stinger from the King Bee', location: 'Pine Longitudes', image_url: 'https://via.placeholder.com/200?text=KingBeeStinger' },
            
            // Balance Weapons
            { name: 'Balanced Sword', type_id: 3, rarity: 'Common', damage: 65, description: 'Perfect balance of speed and power', location: 'Krat', image_url: 'https://via.placeholder.com/200?text=BalancedSword' },
            { name: 'Sailor Blade', type_id: 3, rarity: 'Uncommon', damage: 68, description: 'A blade used by sailors', location: 'Forsaken Strands', image_url: 'https://via.placeholder.com/200?text=SailorBlade' },
            { name: 'Falling Axe', type_id: 3, rarity: 'Uncommon', damage: 70, description: 'An axe for balanced strikes', location: 'Slums Area', image_url: 'https://via.placeholder.com/200?text=FallingAxe' },
            { name: 'Carnival Sword', type_id: 3, rarity: 'Rare', damage: 80, description: 'A festive sword from the carnival', location: 'Lorenzini Auction House', image_url: 'https://via.placeholder.com/200?text=CarnivalSword' },
            { name: 'Thorned Sword', type_id: 3, rarity: 'Rare', damage: 78, description: 'A sword covered in thorns', location: 'Pine Longitudes', image_url: 'https://via.placeholder.com/200?text=ThornedSword' },
            
            // Special Weapons
            { name: 'Arm Blade', type_id: 4, rarity: 'Rare', damage: 75, description: 'A special blade that extends from the arm', location: 'Grand Central Station', image_url: 'https://via.placeholder.com/200?text=ArmBlade' },
            { name: 'Chain Weapon', type_id: 4, rarity: 'Rare', damage: 72, description: 'A weapon with chains for extended reach', location: 'Crimson Gutter', image_url: 'https://via.placeholder.com/200?text=ChainWeapon' },
            { name: 'Electric Apparatus', type_id: 4, rarity: 'Epic', damage: 88, description: 'A weapon infused with electricity', location: 'Workshop Union', image_url: 'https://via.placeholder.com/200?text=ElectricApparatus' },
            { name: 'Sacred Flame Blade', type_id: 4, rarity: 'Epic', damage: 90, description: 'A blade blessed with sacred fire', location: 'Sunset Tower', image_url: 'https://via.placeholder.com/200?text=SacredFlame' },
            { name: 'Insult Blade', type_id: 4, rarity: 'Rare', damage: 74, description: 'A blade that ignites lies', location: 'Monad Headquarters', image_url: 'https://via.placeholder.com/200?text=InsultBlade' },
            
            // Throwable Weapons
            { name: 'Fire Cracker', type_id: 5, rarity: 'Common', damage: 35, description: 'An explosive throwing weapon', location: 'Krat', image_url: 'https://via.placeholder.com/200?text=FireCracker' },
            { name: 'Shrapnel Grenade', type_id: 5, rarity: 'Uncommon', damage: 45, description: 'A grenade that explodes into shrapnel', location: 'Workshop Union', image_url: 'https://via.placeholder.com/200?text=Shrapnel' },
            { name: 'Poison Vial', type_id: 5, rarity: 'Uncommon', damage: 42, description: 'A vial of poisonous liquid', location: 'Malum District', image_url: 'https://via.placeholder.com/200?text=PoisonVial' },
            { name: 'Holy Water', type_id: 5, rarity: 'Rare', damage: 55, description: 'Water blessed with holy power', location: 'Sunset Tower', image_url: 'https://via.placeholder.com/200?text=HolyWater' },
            { name: 'Stun Bomb', type_id: 5, rarity: 'Rare', damage: 50, description: 'A bomb that stuns enemies', location: 'Grand Central Station', image_url: 'https://via.placeholder.com/200?text=StunBomb' },
            
            // Guns
            { name: 'Pistol', type_id: 6, rarity: 'Uncommon', damage: 62, description: 'A standard firearm', location: 'Crimson Gutter', image_url: 'https://via.placeholder.com/200?text=Pistol' },
            { name: 'Revolver', type_id: 6, rarity: 'Uncommon', damage: 68, description: 'A powerful revolver', location: 'Slums Area', image_url: 'https://via.placeholder.com/200?text=Revolver' },
            { name: 'Rifle', type_id: 6, rarity: 'Rare', damage: 85, description: 'A precise long-range rifle', location: 'Grand Central Station', image_url: 'https://via.placeholder.com/200?text=Rifle' },
            { name: 'Automatic Gun', type_id: 6, rarity: 'Rare', damage: 78, description: 'An automatic weapon for sustained fire', location: 'Monad Headquarters', image_url: 'https://via.placeholder.com/200?text=AutomaticGun' },
            { name: 'Puppet Pistol', type_id: 6, rarity: 'Epic', damage: 92, description: 'A gun made from puppet parts', location: 'Workshop Union', image_url: 'https://via.placeholder.com/200?text=PuppetPistol' }
        ];

        weapons.forEach(weapon => {
            db.run(`INSERT OR IGNORE INTO weapons (name, weapon_type_id, rarity, damage, description, location, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)`,
                [weapon.name, weapon.type_id, weapon.rarity, weapon.damage, weapon.description, weapon.location, weapon.image_url], (err) => {
                    if (err) console.log('Error inserting weapon:', err);
                }
            );
        });
    }, 500);

    // CHARACTERS - Completos del juego
    setTimeout(() => {
        const characters = [
            // Main Characters
            { 
                name: 'Pinocchio', 
                category: 'Main Character', 
                description: 'A puppet brought to life, the protagonist on a quest to become human and learn the meaning of humanity', 
                location: 'Krat', 
                weakness: null,
                weaknesses_json: null,
                image_url: 'https://via.placeholder.com/200?text=Pinocchio' 
            },
            { 
                name: 'Geppetto', 
                category: 'Main Character', 
                description: 'The creator of Pinocchio, holds immense power and dark secrets', 
                location: 'Krat', 
                weakness: null,
                weaknesses_json: null,
                image_url: 'https://via.placeholder.com/200?text=Geppetto' 
            },
            { 
                name: 'Sophia', 
                category: 'Main Character', 
                description: 'A mysterious girl with special abilities, guides Pinocchio through his journey', 
                location: 'Grand Central Station', 
                weakness: null,
                weaknesses_json: null,
                image_url: 'https://via.placeholder.com/200?text=Sophia' 
            },
            
            // Secondary Characters
            { 
                name: 'The Fox', 
                category: 'Secondary Character', 
                description: 'A cunning fox who offers help but has hidden motives', 
                location: 'Krat', 
                weakness: null,
                weaknesses_json: null,
                image_url: 'https://via.placeholder.com/200?text=TheFox' 
            },
            { 
                name: 'The Cat', 
                category: 'Secondary Character', 
                description: 'A mysterious cat companion of the Fox', 
                location: 'Krat', 
                weakness: null,
                weaknesses_json: null,
                image_url: 'https://via.placeholder.com/200?text=TheCat' 
            },
            { 
                name: 'Arlecchino', 
                category: 'Secondary Character', 
                description: 'A puppet jester with a tragic past', 
                location: 'Crimson Gutter', 
                weakness: null,
                weaknesses_json: null,
                image_url: 'https://via.placeholder.com/200?text=Arlecchino' 
            },
            { 
                name: 'Eugenie', 
                category: 'Secondary Character', 
                description: 'A woman with connections to the puppet world', 
                location: 'Lorenzini Auction House', 
                weakness: null,
                weaknesses_json: null,
                image_url: 'https://via.placeholder.com/200?text=Eugenie' 
            },
            { 
                name: 'Bamboo Bro', 
                category: 'Secondary Character', 
                description: 'A friendly character who helps Pinocchio', 
                location: 'Slums Area', 
                weakness: null,
                weaknesses_json: null,
                image_url: 'https://via.placeholder.com/200?text=BambooBro' 
            },
            
            // Bosses
            { 
                name: 'Mad Donkey', 
                category: 'Boss', 
                description: 'A huge malformed beast that prowls the Malum District with brutal charges and corrosive attacks.', 
                location: 'Malum District', 
                weakness: 'Electricity',
                weaknesses_json: JSON.stringify(['Electricity']),
                image_url: 'https://via.placeholder.com/200?text=MadDonkey' 
            },
            { 
                name: 'Parade Master', 
                category: 'Boss', 
                description: 'A twisted performer who attacks with speed, crowd control and deadly acrobatics.', 
                location: 'Lorenzini Auction House', 
                weakness: 'Putrefaction',
                weaknesses_json: JSON.stringify(['Putrefaction']),
                image_url: 'https://via.placeholder.com/200?text=ParadeMaster' 
            },
            { 
                name: 'King Bee', 
                category: 'Boss', 
                description: 'A massive insect queen defending the Pine Longitudes with stingers and swarms.', 
                location: 'Pine Longitudes', 
                weakness: 'Fire',
                weaknesses_json: JSON.stringify(['Fire']),
                image_url: 'https://via.placeholder.com/200?text=KingBee' 
            },
            { 
                name: 'Broken Puppet', 
                category: 'Boss', 
                description: 'A ragged puppet that moves unpredictably with lethal strikes and puppet arms.', 
                location: 'Dormitory', 
                weakness: 'Fire',
                weaknesses_json: JSON.stringify(['Fire']),
                image_url: 'https://via.placeholder.com/200?text=BrokenPuppet' 
            },
            { 
                name: 'Watchdog', 
                category: 'Boss', 
                description: 'A massive mechanized guardian that uses electric pulses and crushing melee attacks.', 
                location: 'Workshop Union', 
                weakness: 'Electricity',
                weaknesses_json: JSON.stringify(['Electricity']),
                image_url: 'https://via.placeholder.com/200?text=Watchdog' 
            },
            { 
                name: 'Arlecchino (Boss)', 
                category: 'Boss', 
                description: 'The clownish assassin whose attacks are fast, tricky and lethal.', 
                location: 'Crimson Gutter', 
                weakness: 'Putrefaction',
                weaknesses_json: JSON.stringify(['Putrefaction']),
                image_url: 'https://via.placeholder.com/200?text=ArlechinoBoss' 
            },
            { 
                name: 'Tyrant King', 
                category: 'Boss', 
                description: 'The final ruler whose overwhelming strength and iron defenses challenge every adventurer.', 
                location: 'Forsaken Strands', 
                weakness: 'Fire',
                weaknesses_json: JSON.stringify(['Fire']),
                image_url: 'https://via.placeholder.com/200?text=TyrantKing' 
            },
            { 
                name: 'The Stargazer', 
                category: 'Boss', 
                description: 'A star-themed foe that attacks with long-range magic and unpredictable movement.', 
                location: 'Monad Headquarters', 
                weakness: 'Electricity',
                weaknesses_json: JSON.stringify(['Electricity']),
                image_url: 'https://via.placeholder.com/200?text=Stargazer' 
            },
            { 
                name: 'Legion', 
                category: 'Boss', 
                description: 'A huge group of puppets fused into one entity that attacks in waves.', 
                location: 'Slums Area', 
                weakness: 'Putrefaction',
                weaknesses_json: JSON.stringify(['Putrefaction']),
                image_url: 'https://via.placeholder.com/200?text=Legion' 
            },
            { 
                name: 'The Nameless Apostle', 
                category: 'Boss', 
                description: 'A devout guardian that strikes with dark energy and relentless faith-based attacks.', 
                location: 'Monad Headquarters', 
                weakness: 'Electricity',
                weaknesses_json: JSON.stringify(['Electricity']),
                image_url: 'https://via.placeholder.com/200?text=Apostle' 
            }
        ];

        characters.forEach(char => {
            db.run(`INSERT OR IGNORE INTO characters (name, category, description, location, weakness, weaknesses_json, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)`,
                [char.name, char.category, char.description, char.location, char.weakness, char.weaknesses_json, char.image_url], (err) => {
                    if (err) console.log('Error inserting character:', err);
                }
            );
        });
    }, 1000);

    // WEAPON COMBINATIONS - Completas
    setTimeout(() => {
        const combinations = [
            { name: 'Greatsword + Greatsword', blade_id: 6, handle_id: 6, description: 'Dual greatswords for devastating damage', image_url: 'https://via.placeholder.com/200?text=DualGreatsword' },
            { name: 'Nameless Blade + Nameless Blade', blade_id: 1, handle_id: 1, description: 'Twin blades for balanced attacks', image_url: 'https://via.placeholder.com/200?text=DualNameless' },
            { name: 'Dagger + Dagger', blade_id: 2, handle_id: 2, description: 'Dual daggers for rapid strikes', image_url: 'https://via.placeholder.com/200?text=DualDagger' },
            { name: 'Greatsword + Dagger', blade_id: 6, handle_id: 2, description: 'A powerful combination of strength and speed', image_url: 'https://via.placeholder.com/200?text=GreatswordDagger' },
            { name: 'Balanced Sword + Balanced Sword', blade_id: 11, handle_id: 11, description: 'Perfect symmetry and control', image_url: 'https://via.placeholder.com/200?text=BalancedBalance' },
            { name: 'War Hammer + Heavy Wrench', blade_id: 8, handle_id: 7, description: 'Heavy industrial power', image_url: 'https://via.placeholder.com/200?text=HammerWrench' },
            { name: 'Puppet Fang + Arm Blade', blade_id: 5, handle_id: 15, description: 'Ancient power combined with special technology', image_url: 'https://via.placeholder.com/200?text=PuppetArm' },
            { name: 'Electric Apparatus + Sacred Flame Blade', blade_id: 17, handle_id: 18, description: 'Elements of power combined', image_url: 'https://via.placeholder.com/200?text=ElectricFlame' },
            { name: 'Officer Dagger + Felled Monster Claw', blade_id: 3, handle_id: 4, description: 'Refined precision meets raw power', image_url: 'https://via.placeholder.com/200?text=OfficerClaw' },
            { name: 'Chain Weapon + Insult Blade', blade_id: 16, handle_id: 19, description: 'Reach combined with blade expertise', image_url: 'https://via.placeholder.com/200?text=ChainInsult' },
            { name: 'Executioner Axe + Greatsword', blade_id: 9, handle_id: 6, description: 'Ultimate strength attack', image_url: 'https://via.placeholder.com/200?text=ExecutionerGreat' },
            { name: 'King Bee Stinger + Executioner Axe', blade_id: 10, handle_id: 9, description: 'Nature\'s weapon combined with warfare', image_url: 'https://via.placeholder.com/200?text=BeeExecutioner' },
            { name: 'Puppet Knife + Officer Dagger', blade_id: 2, handle_id: 3, description: 'Quick and precise attacks', image_url: 'https://via.placeholder.com/200?text=KnifeDagger' },
            { name: 'Thorned Sword + Carnival Sword', blade_id: 14, handle_id: 13, description: 'Beauty and danger combined', image_url: 'https://via.placeholder.com/200?text=ThornedCarnival' },
            { name: 'Sailor Blade + Falling Axe', blade_id: 12, handle_id: 13, description: 'Maritime skill meets balance', image_url: 'https://via.placeholder.com/200?text=SailorFalling' },
            { name: 'Pistol + Revolver', blade_id: 26, handle_id: 27, description: 'Dual firearms for devastating ranged attacks', image_url: 'https://via.placeholder.com/200?text=DualGun' },
            { name: 'Rifle + Automatic Gun', blade_id: 28, handle_id: 29, description: 'Precision and sustained firepower', image_url: 'https://via.placeholder.com/200?text=RifleAutomatic' },
            { name: 'Puppet Pistol + Electric Apparatus', blade_id: 30, handle_id: 17, description: 'Technology enhanced with puppet craftsmanship', image_url: 'https://via.placeholder.com/200?text=PuppetElectric' },
            { name: 'Holy Water + Stun Bomb', blade_id: 24, handle_id: 25, description: 'Blessing and disruption combined', image_url: 'https://via.placeholder.com/200?text=HolyStun' },
            { name: 'Fire Cracker + Poison Vial', blade_id: 21, handle_id: 23, description: 'Explosive and toxic combination', image_url: 'https://via.placeholder.com/200?text=FirePoison' }
        ];

        combinations.forEach(combo => {
            db.run(`INSERT OR IGNORE INTO weapon_combinations (name, blade_weapon_id, handle_weapon_id, description, image_url) VALUES (?, ?, ?, ?, ?)`,
                [combo.name, combo.blade_id, combo.handle_id, combo.description, combo.image_url], (err) => {
                    if (err) console.log('Error inserting weapon combination:', err);
                }
            );
        });
    }, 1500);

    // TEST USER (eliminado - crear manualmente)
    console.log('✅ Database seeded successfully with complete Lies of P data!');
    console.log('\n📊 Data Summary:');
    console.log('- 6 Weapon Types');
    console.log('- 30 Weapons');
    console.log('- 18 Characters (3 Main, 5 Secondary, 10 Bosses)');
    console.log('- 20 Weapon Combinations');
    console.log('\n🔐 Create user manually via POST /register');

}, 1000);

