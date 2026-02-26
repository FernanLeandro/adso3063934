// ============================================================
// CONSTANTES GLOBALES
// ============================================================
const DURATION = 320;

// Elementos del DOM (se obtienen después del DOMContentLoaded)
let loginView, dashboardView, addView, editView, showView_el;
let loginForm, loginBtn, btnAdd, btnLogout;
let addBtn, addCancelBtn, saveBtn, editCancelBtn;
let eName, eKind, showNameEl, showKindEl;
let backButtons;

// ============================================================
// FUNCIONES DE HELPERS (Scope Global)
// ============================================================

function showView(id) {
	const current = document.querySelector('main:not(.hide)');
	const target = document.getElementById(id);
	if (!target) return;
	if (current && current.id === id) return;

	if (current) {
		current.classList.add('fade-out');
		setTimeout(() => {
			current.classList.add('hide');
			current.classList.remove('fade-out');
		}, DURATION);
	}

	target.classList.remove('hide');
	target.classList.add('fade-in');
	requestAnimationFrame(() => requestAnimationFrame(() => {
		target.classList.add('in');
	}));

	setTimeout(() => target.classList.remove('fade-in', 'in'), DURATION + 20);

	if (typeof setCurrentView === 'function') setCurrentView(id);
}

function getRowInfo(element) {
	const row = element.closest('.row');
	if (!row) return {};
	const nameEl = row.querySelector('h3');
	const kindEl = row.querySelector('h4');
	const name = nameEl ? nameEl.textContent.trim() : '';
	let kind = '';
	if (kindEl) {
		const t = kindEl.textContent.trim();
		kind = t.split(':')[0] ? t.split(':')[0].trim() : t;
	}
	return { name, kind, row };
}

// Helpers de token
function setToken(token) {
	try { localStorage.setItem('apiToken', token); } catch (e) { console.warn('Could not save token', e); }
}

function getToken() {
	try { return localStorage.getItem('apiToken'); } catch (e) { return null; }
}

function clearToken() {
	try { localStorage.removeItem('apiToken'); localStorage.removeItem('user'); } catch (e) { }
}

function setCurrentView(id) {
	try { localStorage.setItem('currentView', id); } catch (e) { }
}

function getCurrentView() {
	try { return localStorage.getItem('currentView'); } catch (e) { return null; }
}

function clearCurrentView() {
	try { localStorage.removeItem('currentView'); } catch (e) { }
}

// ============================================================
// FUNCIONES DE API (Scope Global)
// ============================================================

async function loadPets() {
	const token = getToken();
	console.log('Token recuperado para loadPets:', token);
	
	if (!token) {
		console.warn('No hay token disponible');
		showView('login');
		return;
	}

	try {
		console.log('Cargando mascotas con token:', token);
		const response = await fetch('http://127.0.0.1:8000/api/pets/list', {
			method: 'GET',
			headers: {
				'Authorization': 'Bearer ' + token,
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			}
		});

		console.log('Response status:', response.status);
		const data = await response.json();
		console.log('API Response:', data);

		if (response.ok && data.pets && data.pets.length > 0) {
			console.log('Rendering ' + data.pets.length + ' pets');
			console.log('Sample pet data:', data.pets[0]); // Ver estructura de los datos
			renderPets(data.pets);
		} else if (response.status === 401) {
			console.error('Token inválido o expirado. Respuesta:', data);
			clearToken();
			Swal.fire({
				title: "Sesión expirada",
				text: 'Por favor inicia sesión nuevamente',
				icon: "warning"
			});
			showView('login');
		} else {
			console.warn('No pets found:', data.message || 'Empty response');
			clearPetsList();
		}
	} catch (error) {
		console.error('Error loading pets:', error);
		Swal.fire({
			title: "Error",
			text: 'No se pudo conectar con la API: ' + error.message,
			icon: "error"
		});
	}
}

function renderPets(pets) {
	if (!dashboardView) return;

	// Obtener el contenedor padre (main#dashboard)
	const mainContainer = dashboardView;
	
	// Encontrar el h2 "Pet List"
	const h2 = mainContainer.querySelector('h2');
	
	// Remover todas las secciones .list existentes (excepto si queremos mantener una como template)
	const allLists = mainContainer.querySelectorAll('section.list');
	allLists.forEach(list => list.remove());

	// Crear una sección .list para cada mascota
	pets.forEach(pet => {
		const section = document.createElement('section');
		section.className = 'list';
		section.dataset.petId = pet.id;
		
		const row = document.createElement('div');
		row.className = 'row';
		row.dataset.petId = pet.id;
		
		// Usar imagen de la mascota o imagen por defecto
		const imageSrc = pet.image ? `../20-laravel/public/images/${pet.image}` : 'imgs/pett.png';
		
		row.innerHTML = `
			<img src="${imageSrc}" alt="${pet.name}" onerror="this.src='imgs/pett.png'">
			<div class="data">
				<h3>${pet.name}</h3>
				<h4>${pet.kind}: ${pet.breed}</h4>
			</div>
			<nav class="actions">
				<a href="" class="show"></a>
				<a href="" class="edit"></a>
				<a href="" class="delete"></a>
			</nav>
		`;
		section.appendChild(row);
		
		// Insertar después del h2 si existe, sino al final
		if (h2) {
			h2.parentNode.insertBefore(section, h2.nextSibling);
		} else {
			mainContainer.appendChild(section);
		}
	});
}

