import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import API from '../api';
import Swal from 'sweetalert2';

export default function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();

  const handleSubmit = async e => {
    e.preventDefault();
    try {
      // backend defines route POST /api/login rather than /api/auth/login
      const resp = await API.post('/login', { email, password });
      localStorage.setItem('token', resp.data.token);
      Swal.fire({
        title: "Success!",
        text: resp.data.message || 'Logged in successfully',
        icon: "success",
        showConfirmButton: false,
        timer: 1500
      }).then(() => {
        navigate('/');
      });
    } catch (err) {
      // log full error to console for debugging
      console.error('login error', err);
      const msg = err.response?.data?.message || err.message || 'Login failed';
      Swal.fire({
        title: "Error",
        text: msg,
        icon: "error"
      });
    }
  };

  return (
    <main id="login">
      <header>
        <img src="/imgs/loginimg.png" alt="Login" />
      </header>
      <form onSubmit={handleSubmit} autoComplete="off">
        <label>
          Email:
          <input
            type="email"
            value={email}
            onChange={e => setEmail(e.target.value)}
            required
          />
        </label>
        <label>
          Password:
          <input
            type="password"
            value={password}
            onChange={e => setPassword(e.target.value)}
            required
          />
        </label>
        <button type="submit" className="btnLogin">Login</button>
      </form>
    </main>
  );
}
