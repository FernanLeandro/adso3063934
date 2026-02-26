import BtnBack from "../components/BtnBack";
import { useState } from "react";
import CardPokemon from "../components/CardPokemon";

function Example4StateHooks() {
    const [capturedPokemons, setCapturedPokemons] = useState([]);
    const [currentPokemon, setCurrentPokemon] = useState(null);
    const [isCapturing, setIsCapturing] = useState(false);
    const [alertData, setAlertData] = useState(null);

    const allPokemons = [
        { id: 1, name: "bulbasaur", type: "Grass/Poison", level: 5, power: 10, Abilitie: "Overgrow", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png", legendary: false },
        { id: 2, name: "charmander", type: "Fire", level: 5, power: 10, Abilitie: "Blaze", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png", legendary: false },
        { id: 3, name: "squirtle", type: "Water", level: 5, power: 10, Abilitie: "Torrent", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png", legendary: false },
        { id: 4, name: "pikachu", type: "Electric", level: 25, power: 50, Abilitie: "Static", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png", legendary: false },
        { id: 5, name: "gengar", type: "Ghost/Poison", level: 30, power: 60, Abilitie: "Cursed Body", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/94.png", legendary: false },
        { id: 6, name: "dragonite", type: "Dragon/Flying", level: 55, power: 80, Abilitie: "Multiscale", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/149.png", legendary: false },
        { id: 7, name: "mewtwo", type: "Psychic", level: 70, power: 100, Abilitie: "Pressure", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/150.png", legendary: true },
        { id: 8, name: "articuno", type: "Ice/Flying", level: 50, power: 75, Abilitie: "Pressure", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/144.png", legendary: true },
        { id: 9, name: "zapdos", type: "Electric/Flying", level: 50, power: 75, Abilitie: "Pressure", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/145.png", legendary: true },
        { id: 10, name: "moltres", type: "Fire/Flying", level: 50, power: 75, Abilitie: "Pressure", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/146.png", legendary: true },
        { id: 11, name: "lapras", type: "Water/Ice", level: 40, power: 65, Abilitie: "Water Absorb", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/131.png", legendary: false },
        { id: 12, name: "arcanine", type: "Fire", level: 35, power: 60, Abilitie: "Intimidate", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/59.png", legendary: false },
        { id: 13, name: "machamp", type: "Fighting", level: 35, power: 65, Abilitie: "Guts", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/68.png", legendary: false },
        { id: 14, name: "golem", type: "Rock/Ground", level: 40, power: 70, Abilitie: "Rock Head", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/76.png", legendary: false },
        { id: 15, name: "arbok", type: "Poison", level: 30, power: 55, Abilitie: "Intimidate", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/24.png", legendary: false },
        { id: 16, name: "alakazam", type: "Psychic", level: 45, power: 70, Abilitie: "Magic Guard", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/65.png", legendary: false },
        { id: 17, name: "gyarados", type: "Water/Flying", level: 40, power: 70, Abilitie: "Intimidate", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/130.png", legendary: false },
        { id: 18, name: "exeggutor", type: "Grass/Psychic", level: 38, power: 60, Abilitie: "Chlorophyll", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/103.png", legendary: false },
        { id: 19, name: "kangaskhan", type: "Normal", level: 35, power: 60, Abilitie: "Early Bird", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/115.png", legendary: false },
        { id: 20, name: "nidoking", type: "Poison/Ground", level: 35, power: 65, Abilitie: "Poison Point", image: "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/34.png", legendary: false },
    ];

    // Función para atrapar
    const trapPokemon = () => {
        // Mostrar mensaje de atrapando
        setIsCapturing(true);
        
        // Esperar 2 segundos para el efecto de "atrapando"
        setTimeout(() => {
            // Obtener pokémon aleatorio
            const randomIndex = Math.floor(Math.random() * allPokemons.length);
            const randomPokemon = allPokemons[randomIndex];
            
            // Verificar si ya fue atrapado
            const alreadyCaptured = capturedPokemons.some(p => p.id === randomPokemon.id);
            
            if (alreadyCaptured) {
                setAlertData({
                    message: `¡Ya habías atrapado a ${randomPokemon.name}!`,
                    type: "warning",
                    pokemon: randomPokemon
                });
                setCurrentPokemon(null);
            } else {
                // Agregar a atrapados
                setCapturedPokemons([...capturedPokemons, randomPokemon]);
                setAlertData({
                    message: `¡Atrapaste a ${randomPokemon.name}! 🎉`,
                    type: "success",
                    pokemon: randomPokemon
                });
                setCurrentPokemon(randomPokemon);
                
                // Mostrar el pokémon durante 2 segundos
                setTimeout(() => {
                    setCurrentPokemon(null);
                }, 2000);
            }
            
            // Ocultar alerta después de 3 segundos
            setTimeout(() => {
                setAlertData(null);
            }, 3000);
            
            setIsCapturing(false);
        }, 2000);
    };

    const styles = {
        container: {
            padding: "20px"
        },
        message: {
            color: "#FFD700",
            fontSize: "24px",
            fontWeight: "bold",
            marginBottom: "20px",
            minHeight: "30px",
            textAlign: "center"
        },
        section: {
            marginTop: "30px"
        },
        cardsContainer: {
            display: "flex",
            flexWrap: "wrap",
            gap: "20px",
            justifyContent: "center"
        },
        capturedCounter: {
            fontSize: "18px",
            fontWeight: "bold",
            color: "#FFD700",
            marginTop: "10px",
            marginBottom: "20px",
            textAlign: "center"
        },
        buttonContainer: {
            display: "flex",
            gap: "10px",
            justifyContent: "center",
            marginBottom: "30px"
        },
        button: {
            padding: "12px 30px",
            fontSize: "16px",
            fontWeight: "bold",
            backgroundColor: "#FFD700",
            color: "#000",
            border: "none",
            borderRadius: "5px",
            cursor: "pointer",
            transition: "transform 0.2s"
        },
        alertContainer: {
            position: "fixed",
            top: "20px",
            right: "20px",
            padding: "20px 30px",
            borderRadius: "10px",
            boxShadow: "0 8px 24px rgba(0, 0, 0, 0.4)",
            zIndex: 1000,
            animation: "slideIn 0.3s ease-in-out, slideOut 0.3s ease-in-out 2.7s forwards",
            display: "flex",
            alignItems: "center",
            gap: "15px",
            maxWidth: "400px"
        },
        alertSuccess: {
            backgroundColor: "#4CAF50",
            color: "white",
            border: "2px solid #45a049"
        },
        alertWarning: {
            backgroundColor: "#FF9800",
            color: "white",
            border: "2px solid #e68900"
        },
        alertMessage: {
            fontSize: "16px",
            fontWeight: "bold",
            textAlign: "left"
        },
        alertIcon: {
            fontSize: "28px"
        }
    };

    return (
        <div className="container">
            <BtnBack />
            <h2>Example 4: State Hooks</h2>
            <h3>(useState, useEffect)</h3>
            <p>Atrapador de pokemones</p>
            
            {/* Alerta personalizada */}
            {alertData && (
                <div style={{
                    ...styles.alertContainer,
                    ...(alertData.type === 'success' ? styles.alertSuccess : styles.alertWarning)
                }}>
                    <span style={styles.alertIcon}>
                        {alertData.type === 'success' ? '✓' : '⚠️'}
                    </span>
                    <div style={styles.alertMessage}>
                        {alertData.message}
                    </div>
                </div>
            )}

            <style>{`
                @keyframes slideIn {
                    from {
                        transform: translateX(400px);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                @keyframes slideOut {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(400px);
                        opacity: 0;
                    }
                }
            `}</style>
            
            <div style={styles.container}>
                {/* Mensaje de atrapando */}
                <div style={styles.message}>
                    {isCapturing && "¡Atrapando pokémon...!"}
                </div>

                {/* Botón Atrapar */}
                <div style={styles.buttonContainer}>
                    <button
                        style={styles.button}
                        onMouseEnter={(e) => e.currentTarget.style.transform = "scale(1.05)"}
                        onMouseLeave={(e) => e.currentTarget.style.transform = "scale(1)"}
                        onClick={trapPokemon}
                        disabled={isCapturing}
                    >
                        {isCapturing ? "Atrapando..." : "Atrapar Pokémon"}
                    </button>
                </div>

                {/* Pokémon actual */}
                {currentPokemon && !isCapturing && (
                    <div style={styles.section}>
                        <h3 style={{textAlign: "center"}}>¡{currentPokemon.name} atrapado!</h3>
                        <div style={styles.cardsContainer}>
                            <CardPokemon
                                name={currentPokemon.name}
                                type={currentPokemon.type}
                                level={currentPokemon.level}
                                power={currentPokemon.power}
                                abilitie={currentPokemon.Abilitie}
                                image={currentPokemon.image}
                                legendary={currentPokemon.legendary}
                            />
                        </div>
                    </div>
                )}

                {/* Pokemones atrapados */}
                <div style={styles.section}>
                    <h3>Pokemones Atrapados</h3>
                    <div style={styles.capturedCounter}>
                        Total: {capturedPokemons.length} / {allPokemons.length}
                    </div>
                    {capturedPokemons.length === 0 ? (
                        <p style={{textAlign: "center", color: "#999"}}>Aún no has atrapado ningún pokémon</p>
                    ) : (
                        <div style={styles.cardsContainer}>
                            {capturedPokemons.map(pokemon => (
                                <div key={pokemon.id}>
                                    <CardPokemon
                                        name={pokemon.name}
                                        type={pokemon.type}
                                        level={pokemon.level}
                                        power={pokemon.power}
                                        abilitie={pokemon.Abilitie}
                                        image={pokemon.image}
                                        legendary={pokemon.legendary}
                                    />
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}

export default Example4StateHooks;