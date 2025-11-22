import { CONFIG } from './config.js';

export async function getUsuarios() {
  const res = await fetch(`${CONFIG.API_BASE_URL}/get_clientes.php`);
  if (!res.ok) throw new Error(`HTTP ${res.status}`);
  return res.json();
}

export async function saveUser(userData) {
  const res = await fetch(`${CONFIG.API_BASE_URL}/save_user.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(userData)
  });
  if (!res.ok) throw new Error(`HTTP ${res.status}`);
  return res.json();
}

export async function deleteUser(userId) {
  const res = await fetch(`${CONFIG.API_BASE_URL}/delete_user.php`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id: userId })
  });
  if (!res.ok) throw new Error(`HTTP ${res.status}`);
  return res.json();
}