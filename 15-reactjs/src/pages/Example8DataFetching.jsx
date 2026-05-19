import React, { useState, useEffect } from 'react';
import BtnBack from '../components/BtnBack';
import './Example8DataFetching.css';

function Example8DataFetching() {
    const [pokemons, setPokemons] = useState([]);
    const [loading, setLoading] = useState(false);
    const [selected, setSelected] = useState(null);
    const [page, setPage] = useState(0);
    const limit = 24;

    useEffect(() => {
        let cancelled = false;
        async function loadList() {
            setLoading(true);
            try {
                const offset = page * limit;
                const res = await fetch(`https://pokeapi.co/api/v2/pokemon?offset=${offset}&limit=${limit}`);
                const data = await res.json();
                if (cancelled) return;
                const items = data.results.map(r => {
                    const parts = r.url.split('/').filter(Boolean);
                    const id = parts[parts.length - 1];
                    return { name: r.name, url: r.url, id: Number(id) };
                });
                setPokemons(items);
            } catch (err) {
                console.error('Error fetching pokemons list', err);
            } finally {
                if (!cancelled) setLoading(false);
            }
        }
        loadList();
        return () => { cancelled = true; };
    }, [page]);

    async function showDetails(p) {
        setSelected({ loading: true });
        try {
            const res = await fetch(p.url);
            const data = await res.json();
            // try animated gif (black-white), then pixel-art front_default, then official artwork
            const sprite = data.sprites?.versions?.['generation-v']?.['black-white']?.animated?.front_default
                || data.sprites?.front_default
                || data.sprites?.other?.['official-artwork']?.front_default
                || null;
            const details = {
                id: data.id,
                name: data.name,
                sprite,
                height: data.height,
                weight: data.weight,
                types: data.types.map(t => t.type.name),
                abilities: data.abilities.map(a => a.ability.name),
            };
            setSelected(details);
        } catch (err) {
            console.error('Error fetching pokemon details', err);
            setSelected({ error: true });
        }
    }

    const prev = () => setPage(p => Math.max(0, p - 1));
    const next = () => setPage(p => p + 1);

    return (
        <div className="container example8">
            <BtnBack />
            <h2>Ejemplo 8: Data Fetching</h2>
            <p>Conectando con PokeAPI para listar pokémon y mostrar detalles al seleccionar.</p>

            <div className="example8-panel">
                <div className="example8-list">
                    <div className="example8-controls">
                        <button onClick={prev} disabled={page === 0} className="btn-small">Previous</button>
                        <button onClick={next} className="btn-small">Next</button>
                        <span className="muted">Page {page + 1}</span>
                    </div>

                    {loading ? (
                        <p>Cargando pokémon...</p>
                    ) : (
                        <div className="grid-list">
                            {pokemons.map(p => (
                                <button key={p.id} className="poke-cell" onClick={() => showDetails(p)}>
                                    <div className="cell-number">#{String(p.id).padStart(3, '0')}</div>
                                    <img
                                        src={`https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/${p.id}.gif`}
                                        alt={p.name}
                                        onError={(e) => { e.target.onerror = null; /* try pixel art */ e.target.src = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${p.id}.png`; }}
                                        className="cell-img"
                                    />
                                    <div className="cell-name">{p.name}</div>
                                </button>
                            ))}
                        </div>
                    )}
                </div>

                <aside className="example8-details">
                    {selected ? (
                        selected.loading ? (
                            <p>Cargando detalles...</p>
                        ) : selected.error ? (
                            <p>Error al obtener detalles.</p>
                        ) : (
                            <div className="detail-card">
                                <img src={selected.sprite} alt={selected.name} className="detail-img" />
                                <h2>{selected.name} <span className="muted">#{String(selected.id).padStart(3,'0')}</span></h2>
                                <p><strong>Height:</strong> {selected.height} dm</p>
                                <p><strong>Weight:</strong> {selected.weight} hg</p>
                                <p><strong>Types:</strong> {selected.types.join(', ')}</p>
                                <p><strong>Abilities:</strong> {selected.abilities.join(', ')}</p>
                            </div>
                        )
                    ) : (
                        <div className="detail-empty">
                            <p>Selecciona un pokémon a la izquierda para ver sus detalles.</p>
                        </div>
                    )}
                </aside>
            </div>
        </div>
    );
}

export default Example8DataFetching;