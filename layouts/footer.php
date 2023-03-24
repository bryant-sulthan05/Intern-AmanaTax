<style>
  a {
    color: black;
    font-size: 20px;
  }

  a:hover {
    color: #1e3756;
  }

  footer {
    padding: 22px;
    text-align: center;
  }

  .scrollup {
    background-color: #13cfac;
    border-radius: 100%;
    width: 50px;
    height: 50px;
    float: right;
    margin: 10px;
    border: 2px solid #1f2833;
  }

  .scrollup:hover {
    background-color: #1f2833;
    border: 2px solid #13cfac;
    border-radius: 100%;
    width: 50px;
    height: 50px;
    margin: 10px;
    transform: scale(1.05);
    transition: all 0.3s ease-in-out;
  }

  span p a {
    text-decoration: none;
  }
</style>

<div class="footer" style="background-color: #1f2833; color: #fff;">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#fff" fill-opacity="1" d="M0,96L80,117.3C160,139,320,181,480,165.3C640,149,800,75,960,53.3C1120,32,1280,64,1360,80L1440,96L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
  </svg>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <span>
            <h4 class="fw-bold">Tentang AmanaTax</h4>
            <hr>
          </span>
          <span>
            <p>
              PT. Amanah Media Edukasi adalah Perusahaan yang bergerak di bidang Jasa Konsultan Pajak, Penyusunan Tp Doc dan Jasa laporan Accounting atau pembukuan baik secara Perusahaan, individu, Lembaga Sosial, dan UKM
              Selain itu, kami juga penyelenggara Training, Workshop, Seminar dan Coaching Perpajakan dan Keuangan.
            </p>
          </span>
        </div>
        <div class="col-md-3">
          <span>
            <h4 class="fw-bold">Alamat</h4>
            <hr>
          </span>
          <span>
            <p>
              Jl. Serma Achim Kp. Buaran, Gg. H. Maya Desa No.12, RT.02/RW.02, Lambangsari, Kec. Tambun Sel., Kabupaten Bekasi, Jawa Barat 17510
            </p>
          </span>
        </div>
        <div class="col-md-4">
          <span>
            <h4 class="fw-bold">Sosial media AmanaTax</h4>
            <hr>
          </span>
          <span>
            <p>
              <a target="_blank" href="https://instagram.com/brevetpajak.amanatax?utm_medium=copy_link"><img src="../public/img/ig.png" width="20"><span class="text-light">&nbsp;Instagram</span></a>
            </p>
          </span>
        </div>
      </div>
    </div>
  </section>
  <button class="scrollup fixed-bottom ms-auto">
    <i class="bi bi-chevron-up text-light"></i>
  </button>
  <footer class="text-bg-dark">
    <span>
      <strong>
        Copyright &copy; Bryant Sulthan Nugroho
      </strong>
    </span>
  </footer>
</div>
<script>
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.scrollup').fadeIn();
    } else {
      $('.scrollup').fadeOut();
    }
  });

  $('.scrollup').click(function() {
    $("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
  });
</script>