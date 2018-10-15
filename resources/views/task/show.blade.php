@extends ('layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>&nbsp;</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">{{ ucwords(str_replace('_', ' ', Request::segment(2))) }}</a></li>
        <li class="active">{{ $title }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary" style="padding: 20px;">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-size: 22px">{{$title.' '.$result->nama}}</h3>
            </div>
            <!-- /.box-header -->
            @if(!empty($result))
            <table class="table table-striped">
            	<thead>
            		<tr>
            			<th width="270px">Name</th>
            			<th class="text-left">Value</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr>
            			<td>ID</td>
            			<td>{{ $result->kategori_id }}</td>
            		</tr>
            		<tr>
            			<td>Nama</td>
            			<td>{{ $result->nama }}</td>
            		</tr>
                    <tr>
                        <td>Tipe Sponsor</td>
                        <td>
                            @if($result->sponsor == 0) {{ 'Gratis' }}
                            @elseif($result->sponsor == 1) {{ 'Bayar' }}
                            @else {{ 'Premium' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Mulai Sponsor</td>
                        <td>{{ $result->tgl_mulai }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Akhir Sponsor</td>
                        <td>{{ $result->tgl_akhir }}</td>
                    </tr>
            		<tr>
            			<td>Deskripsi (Bahasa Indonesia)</td>
            			<td>{!! $result->deskripsi_ina !!}</td>
            		</tr>
                    <tr>
                        <td>Deskripsi (Bahasa Inggris)</td>
                        <td>{!! $result->deskripsi_eng !!}</td>
                    </tr>
            		<tr>
            			<td>Hari Kerja (Bahasa Indonesia)</td>
            			<td>{{ $result->hari_kerja_ina }}</td>
            		</tr>
                    <tr>
                        <td>Hari Kerja (Bahasa Inggris)</td>
                        <td>{{ $result->hari_kerja_eng }}</td>
                    </tr>
            		<tr>
            			<td>Jam Kerja (Bahasa Indonesia)</td>
            			<td>{{ $result->jam_kerja_ina }}</td>
            		</tr>
                    <tr>
                        <td>Jam Kerja (Bahasa Inggris)</td>
                        <td>{{ $result->jam_kerja_eng }}</td>
                    </tr>
            		<tr>
            			<td>Kota</td>
            			<td>{{ $result->kota }}</td>
            		</tr>
            		<tr>
            			<td>Alamat</td>
            			<td>{{ $result->alamat }}</td>
            		</tr>
            		<tr>
            			<td>No Telepon</td>
            			<td>{{ $result->no_telepon }}</td>
            		</tr>
            		<tr>
            			<td>Email</td>
            			<td>{{ $result->email }}</td>
            		</tr>
            		<tr>
            			<td>Kapasitas Parkir Motor</td>
            			<td></td>
            		</tr>
            		<tr>
            			<td>Kapasitas Parkir Mobil</td>
            			<td></td>
            		</tr>
            		<tr>
            			<td>Kapasitas Parkir Bus</td>
            			<td></td>
            		</tr>
            		<tr>
            			<td>Website</td>
            			<td>{{ $result->website }}</td>
            		</tr>
            		<tr>
            			<td>Facebook</td>
            			<td>{{ $result->url_facebook }}</td>
            		</tr>
            		<tr>
            			<td>Twitter</td>
            			<td>{{ $result->url_twitter }}</td>
            		</tr>
                    <tr>
                        <td>Instagram</td>
                        <td>{{ $result->url_ig }}</td>
                    </tr>
                    <tr>
                        <td>Toilet Dan Ketersediaan Air Bersih</td>
                        <td>{{ ($result->toilet_dan_air_bersih == 1?'Tersedia':'Tidak Tersedia') }}</td>
                    </tr>
                    <tr>
                        <td>Menyediakan Minuman Alcohol</td>
                        <td>{{ ($result->menyediakan_minuman_alcohol == 1?'Ya':'Tidak') }}</td>
                    </tr>
                    <tr>
                        <td>Mukena</td>
                        <td>{{ ($result->mukena == 1?'Tersedia':'Tidak Tersedia') }}</td>
                    </tr>
                    <tr>
                        <td>Sarung</td>
                        <td>{{ ($result->sarung == 1?'Tersedia':'Tidak Tersedia') }}</td>
                    </tr>
                    <tr>
                        <td>Alquran</td>
                        <td>{{ ($result->alquran == 1?'Tersedia':'Tidak Tersedia') }}</td>
                    </tr>
                    <tr>
                        <td>Kapasitas Mushola</td>
                        <td>{{ $result->kapasitas_mushola }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Wudhu Terpisah MCK</td>
                        <td>{{ ($result->tempat_wudhu_terpisah_mck == 1?'Ya':'Tidak') }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Wudhu Wanita Digabung</td>
                        <td>{{ ($result->tempat_wudhu_wanita_digabung == 1?'Ya':'Tidak') }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Kran</td>
                        <td>{{ $result->jumlah_kran }}</td>
                    </tr>
                    <tr>
                        <td>Kapasitas Pelanggan</td>
                        <td>{{ $result->kapasitas_pelanggan }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Jajanan</td>
                        <td>{{ $result->jenis_jajanan }}</td>
                    </tr>
                    <tr>
                        <td>No Sertifikat</td>
                        <td>{{ $result->no_sertifikat }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pemegang</td>
                        <td>{{ $result->nama_pemegang }}</td>
                    </tr>
                    <tr>
                        <td>Penjamin</td>
                        <td>{{ $result->penjamin }}</td>
                    </tr>
                    <tr>
                        <td>Masa Berlaku</td>
                        <td>{{ $result->masa_berlaku }}</td>
                    </tr>
                    <tr>
                        <td>Fasilitas Tambahan (Bahasa Indonesia)</td>
                        <td>{{ $result->fasilitas_tambahan_ina }}</td>
                    </tr>
                    <tr>
                        <td>Fasilitas Tambahan (Bahasa Inggris)</td>
                        <td>{{ $result->fasilitas_tambahan_eng }}</td>
                    </tr>
            		<tr>
            			<td>Image</td>
            			<td>
                            @if(!empty($result->image1))
    	            			<img src="{{ url('assets/img/jajanan/'.$result->image1) }}" class="col-md-3">
	            			@endif
                            @if(!empty($result->image2))
                                <img src="{{ url('assets/img/jajanan/'.$result->image2) }}" class="col-md-3">
                            @endif
                            @if(!empty($result->image3))
	            			    <img src="{{ url('assets/img/jajanan/'.$result->image3) }}" class="col-md-3">
                            @endif
                            @if(!empty($result->image4))
	            			    <img src="{{ url('assets/img/jajanan/'.$result->image4) }}" class="col-md-3">
                            @endif
            			</td>
            		</tr>
            	</tbody>
            </table>
            @endif
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
@endsection