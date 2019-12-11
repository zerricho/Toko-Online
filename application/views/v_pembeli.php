<div class="block-header">
<center> <h1> DATA PEMBELI </h1> </center>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2> Data Pembeli </h2>
                            </div>
                            <div class="col-xs-12 col-sm-6 align-right">
                                
                            </div>
                        </div>
                    
                    </div>

                <div class="body">
                    <div class="row">
                    <a href="#tambah" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"> </span>Tambah</a>

                        <table class="table table-hover table-striped">
                        <tr>
                            <th>NO</th> 
                            <th>ID</th> 
                            <th>NAMA PEMBELI</th>
                            <th>ALAMAT</th> 
                            <th>NO TELP</th> 
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th>AKSI</th>
                        </tr>

                        <?php
                        $no=0;
                        foreach($data_pembeli as $dt_pembeli){
                            $no++;
                            echo '<tr>
                            <td> '.$no.' </td> 
                            <td> '.$dt_pembeli->id_pembeli.' </td> 
                            <td> '.$dt_pembeli->nama_pembeli.'</td>
                            <td> '.$dt_pembeli->alamat.' </td> 
                            <td> '.$dt_pembeli->no_telp.'</td>
                            <td> '.$dt_pembeli->username.' </td> 
                            <td> '.$dt_pembeli->password.'</td>
                            <td> <a href="#update_pembeli" class="btn btn-warning" data-toggle="modal" onclick="tm_detail('.$dt_pembeli->id_pembeli.')"> Update </a> 
                            <a href='.base_url('index.php/pembeli/deletePembeli/'.$dt_pembeli->id_pembeli).' class="btn btn-success" onclick="return confirm(\'anda yakin\')"> Delete </a> </td>
                                </tr>';

                        }
                        ?>
                        </table>
                    
                    <?php
                    if($this->session->flashdata('pesan')!=null);
                    ?>

                    <div class="alert alert-danger">
                    <?= $this->session->flashdata('pesan');?>
                    </div>

                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Tambah pembeli</h4>
        </div>
        <div class="modal-body">
        <form action="<?=base_url('index.php/pembeli/simpan_pembeli')?>" method="post">
            Nama pembeli
            <input type="text" name="nama_pembeli" class="form-control"> <br>

        <form action="<?=base_url('index.php/pembeli/simpan_pembeli')?>" method="post">
            Alamat
            <input type="text" name="alamat" class="form-control"> <br>

        <form action="<?=base_url('index.php/pembeli/simpan_pembeli')?>" method="post">
            No Telp
            <input type="text" name="no_telp" class="form-control"> <br>

        <form action="<?=base_url('index.php/pembeli/simpan_pembeli')?>" method="post">
            Username
            <input type="text" name="username" class="form-control"> <br>

        <form action="<?=base_url('index.php/pembeli/simpan_pembeli')?>" method="post">
            Password
            <input type="text" name="password" class="form-control"> <br>

            <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="update_pembeli">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Update Pembeli</h4>
        </div>

        <div class="modal-body">
        <form action="<?=base_url('index.php/pembeli/update_pembeli')?>" method="post">

        <input type="hidden" name="id_pembeli" id="id_pembeli">

            Nama pembeli
            <input id="nama_pembeli" type="text" name="nama_pembeli" class="form-control"> 
            <form action="<?=base_url('index.php/pembeli/update_pembeli')?>" method="post"><br>

            Alamat
            <input id="alamat" type="text" name="alamat" class="form-control"> 
            <form action="<?=base_url('index.php/pembeli/update_pembeli')?>" method="post"><br>

            No Telp
            <input id="no_telp" type="text" name="no_telp" class="form-control"> 
            <form action="<?=base_url('index.php/pembeli/update_pembeli')?>" method="post"><br>

            Username
            <input id="username" type=" text" name="username" class="form-control"> 
            <form action="<?=base_url('index.php/pembeli/update_pembeli')?>" method="post"><br>

            Password
            <input id="password" type="text" name="password" class="form-control"> 
            <form action="<?=base_url('index.php/pembeli/update_pembeli')?>" method="post"><br>
            
            <br>
            <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </form>
        </div>
 
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
    function tm_detail(id_pembeli){
        $.getJSON("<?=base_url()?>index.php/pembeli/get_detail_pembeli/"+id_pembeli,function(data){
            $("#id_pembeli").val(data['id_pembeli']);
            $("#nama_pembeli").val(data['nama_pembeli']);
            $("#alamat").val(data['alamat']);
            $("#no_telp").val(data['no_telp']);
            $("#username").val(data['username']);
            $("#password").val(data['password']);
        });
    }
    </script>