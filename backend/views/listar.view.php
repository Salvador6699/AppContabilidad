<section class="cards">
    <div class="card">
        <h1>Usuarios</h1>
        <button onclick="todosUsuarios()">Todos</button><br>
        <h3>Buscar usuario por:</h3>
        <select name="filtrobuscador" id="filtrobuscador">
            <option value="nomUsuario">Nombre</option>
            <option value="emailUsuario">Email</option>
        </select>
        <input type="text" id="buscador" placeholder="Ingresa el nombre o email"
            onfocus="limpiarInput(this)"
            onkeydown="verificarEnter(event,()=>buscarUsuario())">
        <button onclick="buscarUsuario()">Buscar</button>
    </div>
</section>
<section class="" id="usuarios"></section>

<script src="/frontend/assets/js/usuarios.js"></script>
<script src="/frontend/assets/js/inputs.js"></script>