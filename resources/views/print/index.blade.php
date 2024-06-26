@extends('layouts.master')

@section('title', 'Generate PDF')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Capture</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Capture</li>
@endsection

@section('content')
<div class="container-fluid">

<div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="input-group">
                <input class="form-control" id="payroll-input" type="text" placeholder="1, 1-100"><span class="input-group-text btn btn-primary" onclick="generatePDF()">Generate PDF</span>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-lg-12 col-md-12">
        
                <div class="card">
                    <div class="card-header">
                        <h5>Captured List <a href="{{route('capture.index')}}" class="btn btn-success" target="_blank"><i class="fa fa-upload"></i> Upload Capture</a></h5>
                    </div>
                    <div class="card-body">
                
                        {{ $dataTable->table() }}
                      
                    </div>
                </div>

        </div>
    </div>

</div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';

        function generatePDF(){
            var input = $('#payroll-input').val();
            if(input){
                window.open('print/generate-pdf/'+input, '_blank');
            }else{
                alert("Please provide range. Thank you.");
            }       
        }
    </script>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush



@section('script')

<script>
       function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this item?')) {
                    $.ajax({
                        url: '/capture/' + id+'/delete',
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // handle success response
                            // location.reload();
                            $('#payroll-table').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            // handle error response
                        }
                    });
                }
        }

</script>

@endsection



