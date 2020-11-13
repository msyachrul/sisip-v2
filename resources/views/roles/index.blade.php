<x-app>
    <x-slot name="content">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <x-content-header name="Roles" />

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    @if (session()->has('success'))
                        <x-alert-success>
                            {{ session()->get('success') }}
                        </x-alert-success>
                    @endif
                    @if (session()->has('error'))
                        <x-alert-danger>
                            {{ session()->get('error') }}
                        </x-alert-danger>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="row px-1 mb-2">
                                <div class="col col-sm-4 px-1 mr-auto">
                                    <x-list-search />
                                </div>
                                <div class="col-auto px-1">
                                    <x-filter-modal :paginator="$roles">
                                        <x-slot name="body">
                                            <x-sortables :sortables="[
                                                'Name A-Z' => 'name|asc',
                                                'Name Z-A' => 'name|desc',
                                                'Slug A-Z' => 'slug|asc',
                                                'Slug Z-A' => 'slug|desc',
                                                'Oldest' => 'created_at|asc',
                                                'Newest' => 'created_at|desc',
                                            ]" />
                                        </x-slot>
                                    </x-filter-modal>
                                </div>
                                <div class="col-auto px-1">
                                    @can('create-roles')
                                        <x-create-button :url="route('roles.create')" />
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-none d-sm-block">
                                        <div class="row">
                                            <div class="col-12 col-sm text-muted">
                                                <x-list-header name="Name" asc="name|asc" desc="name|desc" />
                                            </div>
                                            <div class="col-12 col-sm text-muted">
                                                <x-list-header name="Slug" asc="slug|asc" desc="slug|desc" />
                                            </div>
                                            <div class="col-12 col-sm text-muted">
                                                <x-list-header name="Created At" asc="created_at|asc" desc="created_at|desc" />
                                            </div>
                                            <div class="col-12 col-sm-1 text-right"></div>
                                        </div>
                                    </li>
                                    @forelse ($roles as $role)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-12 col-sm">
                                                    <div class="d-sm-none text-muted">Name:</div>
                                                    <div>{{ $role->name }}</div>
                                                </div>
                                                <div class="col-12 col-sm">
                                                    <div class="d-sm-none text-muted">Slug:</div>
                                                    <div>{{ $role->slug }}</div>
                                                </div>
                                                <div class="col-12 col-sm">
                                                    <div class="d-sm-none text-muted">Created At:</div>
                                                    <div>{{ $role->created_at }}</div>
                                                </div>
                                                <div class="col-12 col-sm-1 text-right">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary border-0 rounded-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="{{ route('roles.show', $role) }}" class="dropdown-item">Detail</a>
                                                            @can('edit-roles')
                                                                <a href="{{ route('roles.edit', $role) }}" class="dropdown-item">Edit</a>
                                                            @endcan
                                                            @can('delete-roles')
                                                                <form action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Are you sure want to delete?')" style="display: none">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="submit" id="btn-delete-{{ $role->id }}" style="display: none" />
                                                                </form>
                                                                <a href="javascript:void(0)" class="dropdown-item" onclick="document.getElementById('btn-delete-{{ $role->id }}').click()">Delete</a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col text-center">Not found.</div>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>
                                <div class="card-footer">
                                    <x-paginator :paginator="$roles" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </x-slot>
</x-app>
