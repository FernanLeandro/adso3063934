import React, { useEffect, useState } from 'react';
import { useNavigate, useParams, Link } from 'react-router-dom';
import API from '../api';
import Swal from 'sweetalert2';

export default function EditPet() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [form, setForm] = useState(null);

  useEffect(() => {
    API.get(`/pets/show/${id}`).then(resp => setForm(resp.data.pet));
  }, [id]);
  const handleChange = e => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    try {
      const resp = await API.put(`/pets/edit/${id}`, form);
      Swal.fire({
        title: "Success!",
        text: resp.data.message || 'Pet updated successfully',
        icon: "success",
        showConfirmButton: false,
        timer: 1500
      }).then(() => {
        navigate('/');
      });
    } catch (err) {
      const msg = err.response?.data?.message || 'Could not update pet';
      Swal.fire({
        title: "Error",
        text: msg,
        icon: "error"
      });
    }
  };

  if (!form) return <div>Loading...</div>;

  return (
    <main id="edit">
      <header>
        <Link className="btnBack" to="/">
          <img src="/imgs/back.png" alt="Back" />
        </Link>
        <img src="/imgs/title-edit.png" alt="Edit" />
      </header>
      <form onSubmit={handleSubmit}>
        <label>
          Name:
          <input name="name" value={form.name || ''} onChange={handleChange} />
        </label>
        <label>
          Kind:
          <input name="kind" value={form.kind || ''} onChange={handleChange} />
        </label>
        <label>
          Weight:
          <input name="weight" value={form.weight || ''} onChange={handleChange} />
        </label>
        <label>
          Age:
          <input name="age" value={form.age || ''} onChange={handleChange} />
        </label>
        <label>
          Breed:
          <input name="breed" value={form.breed || ''} onChange={handleChange} />
        </label>
        <label>
          Location:
          <input name="location" value={form.location || ''} onChange={handleChange} />
        </label>
        <label>
          Description:
          <textarea
            name="description"
            value={form.description || ''}
            onChange={handleChange}
          />
        </label>
        <div className="form-actions">
          <button type="submit" className="saveBtn">
            Edit
          </button>
          <button type="button" className="cancelBtn" onClick={() => navigate(-1)}>
            Cancel
          </button>
        </div>
      </form>
    </main>
  );
}
