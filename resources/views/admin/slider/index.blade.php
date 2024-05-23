@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Card Header</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">
                        Create New
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div id="slider-table-container">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Check if DataTable instance exists
            var dataTableId = 'slider-table';
            var dataTableContainer = $('#slider-table-container');

            if ($.fn.DataTable.isDataTable('#' + dataTableId)) {
                // Destroy existing DataTable instance
                $('#' + dataTableId).DataTable().destroy();
                // Reinitialize DataTable
                dataTableContainer.html('{{ $dataTable->table() }}');
            }
        });
    </script>
    {{ $dataTable->scripts() }}
@endpush

