<style>
    .navbar{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:60px;
    background:#FFE6A7;
    display:flex;
    justify-content:flex-end;
    align-items:center;
    padding:0 25px;
    box-shadow:0 2px 8px rgba(0,0,0,0.08);
    z-index:1000;
}

.nav{
    list-style:none;
}

.nav li{
    display:inline;
}

.btn-danger{
    background:#FF6B6B;
    color:white;
    padding:8px 15px;
    border-radius:8px;
    text-decoration:none;
    font-size:14px;
    transition:0.2s;
}

.btn-danger:hover{
    background:#ff4b4b;
}

</style>
<nav class="navbar">
    <ul class="nav">
        <li>
            <a href="index.php?act=logout" class="btn btn-danger" onclick="return confirm('Apakah anda ingin logout?')">logout</a>
        </li>
    </ul>
</nav>