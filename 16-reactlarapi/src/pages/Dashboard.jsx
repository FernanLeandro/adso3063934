import React, { useEffect, useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import API from '../api';
import PetCard from '../components/PetCard';
import Swal from 'sweetalert2';

export default function Dashboard() {
  const [pets, setPets] = useState([]);
  const navigate = useNavigate();

  const fetchPets = async () => {
    try {
      // backend uses /pets/list for the GET list
      const resp = await API.get('/pets/list');
      // API responds with { message, pets: [...] }
      setPets(resp.data.pets || []);
    } catch (err) {
      console.error('fetchPets error', err);
      const msg = err.response?.data?.message || 'Failed to load pets';
      Swal.fire('Error', msg, 'error');
      if (err.response?.status === 401) {
        // unauthorized, clear token and send back to login
        localStorage.removeItem('token');
        navigate('/login');
      }
    }
  };

  useEffect(() => {
    fetchPets();
  }, []);

  const handleDelete = async id => {
    const petName = pets.find(p => p.id === id)?.name || 'this pet';
    Swal.fire({
      title: 'Are you sure?',
      text: `You want to delete "${petName}"?`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#1E8600',
      cancelButtonColor: '#860000',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel'
    }).then(async (result) => {
      if (result.isConfirmed) {
        try {
          const resp = await API.delete(`/pets/delete/${id}`);
          setPets(pets.filter(p => p.id !== id));
          Swal.fire({
            title: "Success!",
            text: resp.data.message || 'Pet deleted successfully',
            icon: "success",
            showConfirmButton: false,
            timer: 1500
          });
        } catch (err) {
          const msg = err.response?.data?.message || 'Could not delete';
          Swal.fire({
            title: "Error",
            text: msg,
            icon: "error"
          });
        }
      }
    });
  };

  const logout = async () => {
    try {
      await API.post('/logout');
    } catch {}
    localStorage.removeItem('token');
    navigate('/login');
  };

  return (
    <main id="dashboard">
      <header>
        <img src="/imgs/title-dashboard.png" alt="Dashboard" />
      </header>
      <nav>
        <Link className="btnAdd" to="/add">
          ✕ Add pet
        </Link>
        <button className="btnLogout" onClick={logout}>
          ✕ Logout
        </button>
      </nav>
      <h2>Pet List</h2>
      <section className="list">
        {pets.map(p => (
          <PetCard key={p.id} pet={p} onDelete={handleDelete} />
        ))}
      </section>
    </main>
  );
}
