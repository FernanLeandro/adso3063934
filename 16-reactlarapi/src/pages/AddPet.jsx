import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import API from '../api';
import Swal from 'sweetalert2';

export default function AddPet() {
  const [form, setForm] = useState({
    name: '',
    kind: '',
    weight: '',
    age: '',
    breed: '',
    location: '',
    description: '',
  });
  const navigate = useNavigate();

  const handleChange = e => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    
    // Validar campos requeridos
    if (!form.name || !form.kind || !form.weight || !form.age || !form.breed || !form.location) {
      Swal.fire({
        title: "Warning!",
        text: 'Please fill all fields',
        icon: "warning"
      });
      return;
    }

    try {
      const resp = await API.post('/pets/store', form);
      Swal.fire({
        title: "Success!",
        text: resp.data.message || 'Pet added successfully',
        icon: "success",
        showConfirmButton: false,
        timer: 1500
      }).then(() => {
        navigate('/');
      });
    } catch (err) {
      const msg = err.response?.data?.message || 'Could not create pet';
      Swal.fire({
        title: "Error",
        text: msg,
        icon: "error"
      });
    }
  };

  return (
    <main id="add">
      <header>
        <Link className="btnBack" to="/">
          <img src="/imgs/back.png" alt="Back" />
        </Link>
        <img src="/imgs/title-add.png" alt="Add" />
      </header>
      <form onSubmit={handleSubmit}>
        <label>
          Name:
          <input name="name" value={form.name} onChange={handleChange} required />
        </label>
        <label>
          Kind:
          <input name="kind" value={form.kind} onChange={handleChange} required />
        </label>
        <label>
          Weight:
          <input name="weight" value={form.weight} onChange={handleChange} />
        </label>
        <label>
          Age:
          <input name="age" value={form.age} onChange={handleChange} />
        </label>
        <label>
          Breed:
          <input name="breed" value={form.breed} onChange={handleChange} />
        </label>
        <label>
          Location:
          <input name="location" value={form.location} onChange={handleChange} />
        </label>
        <label>
          Description:
          <textarea name="description" value={form.description} onChange={handleChange} />
        </label>
        <div className="form-actions">
          <button type="submit" className="addBtn">
            Add
          </button>
          <button type="button" className="cancelBtn" onClick={() => navigate(-1)}>
            Cancel
          </button>
        </div>
      </form>
    </main>
  );
}
