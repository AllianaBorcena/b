@if (auth()->user()->id !== 1)
    <div class="alert alert-danger">
        You do not have permission to access this page.
    </div>

@else

    @extends('admin.layouts.master')

    @section('content')
        <section class="section">
            <div class="section-header">
                <h1>Admin Role Management</h1>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h4>All Admin/Employees</h4>
                    <div class="card-header-action">
                        @if (auth()->user()->id === 1)
                            <a href="{{ route('admin.admin-management.create') }}" class="btn btn-primary">
                                Create New
                            </a>
                        @endif
                    </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>
    @endsection

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endif
