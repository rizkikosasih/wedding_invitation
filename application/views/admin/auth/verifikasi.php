    <div class="row">

        <div class="col-lg-12">

            <?php if( $result != 200 ){ ?>

                <div class="text-center">
                    <img src="<?= base_url('assets/backend/dist/img/icon/icon-gagal.gif') ?>" class="img-responsive myIcon" alt="Verifikasi Gagal">
                </div>

                <h6 class="text-center">
                    <label class="d-block">Token tidak ditemukan atau sudah expired !</label>
                    <a href="<?= base_url('auth') ?>" class="btn btn-md btn-success">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </h6>
            
            <?php }else{ ?>

                <div class="text-center">
                    <img src="<?= base_url('assets/backend/dist/img/icon/icon-sukses.gif') ?>" class="img-responsive myIcon" alt="Verifikasi Sukses">
                </div>

                <h6 class="text-center">
                    <label class="d-block">Selamat akun anda berhasil diaktifkan!</label>
                    <a href="<?= base_url('auth') ?>" class="btn btn-md btn-success">
                        Login Disini
                    </a>
                </h6>
            
            <?php } ?>

        </div>

    </div>