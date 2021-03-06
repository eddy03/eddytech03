@extends('layouts.master')

@section('title')
Web developer
@endsection

@section('style')
@endsection

@section('content')
<div class="page-header remove-top-margin">
    <h3 class="remove-margin">Berkenaan eddytech03.com</h3>
</div>
<div class="row">
    <div class="col-sm-2">
        {{ HTML::image('assets/img/eddy.jpg', 'Edi Abdul Rahman', array('class' => 'img-responsive img-circle')) }}
    </div>
    <div class="col-sm-10">
        Seorang yang masih baru didalam dunia web 2.0, Berminat untuk mempelajari teknologi terbaharu serta mengimplementasinya didalam
        proses pembangunan website.
        <br />
        <br />
        Mempunyai kemahiran didalam PHP, Javascript serta CSS. Mahir menggunakan framework PHP laravel, Bootstraps front end framework 
        serta jQuery.
        <br />
        <br />
        Kini berkerja sepenuh masa di <a href="http://www.kanntronics.com/" target="_blank">Kanntronics Sdn. Bhd.</a> sebagai RnD system developer.
        Pernah berkerja di <a href="http://www.mesiniaga.com.my/" target="_blank">Mesiniaga Bhd.</a> sebagai seorang system developer.
        Juga pernah berkerja di <a href="http://molpay.com/" target="_blank">MOLPay Sdn. Bhd.</a> sebagai system developer.
        <hr />
        <p class="lead">Sosial network</p>
        <ul class="list-unstyled">
            <li>
                <i class="fa fa-twitter fa-fw fa-lg"></i> <a href="https://twitter.com/eddytech03">Twitter</a>
            </li>
            <li>
                <i class="fa fa-github fa-fw fa-lg"></i> <a href="https://github.com/eddy03">Github</a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#menu-about').addClass('active');
});
</script>
@endsection