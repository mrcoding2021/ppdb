<style>
  .bg-gw {
    background-color: grey;
  }

  .collapse-content .fa.fa-heart:hover {
    color: #f44336 !important;
  }

  .collapse-content .fa.fa-share-alt:hover {
    color: #0d47a1 !important;
  }

  .mt-2 {
    padding-top: 10px;

  }

  .mt-x {
    margin-top: -20px !important;
    margin-bottom: 10px;

  }

  .w-100 {
    height: 200px
  }

  .card {
    border: .5px black solid;
    padding: 10px;

  }

  .pb-1 {
    padding-bottom: 20px;
  }
</style>
<section id="featured">
  <div id="nivo-slider">
    <div class="nivo-slider">
      <?php foreach ($slider as $key) : ?>
        <img src="<?= base_url('asset/') ?>img/slides/nivo/<?= $key['img'] ?>" alt="" />
      <?php endforeach ?>
    </div>
  </div>
</section>
<section class="callaction">
  <div class="container">
    <div class="row">
      <div class="span12">
        <div class="big-cta">
          <div class="cta-text">
            <h3>Lebih dari <span class="highlight"><strong>500 orang</strong></span> telah bergabung menjadi anggota KoSPE</h3>
          </div>
          <div class="cta floatright">
            <a class="btn btn-large btn-theme btn-rounded" href="https://member.kospe.net/082211777107">Gabung Sekarang</a>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="content">
  <div class="container">
    <div class="row">
      <div class="span12">
        <div class="row">
          <div class="span3">
            <div class="box aligncenter">
              <div class="aligncenter icon">
                <img src="<?= base_url() . 'asset/img/kospe/1.png' ?>" alt="" width="50%">
              </div>
              <div class="text">
                <h6>1000 Pesantren</h6>
                <p>
                  Wmdujudkan 1000 Pesantren pengahfal Alquran di seluruh Indonesia
                </p>

              </div>
            </div>
          </div>
          <div class="span3">
            <div class="box aligncenter">
              <div class="aligncenter icon">
                <img src="<?= base_url() . 'asset/img/kospe/2.png' ?>" alt="" width="50%">
              </div>
              <div class="text">
                <h6>Memberantas KPR</h6>
                <p>
                  Memberantas KPR (Kefakiran, Pemurtadan dan Riba)
                </p>

              </div>
            </div>
          </div>
          <div class="span3">
            <div class="box aligncenter">
              <div class="aligncenter icon">
                <img src="<?= base_url() . 'asset/img/kospe/3.png' ?>" alt="" width="50%">
              </div>
              <div class="text">
                <h6>Lembaga Syariah</h6>
                <p>
                  Menjadi lembaga keuangan syariah dan menjalankan program bisnis berasaskan syariah
                </p>

              </div>
            </div>
          </div>
          <div class="span3">
            <div class="box aligncenter">
              <div class="aligncenter icon">
                <img src="<?= base_url() . 'asset/img/kospe/4.png' ?>" alt="" width="50%">
              </div>
              <div class="text">
                <h6>Distibutor Produk Halal</h6>
                <p>
                  LMemproduksi dan memasakan produk-produk halal ke seluruh dunia
                </p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- divider -->

    <div class="row">
      <div class="span6">
        <div class="solidline">
          <a href="<?= base_url('home/ajukan') ?>"><img src="<?= base_url('asset/img/klik1.png') ?>" alt=""></a>
        </div>
      </div>
      <div class="span6">
        <div class="solidline">
          <a href="<?= base_url('home/simpan') ?>"><img src="<?= base_url('asset/img/klik2.png') ?>" alt=""></a>
        </div>
      </div>
    </div>
    <!-- end divider -->

    <div class="row">
      <div class="span12">
        <h4 class="heading">Produk <strong>Pembiayaan dan Simpanan</strong></h4>
        <div class="row">
          <ul id="thumbs">
            <?php foreach ($paket as $key) : ?>
              <li class="item-thumbs span4">
                <!-- Fancybox - Gallery Enabled - Title - Full Image -->
                <a href="https://bit.ly/PembiayaanKoSPE">
                  <img src="<?= base_url('asset/img/produk/' . $key->img) ?>" alt="<?= $key->nama?>">
                </a>

              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- Portfolio Projects -->
    <div class="row">
      <div class="span12">
        <h4 class="heading">Berita dan <strong>Artikel</strong></h4>
        <div class="row">
          <section id="projects">
            <ul id="thumbs" class="portfolio">
              <!-- Item Project and Filter Name -->
              <?php foreach ($post as $key) : ?>
                <?php $slug = strtolower(str_replace(' ', '-', $key->judul));
                ?>
                <li class="span4">
                  <a href="<?= base_url('berita/detail/' . $slug) ?>" class="hover">

                    <!-- Card -->
                    <div class="card promoting-card">



                      <!-- Card content -->
                      <div class="card-body">
                        <!-- Card image -->
                        <div class="w-100">
                          <img class="images" src="<?= base_url('asset/img/post/') . $key->img ?>" height="200" width="70%">
                          <br>
                        </div>

                        <div class="">
                          <!-- Title -->
                          <h6 class="card-title font-weight-bold mt-2"><strong><?= $key->judul ?></strong></h6>
                          <!-- Subtitle -->

                          <!-- Text -->
                          <p class="mt-x"><?= substr(($key->isi), 0, 100) ?></p>
                          <a href="<?= base_url('berita/detail/' . $slug) ?>" class="btn btn-primary btn-sm">Selengkapnya</a>

                        </div>

                      </div>

                    </div>
                    <!-- Card -->
                  </a>
                </li>
              <?php endforeach ?>
            </ul>
          </section>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="span12">
        <div class="solidline">
        </div>
      </div>
    </div>
    <!-- end divider -->
    <div class="row">
      <div class="span12">
        <h4>Mitra <strong>Kerja</strong></h4>
        <?php $this->load->view('template/logo-mitra') ?>
      </div>
    </div>
  </div>
</section>