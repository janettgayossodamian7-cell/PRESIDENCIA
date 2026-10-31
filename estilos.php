:root {
    --primary: #2c3e50;
    --accent: #27ae60;
    --danger: #e74c3c;
    --warning: #f39c12;
    --bg: #f4f6f9;
    --card-bg: #ffffff;
    --text: #333333;
    --border: #e2e8f0;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--bg);
    color: var(--text);
    margin: 0;
    padding: 30px 20px;
    line-height: 1.5;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

header {
    background: var(--primary);
    color: white;
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 25px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

header h1 {
    margin: 0 0 8px 0;
    font-size: 1.8rem;
}

header p {
    margin: 0;
    opacity: 0.9;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.card {
    background: var(--card-bg);
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border: 1px solid var(--border);
}

.card h3 {
    margin-top: 0;
    margin-bottom: 15px;
    color: var(--primary);
}

form label {
    display: block;
    margin-top: 12px;
    margin-bottom: 4px;
    font-weight: 600;
    font-size: 0.9rem;
}

form input, form select, form textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 0.95rem;
    background-color: #fafafa;
}

form input:focus, form select:focus, form textarea:focus {
    outline: none;
    border-color: var(--primary);
    background-color: #fff;
}

button, .btn {
    display: inline-block;
    padding: 10px 18px;
    background-color: var(--primary);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 15px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: background 0.2s;
}

button:hover, .btn:hover {
    opacity: 0.9;
}

.btn-approve { background-color: var(--accent); }
.btn-reject { background-color: var(--danger); }

/* --- DISEÑO LIMPIO Y ESPACIADO PARA LA TABLA --- */

.table-responsive {
    width: 100%;
    overflow-x: auto; /* Permite desplazamiento horizontal si la pantalla es pequeña */
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border: 1px solid var(--border);
    margin-top: 15px;
}

table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    font-size: 0.92rem;
}

th, td {
    padding: 16px 18px; /* Más espacio interno arriba, abajo y a los lados */
    vertical-align: top; /* Alinea todo arriba para que no se desfase */
    border-bottom: 1px solid var(--border);
    word-break: break-word; /* Evita que correos o textos largos rompan el ancho */
}

th {
    background-color: #1e293b;
    color: white;
    font-weight: 600;
    white-space: nowrap;
}

/* Espaciado entre filas al pasar el mouse */
tbody tr:hover {
    background-color: #f8fafc;
}

/* Anchos sugeridos por columna para evitar que se aplasten */
th:nth-child(1) { width: 50px; }  /* ID */
th:nth-child(2) { width: 130px; } /* Comunidad */
th:nth-child(3) { width: 140px; } /* Solicitante */
th:nth-child(4) { width: 160px; } /* Contacto/Correo */
th:nth-child(5) { width: 220px; } /* Motivo */
th:nth-child(6) { width: 100px; } /* Estado */
th:nth-child(7) { width: 180px; } /* Resolución */
th:nth-child(8) { width: 180px; } /* Acción */

.badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    color: white;
    text-align: center;
}

.badge.Pendiente { background-color: var(--warning); }
.badge.Aprobada { background-color: var(--accent); }
.badge.Rechazada { background-color: var(--danger); }

/* Formulario pequeño dentro de la tabla */
td form textarea {
    font-size: 0.85rem;
    padding: 6px;
    height: 55px;
    resize: vertical;
}

.action-buttons {
    display: flex;
    gap: 6px;
    margin-top: 6px;
}

.action-buttons button {
    margin-top: 0;
    padding: 6px 10px;
    font-size: 0.8rem;
    flex: 1;
}