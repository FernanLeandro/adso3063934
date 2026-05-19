import {Routes, Route, Link, useLocation} from 'react-router-dom';
import BtnBack from '../components/BtnBack';
import './Example7Routing.css';


function GeneralInfo() {
    return (
        <section className="example7-card">
            <h2>Bienvenido a la Región PokéMountain</h2>
            <p className="muted">Explora entrenadores, descubre pokémon y visita localidades únicas.</p>
            <p>En esta demo puedes ver una lista pequeña de pokémon, y consultar detalles rápidos con imagen.</p>
        </section>
    );
}

function PokemonList() {
    const pokemons = [
        { id: 25, name: 'Pikachu' },
        { id: 4, name: 'Charmander' },
        { id: 7, name: 'Squirtle' },
        { id: 1, name: 'Bulbasaur' },
        { id: 133, name: 'Eevee' },
        { id: 39, name: 'Jigglypuff' },
    ];

    return (
        <section className="example7-grid">
            {pokemons.map(p => (
                <article key={p.id} className="poke-card">
                    <img
                        src={`https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${p.id}.png`}
                        alt={p.name}
                        className="poke-img"
                        onError={(e) => { e.target.onerror = null; e.target.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${p.id}.png`; }}
                    />
                    <h3>{p.name}</h3>
                </article>
            ))}
        </section>
    );
}

function PokemonDetails() {
    const location = useLocation();
    const params = new URLSearchParams(location.search);
    const name = params.get('name') || 'Desconocido';

    const idMap = {
        pikachu: 25,
        charmander: 4,
        squirtle: 7,
        bulbasaur: 1,
        eevee: 133,
        jigglypuff: 39,
    };

    const id = idMap[name.toLowerCase()] || null;

    return (
        <section className="example7-card detail">
            <h2>Viendo detalles de {name}</h2>
            {id ? (
                <div className="detail-inner">
                    <img
                        src={`https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${id}.png`}
                        alt={name}
                        className="poke-img-large"
                        onError={(e) => { e.target.onerror = null; e.target.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${id}.png`; }}
                    />
                    <div className="detail-text">
                        <p className="muted">Tipo: Ejemplo (demo)</p>
                        <p>Descripción corta: Aquí podrías mostrar información real del Pokémon, como habilidades, estadísticas y evolución.</p>
                    </div>
                </div>
            ) : (
                <p>No hay imagen disponible para este Pokémon.</p>
            )}
        </section>
    );
}
function InternalNavigation() {
    const location = useLocation();
    
    const isActive = (path) => {
        return location.pathname === `/example7${path}`;
    };
    
    return (
        <nav className="nav-example7">
            <div className="nav-container">
                <Link 
                    to="/example7/" 
                    className={`nav-link ${isActive('/') ? 'active' : ''}`}
                >
                    <span className="nav-icon">🏠</span>
                    <span className="nav-text">Home</span>
                </Link>
                <Link 
                    to="/example7/list" 
                    className={`nav-link ${isActive('/list') ? 'active' : ''}`}
                >
                    <span className="nav-icon">📋</span>
                    <span className="nav-text">List</span>
                </Link>
                <Link 
                    to="/example7/details?name=Pikachu" 
                    className={`nav-link ${isActive('/details') ? 'active' : ''}`}
                >
                    <span className="nav-icon">⚡</span>
                    <span className="nav-text">Pikachu</span>
                </Link>
                <Link 
                    to="/example7/details?name=Charmander" 
                    className={`nav-link ${isActive('/details') ? 'active' : ''}`}
                >
                    <span className="nav-icon">🔥</span>
                    <span className="nav-text">Charmander</span>
                </Link>
            </div>
        </nav>
    );
}

function Example7Routing() {
  return (
    <div className='container'>
        <BtnBack/>
        <h2>Example 7: React Router</h2>
        <p>Navigation between different 'pages' without reloading the entire application.   </p>
        <InternalNavigation/>
        {/* Define routes for the application */}
        <Routes>
            <Route path="/" element={<GeneralInfo/>} />
            <Route path="/list" element={<PokemonList/>} />
            <Route path="/details" element={<PokemonDetails/>} />
        </Routes>
    </div>
    );
}
export default Example7Routing;
      