@extends('appLayout.app')

@section('content')
    <div class="container mt-5">
        <div class="foto row justify-content-center">
            <div class="col-md-4">

                <img class="img-fluid border-3"
                    src="https://awsimages.detik.net.id/community/media/visual/2024/03/19/kondisi-gedung-cianjur-creative-center-2_169.jpeg?w=1200"
                    alt="" srcset="">
            </div>
            <div class="col-md-4">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.5480823194744!2d107.14065049999999!3d-6.824684399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e685256f612094b%3A0xda37899d4cf2d2b3!2sJl.%20Mangunsarkoro%20No.165%2C%20Sayang%2C%20Kec.%20Cianjur%2C%20Kabupaten%20Cianjur%2C%20Jawa%20Barat%2043211!5e0!3m2!1sid!2sid!4v1713854241918!5m2!1sid!2sid"
                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                <p>Jl. Mangunsarkoro No.165, Pamoyanan, Kec. Cianjur, Kabupaten Cianjur, Jawa Barat 43211</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center mb-4">Ada Pertanyaan? Kontak Kami</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Pesan</label>
                        <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection
