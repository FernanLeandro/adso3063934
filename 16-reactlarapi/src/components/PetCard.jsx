import React from 'react';
import { Link } from 'react-router-dom';

export default function PetCard({ pet, onDelete }) {
  const imageSrc = pet.image ? `../20-laravel/public/images/${pet.image}` : '../20-laravel/public/images/no-image.png';

  return (
    <div className="row">
      <img 

      />
      <div className="data">
        <h3>{pet.name}</h3>
        <h4>{pet.kind}: {pet.breed}</h4>
      </div>
      <nav className="actions">
        <Link className="show" to={`/show/${pet.id}`} title="Show" />
        <Link className="edit" to={`/edit/${pet.id}`} title="Edit" />
        <button className="delete" onClick={() => onDelete(pet.id)} title="Delete" />
      </nav>
    </div>
  );
}
