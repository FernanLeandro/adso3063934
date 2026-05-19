import BtnBack from "../components/BtnBack";
import { useState } from "react";

function Example6CondicionalListas() {

    // Datos iniciales de Pokémon
    const allPokemonData = [
        { id: 1, name: 'Pikachu', level: 5, type: 'Electric', icon: '⚡️', color: '#FFD700' },
        { id: 2, name: 'Charmander', level: 8, type: 'Fire', icon: '🔥', color: '#FF6B35' },
        { id: 3, name: 'Squirtle', level: 8, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 4, name: 'Bulbasaur', level: 8, type: 'Grass', icon: '🌿', color: '#7BC043' },
        { id: 5, name: 'Gengar', level: 3, type: 'Ghost', icon: '👻', color: '#6f42c1' },
        { id: 6, name: 'Arcanine', level: 12, type: 'Fire', icon: '🔥', color: '#FF6B35' },
        { id: 7, name: 'Lapras', level: 15, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 8, name: 'Dragonite', level: 20, type: 'Dragon', icon: '🐉', color: '#9B59B6' },
        { id: 9, name: 'Raichu', level: 12, type: 'Electric', icon: '⚡️', color: '#FFD700' },
        { id: 10, name: 'Charizard', level: 16, type: 'Fire', icon: '🔥', color: '#FF6B35' },
        { id: 11, name: 'Blastoise', level: 16, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 12, name: 'Venusaur', level: 16, type: 'Grass', icon: '🌿', color: '#7BC043' },
        { id: 13, name: 'Muk', level: 4, type: 'Poison', icon: '☠️', color: '#9B59B6' },
        { id: 14, name: 'Psyduck', level: 2, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 15, name: 'Golduck', level: 10, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 16, name: 'Mankey', level: 3, type: 'Fighting', icon: '👊', color: '#E67E22' },
        { id: 17, name: 'Primeape', level: 13, type: 'Fighting', icon: '👊', color: '#E67E22' },
        { id: 18, name: 'Growlithe', level: 6, type: 'Fire', icon: '🔥', color: '#FF6B35' },
        { id: 19, name: 'Abra', level: 2, type: 'Psychic', icon: '🧠', color: '#9B59B6' },
        { id: 20, name: 'Kadabra', level: 11, type: 'Psychic', icon: '🧠', color: '#9B59B6' },
        { id: 21, name: 'Machop', level: 4, type: 'Fighting', icon: '👊', color: '#E67E22' },
        { id: 22, name: 'Machoke', level: 13, type: 'Fighting', icon: '👊', color: '#E67E22' },
        { id: 23, name: 'Bellsprout', level: 3, type: 'Grass', icon: '🌿', color: '#7BC043' },
        { id: 24, name: 'Weepinbell', level: 10, type: 'Grass', icon: '🌿', color: '#7BC043' },
        { id: 25, name: 'Tentacool', level: 4, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 26, name: 'Tentacruel', level: 13, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 27, name: 'Slowpoke', level: 5, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 28, name: 'Seel', level: 4, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 29, name: 'Shellder', level: 5, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 30, name: 'Gastly', level: 3, type: 'Ghost', icon: '👻', color: '#6f42c1' },
        { id: 31, name: 'Haunter', level: 12, type: 'Ghost', icon: '👻', color: '#6f42c1' },
        { id: 32, name: 'Onix', level: 8, type: 'Rock', icon: '🪨', color: '#95A5A6' },
        { id: 33, name: 'Drowzee', level: 4, type: 'Psychic', icon: '🧠', color: '#9B59B6' },
        { id: 34, name: 'Krabby', level: 6, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 35, name: 'Kingler', level: 14, type: 'Water', icon: '💧', color: '#4A90E2' },
        { id: 36, name: 'Voltorb', level: 5, type: 'Electric', icon: '⚡️', color: '#FFD700' },
        { id: 37, name: 'Jolteon', level: 10, type: 'Electric', icon: '⚡️', color: '#FFD700' },
        { id: 38, name: 'Gloom', level: 7, type: 'Grass', icon: '🌿', color: '#7BC043' },
        { id: 39, name: 'Vileplume', level: 15, type: 'Grass', icon: '🌿', color: '#7BC043' },
        { id: 40, name: 'Paras', level: 3, type: 'Grass', icon: '🌿', color: '#7BC043' }
    ]

    const [pokemons, setPokemons] = useState([
        allPokemonData[0],
        allPokemonData[1],
        allPokemonData[2],
        allPokemonData[3]
    ])

    const [filterType, setFilterType] = useState('All types')
    const [filterLevel, setFilterLevel] = useState(false)

    // Obtener tipos únicos
    const uniqueTypes = ['All types', ...new Set(allPokemonData.map(p => p.type))]

    // Filtrar lista
    const filteredPokemons = pokemons.filter(pokemon => {
        const typeMatch = filterType === 'All types' || pokemon.type === filterType
        const levelMatch = !filterLevel || pokemon.level >= 4
        return typeMatch && levelMatch
    })

    // Añadir Pokémon aleatorio
    const handleAddRandom = () => {
        const randomPokemon = allPokemonData[Math.floor(Math.random() * allPokemonData.length)]
        if (!pokemons.find(p => p.id === randomPokemon.id && p.name === randomPokemon.name)) {
            setPokemons([...pokemons, { ...randomPokemon }])
        }
    }

    // Remover Pokémon
    const handleRelease = (index) => {
        setPokemons(pokemons.filter((_, i) => i !== index))
    }

    // Estilos
    const containerStyle = {
        padding: '20px',
        maxWidth: '1200px',
        margin: '0 auto'
    }

    const filtersContainerStyle = {
        display: 'flex',
        gap: '12px',
        marginBottom: '20px',
        alignItems: 'center',
        flexWrap: 'wrap'
    }

    const filterButtonStyle = (isActive) => ({
        padding: '8px 14px',
        borderRadius: '6px',
        border: 'none',
        cursor: 'pointer',
        fontWeight: '600',
        fontSize: '13px',
        background: isActive ? '#1e90ff' : 'rgba(255,255,255,0.2)',
        color: '#fff',
        transition: 'all 0.3s ease'
    })

    const addButtonStyle = {
        padding: '10px 16px',
        borderRadius: '6px',
        border: 'none',
        cursor: 'pointer',
        fontWeight: '700',
        fontSize: '14px',
        background: '#2ECC71',
        color: '#fff',
        boxShadow: '0 2px 6px rgba(0,0,0,0.12)',
        transition: 'all 0.3s ease'
    }

    const checkboxStyle = {
        cursor: 'pointer',
        width: '18px',
        height: '18px',
        accentColor: '#1e90ff'
    }

    const gridContainerStyle = {
        display: 'grid',
        gridTemplateColumns: 'repeat(auto-fill, minmax(200px, 1fr))',
        gap: '16px'
    }

    const cardStyle = {
        borderRadius: '10px',
        padding: '16px',
        background: 'linear-gradient(135deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.4) 100%)',
        boxShadow: '0 4px 12px rgba(0,0,0,0.2)',
        border: '2px solid rgba(255,255,255,0.1)',
        transition: 'transform 0.2s, box-shadow 0.2s',
        cursor: 'pointer'
    }

    const iconBoxStyle = (pokemon) => ({
        width: '50px',
        height: '50px',
        borderRadius: '8px',
        background: pokemon.color || '#1e90ff',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        fontSize: '28px',
        marginBottom: '10px'
    })

    const releaseButtonStyle = {
        width: '100%',
        padding: '8px',
        marginTop: '12px',
        borderRadius: '6px',
        border: 'none',
        background: '#E74C3C',
        color: '#fff',
        fontWeight: '700',
        cursor: 'pointer',
        fontSize: '12px',
        transition: 'all 0.2s'
    }

    const statsStyle = {
        display: 'flex',
        justifyContent: 'space-between',
        fontSize: '12px',
        color: '#666',
        marginBottom: '8px'
    }

    const countStyle = {
        display: 'inline-block',
        padding: '6px 12px',
        borderRadius: '6px',
        background: 'rgba(255,255,255,0.2)',
        fontSize: '13px',
        fontWeight: '600',
        color: '#fff'
    }

    return (
        <div className="container">
            <BtnBack />
            <h2>Example 6: Conditional Rendering & Lists</h2>
            <p>Show or hide UI elements based on state</p>

            <div style={containerStyle}>
                {/* Filtros */}
                <div style={filtersContainerStyle}>
                    <label style={{ fontWeight: '600', color: '#fff' }}>Filters:</label>

                    {uniqueTypes.map((type) => (
                        <button
                            key={type}
                            onClick={() => setFilterType(type)}
                            style={filterButtonStyle(filterType === type)}
                        >
                            {type}
                        </button>
                    ))}

                    <div style={{ display: 'flex', alignItems: 'center', gap: '8px', marginLeft: '12px' }}>
                        <input
                            type="checkbox"
                            id="levelFilter"
                            checked={filterLevel}
                            onChange={(e) => setFilterLevel(e.target.checked)}
                            style={checkboxStyle}
                        />
                        <label htmlFor="levelFilter" style={{ fontSize: '13px', fontWeight: '600', color: '#fff', cursor: 'pointer' }}>
                            Show only level 4+
                        </label>
                    </div>

                    <button
                        onClick={handleAddRandom}
                        style={addButtonStyle}
                    >
                        + Add random Pokémon
                    </button>
                </div>

                {/* Contador */}
                <div style={{ marginBottom: '16px', fontSize: '14px', color: '#fff' }}>
                    Showing <span style={countStyle}>{filteredPokemons.length}</span> of <span style={countStyle}>{pokemons.length}</span> Pokémon
                </div>

                {/* Lista de Pokémon */}
                {filteredPokemons.length > 0 ? (
                    <div style={gridContainerStyle}>
                        {filteredPokemons.map((pokemon, index) => (
                            <div key={`${pokemon.name}-${index}`} style={cardStyle}>
                                <div style={iconBoxStyle(pokemon)}>
                                    {pokemon.icon}
                                </div>
                                <div style={{ fontWeight: '700', fontSize: '16px', marginBottom: '6px', color: '#fff' }}>
                                    {pokemon.name}
                                </div>
                                <div style={{ ...statsStyle, color: '#ddd' }}>
                                    <span>Level: {pokemon.level}</span>
                                </div>
                                <div style={{ fontSize: '13px', color: '#ddd', marginBottom: '8px' }}>
                                    Type: <strong>{pokemon.type}</strong>
                                </div>
                                <button
                                    onClick={() => handleRelease(pokemons.indexOf(pokemon))}
                                    style={releaseButtonStyle}
                                    onMouseEnter={(e) => e.target.style.background = '#C0392B'}
                                    onMouseLeave={(e) => e.target.style.background = '#E74C3C'}
                                >
                                    Release
                                </button>
                            </div>
                        ))}
                    </div>
                ) : (
                    <div style={{
                        textAlign: 'center',
                        padding: '40px 20px',
                        borderRadius: '10px',
                        background: 'rgba(0,0,0,0.3)',
                        color: '#fff'
                    }}>
                        <div style={{ fontSize: '18px', fontWeight: '600', marginBottom: '8px' }}>
                            No Pokémon match this filter
                        </div>
                        <div style={{ fontSize: '14px', opacity: 0.9 }}>
                            Try changing your filters or adding more Pokémon
                        </div>
                    </div>
                )}
            </div>
        </div>
    )
}

export default Example6CondicionalListas;
