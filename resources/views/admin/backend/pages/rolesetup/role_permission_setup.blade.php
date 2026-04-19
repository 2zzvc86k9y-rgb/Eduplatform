@extends('./admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>

<div class="page-content">
    <!-- Fil d'Ariane -->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="Fil d'Ariane">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" aria-label="Retour au tableau de bord">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter des permissions à un rôle</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Ajouter des permissions à un rôle</h5>
                    <form id="myForm" action="{{ route('store.role.in.permission') }}" method="POST" class="row g-3">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="role_id" class="form-label">Nom du rôle</label>
                            <select class="mb-3 form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id"
                                aria-label="Sélectionner un rôle" required>
                                <option value="" disabled selected>Sélectionnez un rôle</option>
                                @foreach ($roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="flexCheckMain" name="permission_all" value="1"
                                aria-label="Sélectionner toutes les permissions">
                            <label class="form-check-label" for="flexCheckMain">Sélectionner toutes les permissions</label>
                        </div>
                        <hr>

                        @foreach ($permission_group as $group)
                            <div class="row">
                                <div class="col-md-3">
                                    @php
                                        $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                                    @endphp
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input group-check"
                                            id="checkGroup{{ $group->group_name }}" name="permission_all"
                                            aria-label="Sélectionner toutes les permissions du groupe {{ $group->group_name }}">
                                        <label class="form-check-label" for="checkGroup{{ $group->group_name }}">{{ $group->group_name }}</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input permission-check"
                                                data-group="{{ $group->group_name }}"
                                                id="checkDefault{{ $permission->id }}" name="permission[]"
                                                value="{{ $permission->id }}"
                                                aria-label="Permission {{ $permission->name }}">
                                            <label class="form-check-label" for="checkDefault{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                    <br>
                                </div>
                                <hr>
                            </div>
                        @endforeach

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Ajouter les permissions">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Validation du formulaire
        $('#myForm').validate({
            rules: {
                role_id: {
                    required: true,
                },
                'permission[]': {
                    required: true,
                },
            },
            messages: {
                role_id: {
                    required: "Veuillez sélectionner un rôle",
                },
                'permission[]': {
                    required: "Veuillez sélectionner au moins une permission",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.attr('name') === 'permission[]') {
                    error.insertAfter(element.closest('.col-md-9'));
                } else {
                    element.closest('.form-group').append(error);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });

        // Gestion de la case "Sélectionner toutes les permissions"
        $('#flexCheckMain').click(function() {
            const isChecked = $(this).is(':checked');
            $('input[type=checkbox]').prop('checked', isChecked);
        });

        // Gestion des cases à cocher des groupes
        $('.group-check').click(function() {
            const groupName = $(this).attr('id').replace('checkGroup', '');
            const isChecked = $(this).is(':checked');
            $(`.permission-check[data-group="${groupName}"]`).prop('checked', isChecked);
            updateSelectAllCheckbox();
        });

        // Gestion des cases à cocher des permissions individuelles
        $('.permission-check').click(function() {
            const groupName = $(this).data('group');
            const allPermissionsInGroup = $(`.permission-check[data-group="${groupName}"]`);
            const allChecked = allPermissionsInGroup.length === allPermissionsInGroup.filter(':checked').length;
            $(`#checkGroup${groupName}`).prop('checked', allChecked);
            updateSelectAllCheckbox();
        });

        // Mettre à jour la case "Sélectionner toutes les permissions"
        function updateSelectAllCheckbox() {
            const allCheckboxes = $('.permission-check');
            const allChecked = allCheckboxes.length === allCheckboxes.filter(':checked').length;
            $('#flexCheckMain').prop('checked', allChecked);
        }
    });
</script>
@endsection