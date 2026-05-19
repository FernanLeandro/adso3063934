import React, { useEffect, useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import API from '../api';

export default function ShowPet() {
  const { id } = useParams();
  const [pet, setPet] = useState(null);

  useEffect(() => {
    API.get(`/pets/show/${id}`).then(resp => setPet(resp.data.pet));
  }, [id]);
  if (!pet) return <div>Loading...</div>;

  return (
    <main id="show">
      <header>
        <Link className="btnBack" to="/">
          <img src="/imgs/back.png" alt="Back" />
        </Link>
        <img src="/imgs/title-show.png" alt="Show" />
      </header>
      <div className="show-image">
        <img 

        />
      </div>
      <div className="info-card">
        <div className="row">
          <div className="label">Name:</div>
          <div className="value">{pet.name}</div>
        </div>
        <div className="row">
          <div className="label">Kind:</div>
          <div className="value">{pet.kind}</div>
        </div>
        <div className="row">
          <div className="label">Weight:</div>
          <div className="value">{pet.weight}</div>
        </div>
        <div className="row">
          <div className="label">Age:</div>
          <div className="value">{pet.age}</div>
        </div>
        <div className="row">
          <div className="label">Breed:</div>
          <div className="value">{pet.breed}</div>
        </div>
        <div className="row">
          <div className="label">Location:</div>
          <div className="value">{pet.location}</div>
        </div>
        <div className="row">
          <div className="label">Description:</div>
          <div className="value">{pet.description}</div>
        </div>
      </div>
    </main>
  );
}
