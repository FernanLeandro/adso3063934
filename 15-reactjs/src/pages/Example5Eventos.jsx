import BtnBack from "../components/BtnBack";
import { useState } from "react";

function Example5Eventos() {

    const [chosenPokemon, setChosenPokemon] = useState(null);
    const [hoveredPokemon, setHoveredPokemon] = useState(null);
    const [inputRange, setSliderValue] = useState(0);



    const handleChoice = (name, event) => {
        setChosenPokemon(name)
    }

    //Event Mousehover

    const handleHover = (name) => {
        setHoveredPokemon(name)
    }

    //Event Mouseleave

    const handleLeave = () => {
        setHoveredPokemon(null)
    }

    //Event Input

    const handleInput = (e) => {
        setSliderValue(e.target.value)
    }

    const baseButtonStyle = {
        padding: '8px 14px',
        borderRadius: '6px',
        border: 'none',
        cursor: 'pointer',
        marginRight: '8px',
        fontWeight: '600',
        boxShadow: '0 2px 6px rgba(0,0,0,0.12)'
    }

    const getButtonStyle = (name) => {
        const common = { ...baseButtonStyle }
        const meta = pokemonMeta[name] || {}
        return {
            ...common,
            backgroundColor: meta.color || '#1e90ff',
            color: meta.textColor || '#fff'
        }
    }

    const pokemonMeta = {
        pikachu: { icon: '⚡️', color: '#FFD700', textColor: '#222' },
        gengar: { icon: '👻', color: '#6f42c1', textColor: '#fff' },
        mewtwo: { icon: '🔮', color: '#b19cd9', textColor: '#111' }
    }

    const resultContainerStyle = {
        display: 'inline-flex',
        alignItems: 'center',
        padding: '8px 12px',
        borderRadius: '6px',
        background: 'rgba(0,0,0,0.6)',
        color: '#fff',
        marginTop: '12px'
    }

    const getIconBoxStyle = (pokemon) => ({
        width: 40,
        height: 40,
        borderRadius: 6,
        background: pokemonMeta[pokemon]?.color || '#fff',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        marginRight: 12,
        fontSize: 20,
        color: pokemonMeta[pokemon]?.textColor || '#000'
    })

    const sliderStyle = {
        width: '100%',
        maxWidth: '360px',
        marginTop: '12px',
        height: '8px',
        borderRadius: '6px',
        background: 'linear-gradient(90deg, #6f42c1 0%, #1e90ff 50%, #FFD700 100%)',
        appearance: 'none',
        outline: 'none',
        cursor: 'pointer',
        accentColor: '#1e90ff'
    }

    const sliderContainerStyle = {
        display: 'flex',
        alignItems: 'center',
        gap: '12px',
        marginTop: '8px'
    }

    const sliderValueStyle = {
        minWidth: 56,
        textAlign: 'center',
        padding: '6px 10px',
        borderRadius: 8,
        background: 'rgba(0,0,0,0.6)',
        color: '#fff',
        fontWeight: 700,
        boxShadow: '0 2px 6px rgba(0,0,0,0.2)'
    }

    return (
        <div className="container">
            <BtnBack />
            <h2>Example 5: Event Handling</h2>
            <p>Respond to user interactions (click, hover, input submit)</p>
            <div>
                <h3>Click event:</h3>
                <button
                    onClick={(e) => handleChoice('gengar', e)}
                    style={getButtonStyle('gengar')}
                >
                    <span style={{ marginRight: '8px' }}>{pokemonMeta.gengar.icon}</span>
                    Gengar
                </button>
                <button
                    onClick={(e) => handleChoice('pikachu', e)}
                    style={getButtonStyle('pikachu')}
                >
                    <span style={{ marginRight: '8px' }}>{pokemonMeta.pikachu.icon}</span>
                    Pikachu
                </button>
                <button
                    onClick={(e) => handleChoice('mewtwo', e)}
                    style={getButtonStyle('mewtwo')}
                >
                    <span style={{ marginRight: '8px' }}>{pokemonMeta.mewtwo.icon}</span>
                    Mewtwo
                </button>
                {chosenPokemon ? (
                    <div style={resultContainerStyle}>
                        <div style={getIconBoxStyle(chosenPokemon)}>
                            {pokemonMeta[chosenPokemon]?.icon}
                        </div>
                        <div>
                            <div style={{ fontWeight: 700 }}>You chose: {chosenPokemon}!</div>
                            <div style={{ fontSize: 12, opacity: 0.9 }}>Nice pick — that icon shows the Pokémon.</div>
                        </div>
                    </div>
                ) : (
                    <div style={{
                        marginTop: '12px',
                        display: 'inline-block',
                        padding: '14px 18px',
                        borderRadius: '8px',
                        background: 'rgba(0,0,0,0.6)',
                        color: '#fff'
                    }}>
                        <div style={{ display: 'flex', alignItems: 'center' }}>
                            <div style={{
                                width: 40,
                                height: 40,
                                borderRadius: 6,
                                background: 'rgba(255,255,255,0.06)',
                                display: 'flex',
                                alignItems: 'center',
                                justifyContent: 'center',
                                marginRight: 12
                            }}>
                                <svg width="22" height="22" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <defs>
                                        <clipPath id="half">
                                            <rect x="0" y="0" width="100" height="50" />
                                        </clipPath>
                                    </defs>
                                    <circle cx="50" cy="50" r="46" fill="#fff" stroke="#000" strokeWidth="4" />
                                    <g clipPath="url(#half)">
                                        <circle cx="50" cy="50" r="46" fill="#ee3b3b" />
                                    </g>
                                    <rect x="4" y="44" width="92" height="12" fill="#000" />
                                    <circle cx="50" cy="50" r="18" fill="#fff" stroke="#000" strokeWidth="4" />
                                    <circle cx="50" cy="50" r="8" fill="#ddd" stroke="#000" strokeWidth="2" />
                                </svg>
                            </div>
                            <div>
                                <div style={{ fontWeight: 700 }}>Please choose a Pokemon.</div>
                                <div style={{ fontSize: 12, opacity: 0.85 }}>Click a button to pick one.</div>
                            </div>

                        </div>
                    </div>
                )}
                <div>
                    <h3>MouseEnter/MouseLeave Event:</h3>
                    <div>
                        <h3>Click event:</h3>
                        <button
                            onMouseEnter={() => handleHover('gengar')}
                            onMouseLeave={() => handleLeave()}
                            style={getButtonStyle('gengar')}
                        >
                            Hover Here!
                            <img style={{zoom: '0.47'}} src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/94.png" alt="gengar" />
                        </button>
                        <button
                            onMouseEnter={() => handleHover('pikachu')}
                            onMouseLeave={() => handleLeave()}
                            style={getButtonStyle('pikachu')}
                        >
                            Hover Here!
                            <img style={{zoom: '0.47'}}src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png" alt="pikachu" />
                        </button>
                    </div>
                    {hoveredPokemon ? (
                        <div style={resultContainerStyle}>
                            <div style={getIconBoxStyle(hoveredPokemon)}>
                                {pokemonMeta[hoveredPokemon]?.icon}
                            </div>
                            <div>
                                <div style={{ fontWeight: 700 }}>Hovering: {hoveredPokemon}!</div>
                                <div style={{ fontSize: 12, opacity: 0.9 }}>Nice hover effect — move away to clear.</div>
                            </div>
                        </div>
                    ) : null}
                </div>
                <h3>Input event:</h3>
                <input
                    onInput={handleInput}
                    type="range"
                    min="0"
                    max="100"
                    value={inputRange}
                    style={sliderStyle}
                />
                <div style={sliderContainerStyle}>
                    <div style={sliderValueStyle}>{inputRange}</div>
                    <div style={{ fontSize: 13, color: '#333', opacity: 0.9 }}></div>
                </div>
            </div>
        </div>
    )
}

export default Example5Eventos;