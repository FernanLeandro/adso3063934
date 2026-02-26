import BtnBack from "../components/BtnBack";
import { useState } from "react";

function Example5Eventos() {

    const [chosenPokemon, setChosenPokemon] = useState(null);

    const handleChoice = (name, event) => {
        alert(event)
        setChosenPokemon(name)
    }

    const buttonStyle = {
        color: 'red'
    }

    return (
        <div className="container">
            <BtnBack />
            <h2>Example 5: Event Handling</h2>
            <p>Respond to user interactions (click, hover, input submit)</p>
            <div>
                <h3>Click event</h3>
                <button
                    onClick={(e) => setChosenPokemon('gengar', e)}
                    style={buttonStyle}
                >
                    Gengar
                </button>
                <button
                    onClick={(e) => setChosenPokemon('pikachu', e)}
                    style={buttonStyle}
                >
                    Pikachu
                </button>
                <button
                    onClick={(e) => setChosenPokemon('mewtwo', e)}
                    style={buttonStyle}
                >
                    Mewtwo
                </button>
                {chosenPokemon ? (
                    <div>You chose: {chosenPokemon}!</div>
                ) : (
                    <div>Please choose a Pokemon.</div>

                )
                }
            </div>
        </div>
    )
}

export default Example5Eventos;