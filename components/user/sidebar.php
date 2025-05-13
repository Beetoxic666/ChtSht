
<div class="sidebar-components">
    <div class="logo">
        <img src="" alt="">
        <h4>SI Desa Rimba Beringin</h4>
    </div>
    <ul class="menu">
        <li class="button-info-desa d-flex items-center justify-content-between" onclick="toggleSubmenu()">
            <a>Info Desa</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
            </svg>
        </li>
        <div class="submenu-info-desa" style="display:none">
            <li style="margin-left: 10px;"><a href="geografis.php">Gambaran Geografis</a></li>
            <li style="margin-left: 10px;"><a href="demografis.php">Gambaran Demografis</a></li>
        </div>
        <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'kegiatan_desa') ? 'bg-primary' : '' ?>">
            <a href="kegiatan_desa.php?page=kegiatan_desa">Kegiatan Desa</a>
        </li>
        <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'struktur_desa') ? 'bg-primary' : '' ?>">
            <a href="struktur_desa.php?page=struktur_desa">Struktur Desa</a>
        </li>
        <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'sarana_prasarana_desa') ? 'bg-primary' : '' ?>">
            <a href="sarana_prasarana_desa.php?page=sarana_prasarana_desa">Sarana dan Prasarana Desa</a>
        </li>
        <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'program_desa') ? 'bg-primary' : '' ?>">
            <a href="program_desa.php?page=program_desa">Program Desa</a>
        </li>
        <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'penduduk_desa') ? 'bg-primary' : '' ?>">
            <a href="penduduk_desa.php?page=penduduk_desa">Penduduk Desa</a>
        </li>
        <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'bantuan_desa') ? 'bg-primary' : '' ?>">
            <a href="bantuan_desa.php?page=bantuan_desa">Bantuan Desa</a>
        </li>
        <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'pengajuan_desa') ? 'bg-primary' : '' ?>">
            <a href="pengajuan_desa.php?page=pengajuan_desa">Pengajuan Warga Desa</a>
        </li>
    </ul>
</div>

<script>
  function toggleSubmenu() {
    const submenu = document.querySelector('.submenu-info-desa');
    submenu.style.display = submenu.style.display === 'none' ? 'inline' : 'none';
  }
</script>