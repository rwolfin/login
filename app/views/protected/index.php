<h2>Защищенная страница</h2>
<p>Этот контент виден всем аутентифицированным пользователям.</p>

<?php if (\app\core\Auth::isVkUser()): ?>
    <div style="margin-top: 20px;">
        <img src="https://via.placeholder.com/600x400/4a76a8/ffffff?text=VK+User+Content" 
             alt="VK User Content" style="max-width: 100%;">
        <p>Этот контент виден только пользователям ВКонтакте.</p>
    </div>
<?php endif; ?>