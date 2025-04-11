@extends('layouts.template')
 
 @section('content')
     <div class="card card-outline card-primary">
         <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Daftar Barang</h3>
             <a class="btn btn-sm btn-primary" href="{{ url('barang/create') }}">Tambah</a>
         </div>
         <div class="card-body">
             @if (session('success'))
                 <div class="alert alert-success">{{ session('success') }}</div>
             @endif
             @if (session('error'))
                 <div class="alert alert-danger">{{ session('error') }}</div>
             @endif
 
             {{-- <div class="row mb-3">
                 <div class="col-md-4">
                     <label for="kategori_id">Filter Kategori:</label>
                     <select class="form-control" id="kategori_id" name="kategori_id">
                         <option value="">- Semua -</option>
                         @foreach ($kategori as $item)
                             <option value="{{ $item->id }}">{{ $item->kategori_nama }}</option>
                         @endforeach
                     </select>
                     <small class="form-text text-muted">Pilih kategori barang untuk memfilter data</small>
                 </div>
             </div> --}}
             <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="kategori_id" name="kategori_id">
                                <option value="">- Semua -</option>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Kategori Barang</small>
                        </div>
                    </div>
                </div>
            </div>
            
             <div class="table-responsive">
                 <table class="table table-bordered table-striped table-hover table-sm" id="table_barang" width="100%">
                     <thead class="text-center">
                         <tr>
                             <th style="width: 40px;">ID</th>
                             <th style="width: 140px;">Kategori Barang</th>
                             <th style="width: 100px;">Kode Barang</th>
                             <th style="width: 150px;">Nama Barang</th>
                             <th style="width: 120px;">Harga Beli</th>
                             <th style="width: 120px;">Harga Jual</th>
                             <th style="width: 220px;">Aksi</th>
                         </tr>
                     </thead>
                 </table>
             </div>
         </div>
     </div>
 @endsection
 
 @push('js')
     <script>
         $(document).ready(function() {
                // CSRF token untuk AJAX POST
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
             var dataBarang = $('#table_barang').DataTable({
                 serverSide: true,
                 ajax: {
                     url: "{{ url('barang/list') }}",
                     type: "POST",
                     data: function(d) {
                         d.kategori_id = $('#kategori_id').val();
                     }
                 },
                 columns: [{
                         data: "DT_RowIndex",
                         className: "text-center align-middle",
                         orderable: false,
                         searchable: false
                     },
                     {
                         data: "kategori.kategori_nama",
                         className: "align-middle",
                         orderable: false,
                         searchable: false
                     },
                     {
                         data: "barang_kode",
                         className: "text-center align-middle"
                     },
                     {
                         data: "barang_nama",
                         className: "align-middle"
                     },
                     {
                         data: "harga_beli",
                         className: "text-end align-middle",
                         render: function(data) {
                             return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);
                         }
                     },
                     {
                         data: "harga_jual",
                         className: "text-end align-middle",
                         render: function(data) {
                             return 'Rp ' + new Intl.NumberFormat('id-ID').format(data);
                         }
                     },
                     {
                         data: "aksi",
                         className: "text-center align-middle",
                         orderable: false,
                         searchable: false
                     }
                 ]
             });
 
             $('#kategori_id').on('change', function() {
                 dataBarang.ajax.reload();
             });
         });
     </script>
 @endpush