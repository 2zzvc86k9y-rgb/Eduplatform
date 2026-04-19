@extends('./admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
                    <li class="breadcrumb-item active" aria-current="page">Modifier une permission</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Modifier une permission</h5>
                    <form id="myForm" action="{{ route('update.permission') }}" method="POST" class="row g-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $permission->id }}">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="name" class="form-label">Nom de la permission</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                value="{{ old('name', $permission->name) }}" required aria-describedby="name_error">
                            @error('name')
                                <span id="name_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="group_name" class="form-label">Nom du groupe</label>
                            <select class="mb-3 form-select @error('group_name') is-invalid @enderror" id="group_name" name="group_name"
                                aria-label="Sélectionner un groupe de permissions" required>
                                <option value="" disabled>Sélectionnez un groupe</option>
                                <option value="Category" {{ old('group_name', $permission->group_name) == 'Category' ? 'selected' : '' }}>Catégorie</option>
                                <option value="Instructor" {{ old('group_name', $permission->group_name) == 'Instructor' ? 'selected' : '' }}>Instructeur</option>
                                <option value="Coupon" {{ old('group_name', $permission->group_name) == 'Coupon' ? 'selected' : '' }}>Coupon</option>
                                <option value="Setting" {{ old('group_name', $permission->group_name) == 'Setting' ? 'selected' : '' }}>Paramètres</option>
                                <option value="Orders" {{ old('group_name', $permission->group_name) == 'Orders' ? 'selected' : '' }}>Commandes</option>
                                <option value="Report" {{ old('group_name', $permission->group_name) == 'Report' ? 'selected' : '' }}>Rapports</option>
                                <option value="Review" {{ old('group_name', $permission->group_name) == 'Review' ? 'selected' : '' }}>Avis</option>
                                <option value="All User" {{ old('group_name', $permission->group_name) == 'All User' ? 'selected' : '' }}>Tous les utilisateurs</option>
                                <option value="Blog" {{ old('group_name', $permission->group_name) == 'Blog' ? 'selected' : '' }}>Blog</option>
                                <option value="Role and Permission" {{ old('group_name', $permission->group_name) == 'Role and Permission' ? 'selected' : '' }}>Rôles et permissions</option>
                            </select>
                            @error('group_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Mettre à jour la permission">Mettre à jour</button>
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
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
                group_name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Veuillez entrer le nom de la permission",
                },
                group_name: {
                    required: "Veuillez sélectionner un groupe de permissions",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endsection