function clearPetsList() {
	if (!dashboardView) return;

	const allLists = dashboardView.querySelectorAll('section.list');
	allLists.forEach(list => list.remove());
	
	// Crear una sección vacía para mantener la estructura
	const section = document.createElement('section');
	section.className = 'list';
	const h2 = dashboardView.querySelector('h2');
	if (h2) {
		h2.parentNode.insertBefore(section, h2.nextSibling);
	} else {
		dashboardView.appendChild(section);
	}
}

async function loadPetShow(petId) {
	const token = getToken();
	if (!token) {
		showView('login');
		return;
	}

	try {
		const response = await fetch(`http://127.0.0.1:8000/api/pets/show/${petId}`, {
			method: 'GET',
			headers: {
				'Authorization': 'Bearer ' + token,
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			}
		});

		const data = await response.json();

		if (response.ok && data.pet) {
			const pet = data.pet;
			if (showView_el) {
				showView_el.querySelector('.value.name').textContent = pet.name;
				showView_el.querySelector('.value.kind').textContent = pet.kind;
				showView_el.querySelector('.value.weight').textContent = pet.weight + ' lbs';
				showView_el.querySelector('.value.age').textContent = pet.age + ' years';
				showView_el.querySelector('.value.breed').textContent = pet.breed;
				showView_el.querySelector('.value.location').textContent = pet.location;
				showView_el.querySelector('.value.description').textContent = pet.description;
				showView_el.dataset.petId = pet.id;
				const imgEl = showView_el.querySelector('.show-image img');
				if (imgEl) {
					imgEl.src = pet.image ? `../20-laravel/public/images/${pet.image}` : 'imgs/pett.png';
					imgEl.onerror = function() { this.src = 'imgs/pett.png'; };
				}
			}
			showView('show');
		} else {
			Swal.fire({
				title: "Error",
				text: data.message || 'Could not load pet',
				icon: "error"
			});
		}
	} catch (error) {
		console.error('Error loading pet:', error);
	}
}

async function loadPetEdit(petId) {
	const token = getToken();
	if (!token) {
		showView('login');
		return;
	}

	try {
		const response = await fetch(`http://127.0.0.1:8000/api/pets/show/${petId}`, {
			method: 'GET',
			headers: {
				'Authorization': 'Bearer ' + token,
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			}
		});

		const data = await response.json();

		if (response.ok && data.pet) {
			const pet = data.pet;
			if (editView) {
				editView.querySelector('.e-name').value = pet.name;
				editView.querySelector('.e-kind').value = pet.kind;
				editView.querySelector('.e-weight').value = pet.weight;
				editView.querySelector('.e-age').value = pet.age;
				editView.querySelector('.e-breed').value = pet.breed;
				editView.querySelector('.e-location').value = pet.location;
				editView.querySelector('.e-description').value = pet.description;
				editView.dataset.petId = pet.id;
			}
			showView('edit');
		} else {
			Swal.fire({
				title: "Error",
				text: data.message || 'Could not load pet',
				icon: "error"
			});
		}
	} catch (error) {
		console.error('Error loading pet for edit:', error);
	}
}

async function deletePet(petId, rowElement) {
	const token = getToken();
	if (!token) {
		showView('login');
		return;
	}

	try {
		const response = await fetch(`http://127.0.0.1:8000/api/pets/delete/${petId}`, {
			method: 'DELETE',
			headers: {
				'Authorization': 'Bearer ' + token,
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			}
		});

		const data = await response.json();

		if (response.ok) {
			if (rowElement) rowElement.remove();
			Swal.fire({
				title: "Success!",
				text: 'Pet deleted successfully',
				icon: "success",
				showConfirmButton: false,
				timer: 1500
			});
		} else {
			Swal.fire({
				title: "Error",
				text: data.message || 'Could not delete pet',
				icon: "error"
			});
		}
	} catch (error) {
		console.error('Error deleting pet:', error);
	}
}

async function addPet(petData) {
	const token = getToken();
	if (!token) {
		showView('login');
		return;
	}

	try {
		const response = await fetch('http://127.0.0.1:8000/api/pets/store', {
			method: 'POST',
			headers: {
				'Authorization': 'Bearer ' + token,
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			},
			body: JSON.stringify(petData)
		});

		const data = await response.json();

		if (response.ok) {
			Swal.fire({
				title: "Success!",
				text: 'Pet added successfully',
				icon: "success",
				showConfirmButton: false,
				timer: 1500
			}).then(() => {
				const form = addView.querySelector('form');
				form.reset();
				loadPets();
				showView('dashboard');
			});
		} else {
			Swal.fire({
				title: "Error",
				text: data.message || 'Could not add pet',
				icon: "error"
			});
		}
	} catch (error) {
		console.error('Error adding pet:', error);
	}
}

async function updatePet(petId, petData) {
	const token = getToken();
	if (!token) {
		showView('login');
		return;
	}

	try {
		const response = await fetch(`http://127.0.0.1:8000/api/pets/edit/${petId}`, {
			method: 'PUT',
			headers: {
				'Authorization': 'Bearer ' + token,
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			},
			body: JSON.stringify(petData)
		});

		const data = await response.json();

		if (response.ok) {
			Swal.fire({
				title: "Success!",
				text: 'Pet updated successfully',
				icon: "success",
				showConfirmButton: false,
				timer: 1500
			}).then(() => {
				loadPets();
				showView('dashboard');
			});
		} else {
			Swal.fire({
				title: "Error",
				text: data.message || 'Could not update pet',
				icon: "error"
			});
		}
	} catch (error) {
		console.error('Error updating pet:', error);
	}
}

// ============================================================
// INICIALIZACIÓN - Cuando el DOM esté listo
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
	// Obtener referencias a elementos del DOM
	loginView = document.getElementById('login');
	dashboardView = document.getElementById('dashboard');
	addView = document.getElementById('add');
	editView = document.getElementById('edit');
	showView_el = document.getElementById('show');

	loginForm = document.querySelector('#login form');
	loginBtn = loginForm ? loginForm.querySelector('button') : null;

	btnAdd = document.querySelector('#dashboard .btnAdd');
	btnLogout = document.querySelector('#dashboard .btnLogout');

	addBtn = addView ? addView.querySelector('.addBtn') : null;
	addCancelBtn = addView ? addView.querySelector('.cancelBtn') : null;

	saveBtn = editView ? editView.querySelector('.saveBtn') : null;
	editCancelBtn = editView ? editView.querySelector('.e-cancel') : null;

	eName = editView ? editView.querySelector('.e-name') : null;
	eKind = editView ? editView.querySelector('.e-kind') : null;

	showNameEl = showView_el ? showView_el.querySelector('.value.name') : null;
	showKindEl = showView_el ? showView_el.querySelector('.value.kind') : null;

	backButtons = document.querySelectorAll('a.btnBack');

	// ============================================================
	// EVENT LISTENERS
	// ============================================================

	if (loginBtn) {
		loginBtn.addEventListener('click', function (e) {
			e.preventDefault();
			showView('dashboard');
			loadPets();
		});
	}

	if (btnAdd) {
		btnAdd.addEventListener('click', function (e) {
			e.preventDefault();
			showView('add');
		});
	}

	if (btnLogout) {
		btnLogout.addEventListener('click', function (e) {
			e.preventDefault();
			showView('login');
		});
	}

	if (dashboardView) {
		dashboardView.addEventListener('click', function (e) {
			const showBtn = e.target.closest('a.show');
			const editBtn = e.target.closest('a.edit');
			const deleteBtn = e.target.closest('a.delete');
			if (showBtn) {
				e.preventDefault();
				const row = showBtn.closest('.row');
				const petId = row ? row.dataset.petId : null;
				if (petId) {
					loadPetShow(petId);
				} else {
					const info = getRowInfo(showBtn);
					if (showNameEl && info.name) showNameEl.textContent = info.name;
					if (showKindEl && info.kind) showKindEl.textContent = info.kind;
					showView('show');
				}
			} else if (editBtn) {
				e.preventDefault();
				const row = editBtn.closest('.row');
				const petId = row ? row.dataset.petId : null;
				if (petId) {
					loadPetEdit(petId);
				} else {
					const info = getRowInfo(editBtn);
					if (eName && info.name) eName.value = info.name;
					if (eKind && info.kind) eKind.value = info.kind;
					showView('edit');
				}
			} else if (deleteBtn) {
				e.preventDefault();
				const row = deleteBtn.closest('.row');
				const petId = row ? row.dataset.petId : null;
				const petName = row ? row.querySelector('h3').textContent : null;
				if (confirm('Are you sure you want to delete "' + (petName || 'this item') + '"?')) {
					deletePet(petId, row);
				}
			}
		});
	}

	if (addBtn) {
		addBtn.addEventListener('click', function (e) {
			e.preventDefault();
			const form = addView.querySelector('form');
			const name = form.querySelector('input[name="name"]').value;
			const kind = form.querySelector('input[name="kind"]').value;
			const weight = form.querySelector('input[name="weight"]').value;
			const age = form.querySelector('input[name="age"]').value;
			const breed = form.querySelector('input[name="breed"]').value;
			const location = form.querySelector('input[name="location"]').value;

			if (!name || !kind || !weight || !age || !breed || !location) {
				Swal.fire({
					title: "Warning!",
					text: 'Please fill all fields',
					icon: "warning"
				});
				return;
			}

			addPet({
				name,
				kind,
				weight,
				age,
				breed,
				location,
				description: 'Added via API'
			});
		});
	}

	if (addCancelBtn) {
		addCancelBtn.addEventListener('click', function (e) {
			e.preventDefault();
			showView('dashboard');
		});
	}

	if (saveBtn) {
		saveBtn.addEventListener('click', function (e) {
			e.preventDefault();
			const petId = editView.dataset.petId;
			const form = editView.querySelector('form');
			const name = form.querySelector('.e-name').value;
			const kind = form.querySelector('.e-kind').value;
			const weight = form.querySelector('.e-weight').value;
			const age = form.querySelector('.e-age').value;
			const breed = form.querySelector('.e-breed').value;
			const location = form.querySelector('.e-location').value;
			const description = form.querySelector('.e-description').value;

			if (!name || !kind || !weight || !age || !breed || !location || !description) {
				Swal.fire({
					title: "Warning!",
					text: 'Please fill all fields',
					icon: "warning"
				});
				return;
			}

			updatePet(petId, {
				name,
				kind,
				weight,
				age,
				breed,
				location,
				description
			});
		});
	}

	if (editCancelBtn) {
		editCancelBtn.addEventListener('click', function (e) {
			e.preventDefault();
			showView('dashboard');
		});
	}

	backButtons.forEach(function (btn) {
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			showView('dashboard');
		});
	});

	// Manejo del formulario de login
	if (loginForm) {
		const btnLoginForm = document.querySelector('#btnLogin') || document.querySelector('#loginForm .btnLogin');
		if (btnLoginForm) {
			btnLoginForm.addEventListener('click', function (e) {
				e.preventDefault();
				if (typeof loginForm.requestSubmit === 'function') loginForm.requestSubmit();
				else loginForm.dispatchEvent(new Event('submit', { cancelable: true }));
			});
		}
		loginForm.addEventListener('submit', async function (e) {
			e.preventDefault();
			try {
				const email = document.getElementById('email').value;
				const password = document.getElementById('password').value;

				const response = await fetch('http://127.0.0.1:8000/api/login', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'Accept': 'application/json'
					},
					body: JSON.stringify({
						email: email,
						password: password
					})
				});
				const data = await response.json();
				console.log('Login response:', data);
				
				if (response.ok) {
					// Intentar obtener el token de diferentes campos posibles
					const token = data.token || data.access_token || data.api_token || data.data?.token || data.data?.access_token;
					console.log('Token obtenido:', token);
					
					if (token) {
						setToken(token);
						console.log('Token guardado en localStorage:', getToken());
					} else {
						console.warn('No se encontró token en la respuesta:', data);
					}
					
					if (data.user) {
						try { localStorage.setItem('user', JSON.stringify(data.user)); } catch (e) { }
					}
					Swal.fire({
						title: "Congratulations!",
						text: data.message,
						icon: "success",
						showConfirmButton: false,
						timer: 1500,
					}).then(() => {
						showView('dashboard');
						loadPets();
					});

				} else {
					Swal.fire({
						title: "Watch out!",
						text: data.message,
						icon: "error"
					});
				}
			} catch (error) {
				console.error(error.message);
			}
		});
	}

	// Restaurar sesión si existe
	const storedView = getCurrentView();
	if (getToken()) {
		const viewToShow = storedView && storedView !== 'login' ? storedView : 'dashboard';
		showView(viewToShow);
		if (viewToShow === 'dashboard') {
			loadPets();
		}
	} else {
		showView(storedView && storedView !== 'dashboard' ? storedView : 'login');
	}

	// Logout
	const btnLogoutBtn = document.querySelector('#dashboard .btnLogout');
	if (btnLogoutBtn) {
		btnLogoutBtn.addEventListener('click', function (e) {
			e && e.preventDefault();
			clearToken();
			clearCurrentView();
			showView('login');
		});
	}
});
