@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Lista e Roleve</h4>
                    </div>
                    <div class="page-btn">
                        <x-link href="{{ route('role.create') }}" class="btn btn-added">
                            <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" class="me-2" alt="img">Regjistro Role
                        </x-link>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-top">
                            <div class="search-set">
                                <div class="search-input">
                                    <a class="btn btn-searchset">
                                        <img src="{{asset ('admin/assets/img/icons/search-white.svg') }}" alt="img">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table datanew">
                                <thead>
                                    <tr>
                                        <th>Rolet</th>
                                        <th>Lejet</th>
                                        <th>Veprimet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach($role->permissions as $permission)
                                                <span class="badge bg-primary">{{ $permission->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <x-link href="{{route('role.edit', $role->id)}}" class="me-3">
                                                <img src="{{asset ('admin/assets/img/icons/edit.svg') }}" alt="img">
                                            </x-link>
                                            <x-link href="{{ route('roles.destroy', ['role' => $role->id]) }}" 
                                                class="me-3 confirm-text"
                                                data-title="A jeni i sigurte qe deshironi te fshini kete rol?"
                                                data-text="Ju nuk keni mundesi ta riktheni perseri!"
                                                data-confirm="Po!" 
                                                data-cancel="Anuloje">
                                                <img src="{{asset ('admin/assets/img/icons/delete.svg') }}" alt="img">
                                            </x-link>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('admin/assets/js/lobibox.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Lobibox.notify('success', {
                    // rounded: true,
                    delay: 3000,
                    icon: false,
                    sound: false,
                    msg: "{{ session('success') }}"
                });
            @endif
        });
    </script>
    @endpush
    @include('layouts.admin-footer')
</body>
</html>
@endsection