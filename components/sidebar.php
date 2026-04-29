<style>
.sidebar{
    position:fixed;
    top:60px;
    left:0;
    width:230px;
    height:100%;
    background:white;
    box-shadow:2px 0 10px rgba(0,0,0,0.05);
    padding-top:20px;
}

.side-nav{
    list-style:none;
}

.side-nav li{
    margin:8px 10px;
}

.side-btn{
    display:block;
    padding:12px 18px;
    border-radius:10px;
    text-decoration:none;
    color:#444;
    font-weight:500;
    transition:0.2s;
}

.side-btn:hover{
    background:#FFF3CD;
}

.side-btn.active{
    background:#F7B267;
    color:white;
}

</style>
<div class="sidebar">
    <ul class="side-nav">
        <li><a href="index.php?act=dashboard" class="side-btn <?= ($_GET['act'] ?? '') == 'dashboard' ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="index.php?act=kategori" class="side-btn <?= ($_GET['act'] ?? '') == 'kategori' ? 'active' : '' ?>">Kategori</a></li>
        <li><a href="index.php?act=catatan" class="side-btn <?= ($_GET['act'] ?? '') == 'catatan' ? 'active' : '' ?>">Catatan</a></li>
    </ul>
</div>