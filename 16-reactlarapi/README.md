# 16-reactlarapi

This project is a React frontend that consumes the Larapi backend located in the sibling `21-larapi` directory. It adapts the UI and functionality from `14-apijs` to a React application using React Router and Axios. The app supports authentication with token, and CRUD operations on pets.

## Setup

1. Make sure the API in `21-larapi` is running (`php artisan serve`).
2. Install dependencies:
   ```bash
   cd 16-reactlarapi
   npm install
   ```
3. Start the development server:
   ```bash
   npm start
   ```

The React app will try to call the API at `http://localhost:8000/api`. Adjust `src/api.js` if your API runs on a different host or port.

## Structure

- `src/components`: shared visual components (Menu, PetCard, PetForm, BtnBack, etc.)
- `src/pages`: route pages such as `Login`, `Dashboard`, `AddPet`, `ShowPet`, `EditPet`.
- `src/api.js`: Axios instance and helper functions.
- `src/App.js`: router configuration.
- `src/styles/master.css`: copied from the original 14-apijs for styling.

