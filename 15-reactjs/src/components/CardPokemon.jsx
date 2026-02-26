import './CardPokemon.css';

function CardPokemon({ name, type, level, power, abilitie, image, legendary = false }) {

    const typeColors = {
        "ghost/poison": "#A020F0",
        "electric": "#FFD700",
        "psychic": "#FF69B4",
    };

    return (
        <div
            className='pokemon-card'
            style={{ borderColor: typeColors[type?.toLowerCase()] || '#ccc' }}
        >
            {image && <img src={image} alt={name} className="pokemon-img" />}
            <h3>{name}</h3>
            <p className='pokemon-type'>Type: {type}</p>
            <p className="pokemon-power">Power: {power}</p>
            <p className="pokemon-ability">Abilitie: {abilitie}</p>
            {legendary && <span className="legendary-badge">💫 Legendary 💫</span>}
        </div>
    )
}

export default CardPokemon;