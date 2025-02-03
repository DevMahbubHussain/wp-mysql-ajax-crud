    <div class="wrap">
        <h1>CRUD App</h1>
        <form id="crud-form">
            <input type="text" id="name" placeholder="Name" required>
            <input type="email" id="email" placeholder="Email" required>
            <button type="submit">Add Record</button>
        </form>
        <!-- Edit Form (Hidden by Default) -->
        <form id="edit-form" style="display: none;">
            <input type="hidden" id="edit-id">
            <input type="text" id="edit-name" placeholder="Name" required>
            <input type="email" id="edit-email" placeholder="Email" required>
            <button type="submit">Update Record</button>
            <button type="button" id="cancel-edit">Cancel</button>
        </form>
        <!-- form for edit -->
        <div id="loader" style="display: none;">
            <div class="spinner"></div>
            <p>Loading...</p>
        </div>
        <table id="crud-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here via AJAX -->
            </tbody>
        </table>
    </div>