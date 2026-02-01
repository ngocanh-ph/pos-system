<form method="POST" action="/mav-web-pos/public/handle-login">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<?php if (!empty($error)): ?>
<p style="color:red"><?= $error ?></p>
<?php endif; ?>