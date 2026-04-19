@extends('./admin.admin_dashboard')

@section('admin')
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
                    <li class="breadcrumb-item active" aria-current="page">Tous les articles de blog</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.blog.post') }}" class="px-5 btn btn-primary" aria-label="Ajouter un article de blog">
                    Ajouter un article
                </a>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des articles</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des articles de blog">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Image</th>
                            <th scope="col">Titre de l'article</th>
                            <th scope="col">Catégorie de blog</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($item->post_image && file_exists(public_path($item->post_image)))
                                        <img src="{{ asset($item->post_image) }}" alt="Image de l'article {{ $item->post_title ?? 'inconnu' }}" class="img-fluid" width="50" height="50">
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $item->post_title ?? 'N/A' }}</td>
                                <td>{{ $item['blog']['category_name'] ?? 'N/A' }}</td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <a href="{{ route('edit.blog.post', $item->id) }}" class="px-5 btn btn-success" aria-label="Modifier l'article {{ $item->post_title ?? 'inconnu' }}">
                                            Modifier
                                        </a>
                                        <a href="{{ route('delete.blog.post', $item->id) }}" class="px-5 btn btn-danger delete-post"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')"
                                            aria-label="Supprimer l'article {{ $item->post_title ?? 'inconnu' }}">
                                            Supprimer
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun article trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection